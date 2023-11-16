<?php

namespace App\Http\Controllers\Api\Data_Claim;

use App\Http\Helper\HelperController;
use App\Models\tb_klaim;
use App\Models\tb_klaim_log;
use App\Models\tb_klaim_ins;
use App\Models\tb_uploads;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Log;
use Throwable;

class InputClaimController extends Controller
{
    public function inputAsset(Request $r)
    {
        try {
            $filter = array(
                array(
                    "filterId" => 1,
                    "filterDesc" => 'Client'
                ),
                array(
                    "filterId" => 2,
                    "filterDesc" => 'Policy'
                ),
                array(
                    "filterId" => 3,
                    "filterDesc" => 'DN'
                ),
            );

            $curr = DB::select(
                'SELECT
                webapps_db.tb_curr.*
                FROM
                webapps_db.tb_curr');

            $cause = DB::select('SELECT
                klaimapps_db.tb_caused.id as causeId,
                klaimapps_db.tb_caused.description
                FROM
                klaimapps_db.tb_caused
                WHERE
                klaimapps_db.tb_caused.id <> 0');

            $lossAdj = DB::select('SELECT
                klaimapps_db.tb_loss_adjuster.id as lossAdjId,
                IFNULL( klaimapps_db.tb_loss_adjuster.`name`, "-" ) adj_name
            FROM
                klaimapps_db.tb_loss_adjuster
            WHERE
                klaimapps_db.tb_loss_adjuster.id <> 0');

            $workshop = DB::select('SELECT
                klaimapps_db.tb_workshop.id as workshopId,
                IFNULL( klaimapps_db.tb_workshop.`name`, "-" ) ws_name
            FROM
                klaimapps_db.tb_workshop
            WHERE
                klaimapps_db.tb_workshop.id <> 0');

//            DB::select("CALL my_stored_procedure()");
            return response()->json([
                'status' => 200,
                'filter' => $filter,
                'curr' => $curr,
                'cause' => $cause,
                'lossAdj' => $lossAdj,
                'workshop' => $workshop,
            ], 200);
        } catch (Throwable $exception) {
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }

    public function getDataTable(Request $r)
    {
        try {
            $data = DB::select("CALL klaimapps_db.getPolis(?,?)", [$r->get("type"), $r->get("search")]);

            return response()->json([
                'status' => 200,
                'data' => $data,
            ], 200);
        } catch (Throwable $exception) {
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }

    public function getDataClient(Request $r)
    {
        try {
            $data = DB::select("CALL klaimapps_db.getClientInfo(?)", [$r->get("prod_no")]);
            if($data){
                $data[0]->periode =  HelperController::changeDate($data[0]->start_dd).' s/d '.HelperController::changeDate($data[0]->end_dd);
                $data[0]->start_dd = date("d-m-Y", strtotime($data[0]->start_dd));
                $data[0]->end_dd = date("d-m-Y", strtotime($data[0]->end_dd));
            }
            return response()->json([
                'status' => 200,
                'data' => $data,
            ], 200);
        } catch (Throwable $exception) {
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }

    public function getDataPremium(Request $r)
    {
        try {
            $prem = DB::select("CALL klaimapps_db.getPremiumInfo(?)", [$r->get("prod_no")]);
            $listIns = DB::select("CALL klaimapps_db.getPremiumInsrInfo(?,?,?,?)", ['1', $r->get("draft_no"), '', '']);

            if ($listIns)
                $premIns = DB::select("CALL klaimapps_db.getPremiumInsrInfo(?,?,?,?)", ['2', $r->get("draft_no"), $r->get("prod_no"), $listIns[0]->insr_id]);

            foreach ($listIns as $l) {
                $l->premium = $premIns;
            }
            $data = array(
                "client" => $prem,
                "ins" => $listIns,
            );
            return response()->json([
                'status' => 200,
                'data' => $data,
            ], 200);
        } catch (Throwable $exception) {
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }

    public function getDataIns(Request $r)
    {
        try {
            $listIns = DB::select("CALL klaimapps_db.getPremiumInsrInfo(?,?,?,?)", ['3', $r->get("draft_no"), '', '']);

            foreach ($listIns as $l) {
                $l->claimAmt = 0;
                $l->deducAmt = 0;
                $l->recovAmt = 0;
                $l->netAmt = 0;
            }

            return response()->json([
                'status' => 200,
                'data' => $listIns,
            ], 200);
        } catch (Throwable $exception) {
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }

    public function getClaimAmount(Request $r)
    {
        try {
            $listIns = DB::select("CALL klaimapps_db.getPremiumInsrInfo(?,?,?,?)", ['3', $r->get("draft_no"), '', '']);
            if ($listIns) {
                $eAmnt = str_replace(",", "", $r->get('estAmt'));
                $cAmnt = str_replace(",", "", $r->get('claimAmt'));
                $dAmnt = str_replace(",", "", $r->get('deducAmt'));
                $rAmnt = str_replace(",", "", $r->get('recoveryAmt'));
                $sum = $cAmnt - $dAmnt - $rAmnt;
                $sisaEst = 0;
                $sisaNet = 0;
                $sisaClaim = 0;
                $sisaDeduc = 0;
                $sisaRec = 0;
                for ($i = 0; $i < count($listIns); $i++) {
                    if ($i != count($listIns) - 1 || $i == 0) {
                        //net
                        $netShare = $sum * ($listIns[$i]->share_pct / 100);
                        $sisaNet = $sum - $netShare;

                        //est
                        $estShare = $eAmnt * ($listIns[$i]->share_pct / 100);
                        $sisaEst = $eAmnt - $estShare;

                        //claim
                        $claimShare = $cAmnt * ($listIns[$i]->share_pct / 100);
                        $sisaClaim = $cAmnt - $claimShare;

                        //deduc
                        $deducShare = $dAmnt * ($listIns[$i]->share_pct / 100);
                        $sisaDeduc = $dAmnt - $deducShare;

                        //recov
                        $recShare = $rAmnt * ($listIns[$i]->share_pct / 100);
                        $sisaRec = $rAmnt - $recShare;

                        $listIns[$i]->estAmt = number_format($estShare, 0);
                        $listIns[$i]->claimAmt = number_format($claimShare, 0);
                        $listIns[$i]->deducAmt = number_format($deducShare, 0);
                        $listIns[$i]->recovAmt = number_format($recShare, 0);
                        $listIns[$i]->netAmt = number_format($netShare, 0);

                    } else {
                        $listIns[$i]->estAmt = number_format($sisaEst, 0);
                        $listIns[$i]->claimAmt = number_format($sisaClaim, 0);
                        $listIns[$i]->deducAmt = number_format($sisaDeduc, 0);
                        $listIns[$i]->recovAmt = number_format($sisaRec, 0);
                        $listIns[$i]->netAmt = number_format($sisaNet, 0);
                    }
                }
            }

            return response()->json([
                'status' => 200,
                'data' => $listIns,
                'netClaimAmt' => number_format($sum, 0)
            ], 200);
        } catch (Throwable $exception) {
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }

    public function insert(Request $r)
    {
//        dd($r->all());
        try {
//            $no = DB::select('select klaimapps_db.tb_klaim.claim_no from klaimapps_db.tb_klaim order by klaimapps_db.tb_klaim.id desc limit 1');
            $last = tb_klaim::select('claim_no', 'claim_dd')->orderBy('id', 'desc')->first();
            $yearCode = ((string)$last->claim_no)[1];
            $lastYear = date('Y', strtotime($last->claim_dd));

            if (date('Y') != $lastYear) {
                $lastClaimNo = 1;
                $Code = ++$yearCode;
            } else {
                $lastClaimNo = (int)substr($last->claim_no, 2, 4) + 1;
                $Code = $yearCode;
            }
            $No = str_pad((string)$lastClaimNo, 4, "0", STR_PAD_LEFT);
            $claimNo = "C" . $Code . $No;
            $noDate = date('my');
            $claim_no = $claimNo . "/TIB/" . $noDate . "/" . $r->cob_code;

            $klaim = new tb_klaim;
            $klaim->claim_no = $claim_no;
            $klaim->claim_dd = date('Y-m-d H:i:s', strtotime(now()));
            $klaim->req_id = $r->sppaId;
            $klaim->prod_no = $r->prod_no;
            $klaim->name_wrt = $r->name_wrt;
            $klaim->pol_no = $r->pol_no;
            $klaim->insd_id = $r->insdId;
            $klaim->dol = date('Y-m-d', strtotime($r->dol));
            $klaim->interest = $r->interest;
            $klaim->location = $r->location;
            $klaim->start_dd = date('Y-m-d', strtotime($r->start_dd));
            $klaim->end_dd = date('Y-m-d', strtotime($r->end_dd));

            $klaim->caused = $r->caused;
            $klaim->ladj = $r->lossAdj;
            $klaim->ws_id = $r->workshop;
            $klaim->cob_id = $r->cob_id;
            $klaim->cur = $r->curr_id;

            $klaim->tsi = str_replace(",", "", $r->tsi);
            $klaim->est_amt = str_replace(",", "", $r->estimationAmt);
            $klaim->claim_amt = str_replace(",", "", $r->claimAmt);
            $klaim->deduct_amt = str_replace(",", "", $r->deducAmt);
            $klaim->recv_amt = str_replace(",", "", $r->recoveryAmt);
            $klaim->net_amt = str_replace(",", "", $r->netAmt);
            $klaim->user_add = Auth::user()->id;

            $klaim->save();

            $klaimId = $klaim->id;

            $cob = DB::select('SELECT
                            webapps_db.tb_cob.cob_code
                            FROM
                            klaimapps_db.tb_klaim
                            INNER JOIN webapps_db.tb_cob ON klaimapps_db.tb_klaim.cob_id = webapps_db.tb_cob.id
                            WHERE
                            klaimapps_db.tb_klaim.id = ' . $klaimId);

            if (!empty($r->file(['fileUp']))) {
                for ($i = 0; $i < count($r->file('fileUp')); $i++) {
                    $fileup = $r->file(['fileUp'])[$i];

                    if (!empty($fileup)) {
                        $extension = $fileup->getClientOriginalName(); // getting image extension
                        $fileName = $extension;
                        $fileName = str_replace("#", " ", $fileName);
                        $destinationPath = 'upload/' . $cob[0]->cob_code . '/' . $klaimId;
                        $fileup->move($destinationPath, $fileName);
                        $upload = new tb_uploads;
                        $upload->klaim_id = $klaimId;
                        $upload->file_name = $fileName;
                        $upload->file_path = $destinationPath;
                        $upload->date_uploaded = date('Y-m-d', strtotime(now()));
                        $upload->klaim_cob = $cob[0]->cob_code;
                        $upload->status = $r->stat;
                        $upload->save();
                    }
                }
            }

            $log = new tb_klaim_log;
            $log->klaim_id = $klaimId;
            $log->klaim_stat_id = 1;
            $log->user_id = Auth::user()->id;
            $log->save();

            $datalog = tb_klaim::find($klaimId);
            $datalog->klaim_log_id = $log->id;
            $datalog->save();

//            self::teleNotification($klaimId);
            for ($i = 0; $i < count($r->insr_id); $i++) {
                $ins = new tb_klaim_ins;
                $ins->klaim_id = $klaim->id;
                $ins->insr_id = $r->insr_id[$i];
                $ins->share = $r->share[$i];
                $ins->est_amt = str_replace(",", "", $r->estimationInsAmt[$i]);
                $ins->claim_amt = str_replace(",", "", $r->claimInsAmt[$i]);
                $ins->deduct_amt = str_replace(",", "", $r->deducInsAmt[$i]);
                $ins->recv_amt = str_replace(",", "", $r->recoveryInsAmt[$i]);
                $ins->net_claim = str_replace(",", "", $r->netInsAmt[$i]);
                $ins->save();
            }

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil menyimpan data!',
            ], 200);

        } catch (Throwable $exception) {
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }

    public function detailClaim(){

    }
}
