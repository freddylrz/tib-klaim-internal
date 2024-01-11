<?php

namespace App\Http\Controllers\Api\Data_Claim;

use App\Http\Helper\HelperController;
use App\Models\tb_klaim;
use App\Models\tb_klaim_log;
use App\Models\tb_klaim_ins;
use App\Models\tb_uploads;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Log;
use DB;
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

            $cob = DB::select(
                'SELECT
                        webapps_db.tb_cob.id,
                        webapps_db.tb_cob.cob_code,
                        CONCAT(webapps_db.tb_cob.cob_code," | ",webapps_db.tb_cob.cob_name) as cob_desc
                    FROM
                        webapps_db.tb_cob
                    WHERE
                        webapps_db.tb_cob.cob_code <> " "');

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
                'cob' => $cob,
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

 public function inputAssetManual(Request $r)
    {
        try {
            $client = DB::select(
                'SELECT
                webapps_db.tb_client.id as clientId,
                webapps_db.tb_client.name as clientName
                FROM
                webapps_db.tb_client');

            $ins = DB::select(
                'SELECT
                    user_db.tb_security.insr_id as insrId,
                    user_db.tb_security.crt_name AS insrName
                FROM
                    user_db.tb_security
                    WHERE user_db.tb_security.id <> 0');

            return response()->json([
                'status' => 200,
                'client' => $client,
                'insurance' => $ins,
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
            if ($data) {
                foreach ($data as $dt)
                    $dt->periode = HelperController::changeDate($dt->start_date) . ' s/d ' . HelperController::changeDate($dt->end_date);
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

    public function getDataClient(Request $r)
    {
        try {
            $data = DB::select("CALL klaimapps_db.getClientInfo(?,?)", [$r->get("prod_no"), $r->get("draft_no")]);
            if ($data) {
                $data[0]->periode = HelperController::changeDate($data[0]->start_dd) . ' s/d ' . HelperController::changeDate($data[0]->end_dd);
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
            $prem = DB::select("CALL klaimapps_db.getPremiumInfo(?,?)", [$r->get("draft_no"), $r->get("prod_no")]);
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
            if ($r->get('type') == 1) {
                $listIns = DB::select("CALL klaimapps_db.getPremiumInsrInfo(?,?,?,?)", ['3', $r->get("draft_no"), '', '']);
            } else {
                $listIns = DB::select("select user_db.tb_security.crt_name AS insName,
               kins.id AS insId,
               CONCAT( FORMAT( kins.share, 2 ), ' %' ) AS insShare,
               kins.share AS share,
               IFNULL( kins.paid_dd, '-' ) AS insPaidDD,
               IF ( x.created_at IS NULL OR kins.paid_dd IS NULL, 0, DATEDIFF( x.created_at,kins.paid_dd )) AS insAging
              FROM
               klaimapps_db.tb_klaim_ins AS kins
               LEFT JOIN user_db.tb_security ON kins.insr_id = user_db.tb_security.insr_id
               LEFT JOIN ( SELECT kl.created_at, kl.klaim_id FROM klaimapps_db.tb_klaim_log AS kl WHERE kl.klaim_id = 8368 AND kl.klaim_stat_id = 5 ) AS x ON kins.klaim_id = x.klaim_id
              WHERE
               kins.klaim_id = " . $r->get("draft_no") . " ORDER BY kins.share DESC");
            }
            $eAmnt = str_replace(",", "", $r->get('estAmt'));
            $cAmnt = str_replace(",", "", $r->get('claimAmt'));
            $dAmnt = str_replace(",", "", $r->get('deducAmt'));
            $rAmnt = str_replace(",", "", $r->get('recoveryAmt'));
            $sum = $cAmnt - $dAmnt - $rAmnt;

            if (!empty($listIns)) {
                $sisaNet = $sum;
                $sisaEst = $eAmnt;
                $sisaClaim = $cAmnt;
                $sisaDeduc = $dAmnt;
                $sisaRec = $rAmnt;
                for ($i = 0; $i < count($listIns); $i++) {
                    if ($r->get('type') == 1)
                        $share = $listIns[$i]->share_pct / 100;
                    else
                        $share = $listIns[$i]->share / 100;

                    if ($i != count($listIns) - 1 || $i == 0) {
                        //net
                        $netShare = $sum * $share;
                        $sisaNet = $sisaNet - $netShare;

                        //est
                        $estShare = $eAmnt * $share;
                        $sisaEst = $sisaEst - $estShare;

                        //claim
                        $claimShare = $cAmnt * $share;
                        $sisaClaim = $sisaClaim - $claimShare;

                        //deduc
                        $deducShare = $dAmnt * $share;
                        $sisaDeduc = $sisaDeduc - $deducShare;

                        //recov
                        $recShare = $rAmnt * $share;
                        $sisaRec = $sisaRec - $recShare;

                        $listIns[$i]->estAmt = number_format($estShare, 2);
                        $listIns[$i]->claimAmt = number_format($claimShare, 2);
                        $listIns[$i]->deducAmt = number_format($deducShare, 2);
                        $listIns[$i]->recovAmt = number_format($recShare, 2);
                        $listIns[$i]->netAmt = number_format($netShare, 2);

                    } else {
                        $listIns[$i]->estAmt = number_format($sisaEst, 2);
                        $listIns[$i]->claimAmt = number_format($sisaClaim, 2);
                        $listIns[$i]->deducAmt = number_format($sisaDeduc, 2);
                        $listIns[$i]->recovAmt = number_format($sisaRec, 2);
                        $listIns[$i]->netAmt = number_format($sisaNet, 2);
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

    public function getClaimAmountManual(Request $r)
    {
        try {
            $eAmnt = str_replace(",", "", $r->get('estAmt'));
            $cAmnt = str_replace(",", "", $r->get('claimAmt'));
            $dAmnt = str_replace(",", "", $r->get('deducAmt'));
            $rAmnt = str_replace(",", "", $r->get('recoveryAmt'));
            $sum = $cAmnt - $dAmnt - $rAmnt;

            if (!empty($r->get('ins'))) {
                $sisaNet = $sum;
                $sisaEst = $eAmnt;
                $sisaClaim = $cAmnt;
                $sisaDeduc = $dAmnt;
                $sisaRec = $rAmnt;
                for ($i = 0; $i < count($r->get('ins')); $i++) {
//                    dd($r->get('ins')[$i]['share']);
                    $share = $r->get('ins')[$i]['share'] / 100;

                    if ($i != count($r->get('ins')) - 1 || $i == 0) {
                        //net
                        $netShare = $sum * $share;
                        $sisaNet = $sisaNet - $netShare;

                        //est
                        $estShare = $eAmnt * $share;
                        $sisaEst = $sisaEst - $estShare;

                        //claim
                        $claimShare = $cAmnt * $share;
                        $sisaClaim = $sisaClaim - $claimShare;

                        //deduc
                        $deducShare = $dAmnt * $share;
                        $sisaDeduc = $sisaDeduc - $deducShare;

                        //recov
                        $recShare = $rAmnt * $share;
                        $sisaRec = $sisaRec - $recShare;

                        $estAmt = number_format($estShare, 2);
                        $claimAmt = number_format($claimShare, 2);
                        $deducAmt = number_format($deducShare, 2);
                        $recovAmt = number_format($recShare, 2);
                        $netAmt = number_format($netShare, 2);

                    } else {
                        $estAmt = number_format($sisaEst, 2);
                        $claimAmt = number_format($sisaClaim, 2);
                        $deducAmt = number_format($sisaDeduc, 2);
                        $recovAmt = number_format($sisaRec, 2);
                        $netAmt = number_format($sisaNet, 2);
                    }
                    $arr [] = array(
                        "insId" => $r->get('ins')[$i]['insId'],
                        "insShare" => number_format($r->get('ins')[$i]['share'],2).' %',
                        "share" => number_format($r->get('ins')[$i]['share'],2),
                        "estAmt" => $estAmt,
                        "claimAmt" => $claimAmt,
                        "deducAmt" => $deducAmt,
                        "recovAmt" => $recovAmt,
                        "netAmt" => $netAmt
                    );
                }
            }

            return response()->json([
                'status' => 200,
                'data' => $arr,
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
        try {
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
            $klaim->insd_id = $r->insdId;
            $klaim->name_wrt = $r->name_wrt;
            $klaim->pol_no = $r->pol_no;
            $klaim->dol = date('Y-m-d', strtotime($r->dol));
            $klaim->report_date = date('Y-m-d', strtotime($r->reportDate));
            $klaim->report_source = $r->reportSource;
            $klaim->interest = $r->interest;
            $klaim->location = $r->location;
            $klaim->caused = $r->caused;
            $klaim->ladj = $r->lossAdj;
            $klaim->cur = $r->curr_id;
            $klaim->est_amt = str_replace(",", "", $r->estimationAmt);
            $klaim->claim_amt = str_replace(",", "", $r->claimAmt);
            $klaim->deduct_amt = str_replace(",", "", $r->deducAmt);
            $klaim->recv_amt = str_replace(",", "", $r->recoveryAmt);
            $klaim->net_amt = str_replace(",", "", $r->netAmt);
            $klaim->user_add = Auth::user()->id;
            $klaim->cob_id = $r->cob_id;
            $klaim->ws_id = $r->workshop;
            $klaim->start_dd = date('Y-m-d', strtotime($r->start_dd));
            $klaim->end_dd = date('Y-m-d', strtotime($r->end_dd));
            $klaim->premi = str_replace(",", "", $r->premi);
            $klaim->tsi = str_replace(",", "", $r->tsi);

            $klaim->save();

            $klaimId = $klaim->id;

            try {
                if (!empty($klaimId)) {
                    for ($i = 0; $i < count($r->insr_id); $i++) {
                        $ins = new tb_klaim_ins;
                        $ins->klaim_id = $klaimId;
                        $ins->insr_id = $r->insr_id[$i];
                        $ins->curr_id = $r->curr_id;
                            $ins->share = $r->share[$i];
                        $ins->est_amt = str_replace(",", "", $r->estimationInsAmt[$i]);
                        $ins->claim_amt = str_replace(",", "", $r->claimInsAmt[$i]);
                        $ins->deduct_amt = str_replace(",", "", $r->deducInsAmt[$i]);
                        $ins->recv_amt = str_replace(",", "", $r->recoveryInsAmt[$i]);
                        $ins->net_claim = str_replace(",", "", $r->netInsAmt[$i]);
                        $ins->premi = str_replace(",", "", $r->premiIns[$i]);

                        $ins->save();
                        $insId [] = $ins->id;
                    }
                }
            } catch (Throwable $exception) {
                if (isset($insId)) {
                    for ($i = 0; $i < count($insId); $i++) {
                        tb_klaim_ins::where('id', $insId[$i])->delete();
                    }
                }
                tb_klaim::where('id', $klaimId)->delete();
                Log::error($exception);
                throw $exception;

            }

            try {
                if (!empty($klaimId)) {
                    if (!empty($r->file(['fileUp']))) {
                        $uploadId = $this->uploadFile($klaimId, $r->file(['fileUp']), $r->cob_code,1);
                    }
                }
            } catch (Throwable $exception) {
                if (isset($insId)) {
                    for ($i = 0; $i < count($insId); $i++) {
                        tb_klaim_ins::where('id', $insId[$i])->delete();
                    }
                }
                if (isset($uploadId)) {
                    for ($i = 0; $i < count($uploadId); $i++) {
                        tb_uploads::where('id', $uploadId[$i])->delete();
                    }
                }

                tb_klaim::where('id', $klaimId)->delete();
                Log::error($exception);
                throw $exception;

            }

            try {
                $log = new tb_klaim_log;
                $log->klaim_id = $klaimId;
                $log->klaim_stat_id = 1;
                $log->user_id = Auth::user()->id;
                $log->save();

                $datalog = tb_klaim::find($klaimId);
                $datalog->klaim_log_id = $log->id;
                $datalog->save();
            } catch (Throwable $exception) {
                if (isset($insId)) {
                    for ($i = 0; $i < count($insId); $i++) {
                        tb_klaim_ins::where('id', $insId[$i])->delete();
                    }
                }
                if (isset($uploadId)) {
                    for ($i = 0; $i < count($uploadId); $i++) {
                        tb_uploads::where('id', $uploadId[$i])->delete();
                    }
                }
                tb_klaim_log::where('id', $log->id)->delete();
                tb_klaim::where('id', $klaimId)->delete();
                Log::error($exception);
                throw $exception;
            }

            ////            self::teleNotification($klaimId);

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil menyimpan data!',
                'klaimId' => $klaimId
            ], 200);

        } catch (Throwable $exception) {
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }

    public function uploadFile($klaimId, $fileUpd, $cob_code, $stat){
        for ($i = 0; $i < count($fileUpd); $i++) {
            $fileup = $fileUpd[$i];

            if (!empty($fileup)) {
                $extension = $fileup->getClientOriginalName(); // getting image extension
                $fileName = $extension;
                $fileName = str_replace("#", " ", $fileName);
                $destinationPath = 'upload/' . $cob_code . '/' . $klaimId;
                $fileup->move($destinationPath, $fileName);
                $upload = new tb_uploads;
                $upload->klaim_id = $klaimId;
                $upload->file_name = $fileName;
                $upload->file_path = $destinationPath;
                $upload->date_uploaded = date('Y-m-d', strtotime(now()));
                $upload->klaim_cob = $cob_code;
                $upload->status = $stat;
                $upload->save();
                $uploadId [] = $upload->id;
            }
        }
        return $uploadId;
    }

    public function deleteUpload(Request $r)
    {
        try {
            $upload = DB::select('SELECT
                 klaimapps_db.tb_uploads.*
                FROM
                 klaimapps_db.tb_uploads
                WHERE
                 klaimapps_db.tb_uploads.id = ' . $r->fileId);

            $delup = tb_uploads::findOrFail($upload[0]->id);

            if (!empty($delup->file_path . '/' . $delup->file_name)) {
                if(!empty($delup->file_path) && file_exists($delup->file_path)){
                    unlink(public_path($delup->file_path . '/' . $delup->file_name));
                }
            }

            $delup->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil menghapus dokumen!',
                'document' =>  DB::select('SELECT
                                 klaimapps_db.tb_uploads.*
                                FROM
                                 klaimapps_db.tb_uploads
                                WHERE
                                 klaimapps_db.tb_uploads.klaim_id = ' . $delup->klaim_id)

            ], 200);

        } catch (Throwable $exception) {
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal menghapus dokumen! Silahkan coba lagi.',
            ], 500);
        }

    }

    public function updateClaim(Request $r)
    {
        try {
            $klaim = tb_klaim::find($r->claimId);
            $klaim->claim_dd = date('Y-m-d H:i:s', strtotime(now()));
            $klaim->dol = date('Y-m-d', strtotime($r->dol));
            $klaim->report_date = date('Y-m-d', strtotime($r->reportDate));
            $klaim->report_source = $r->reportSource;
            $klaim->interest = $r->interest;
            $klaim->location = $r->location;
            $klaim->caused = $r->caused;
            $klaim->ladj = $r->lossAdj;
            $klaim->cur = $r->curr_id;
            $klaim->est_amt = str_replace(",", "", $r->estimationAmt);
            $klaim->claim_amt = str_replace(",", "", $r->claimAmt);
            $klaim->deduct_amt = str_replace(",", "", $r->deducAmt);
            $klaim->recv_amt = str_replace(",", "", $r->recoveryAmt);
            $klaim->net_amt = str_replace(",", "", $r->netAmt);
            $klaim->user_update = Auth::user()->id;
            $klaim->cob_id = $r->cob_id;
            $klaim->ws_id = $r->workshop;

            $klaim->save();

            $listIns = DB::select('SELECT
                 klaimapps_db.tb_klaim_ins.*
                FROM
                 klaimapps_db.tb_klaim_ins
                WHERE
                 klaimapps_db.tb_klaim_ins.klaim_id = ' . $r->claimId);

            for ($i = 0; $i < count($r->insr_id); $i++) {
                $ins = tb_klaim_ins::find($listIns[$i]->id);
                $ins->curr_id = $r->curr_id;
                $ins->est_amt = str_replace(",", "", $r->estimationInsAmt[$i]);
                $ins->claim_amt = str_replace(",", "", $r->claimInsAmt[$i]);
                $ins->deduct_amt = str_replace(",", "", $r->deducInsAmt[$i]);
                $ins->recv_amt = str_replace(",", "", $r->recoveryInsAmt[$i]);
                $ins->net_claim = str_replace(",", "", $r->netInsAmt[$i]);

                $ins->save();
            }

            if (!empty($r->file(['fileUp']))) {
                $this->uploadFile($r->claimId, $r->file(['fileUp']), $r->cob_code,1);
            }

            ////            self::teleNotification($klaimId);

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil menyimpan data!',
                'klaimId' => $r->claimId
            ], 200);

        } catch (Throwable $exception) {
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }
}
