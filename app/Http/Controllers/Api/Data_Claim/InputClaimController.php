<?php

namespace App\Http\Controllers\Api\Data_Claim;

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
    public function getDataTable(Request $r){
        try{
            $data = DB::select("CALL klaimapps_db.getPolis(?,?)",[$r->get("type"),$r->get("search")]);

            return response()->json([
                'status' => 200,
                'data' => $data,
            ], 200);
        }catch (Throwable $exception){
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }
    public function getDataClient(Request $r){
        try{
            $data = DB::select("CALL klaimapps_db.getClientInfo(?)",[$r->get("prod_no")]);
            return response()->json([
                'status' => 200,
                'data' => $data,
            ], 200);
        }catch (Throwable $exception){
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }
    public function getDataPremium(Request $r){
        try{
            $prem = DB::select("CALL klaimapps_db.getPremiumInfo(?)",[$r->get("prod_no")]);
            $listIns = DB::select("CALL klaimapps_db.getPremiumInsrInfo(?,?,?,?)",['1',$r->get("draft_no"),'','']);

            if($listIns)
                $premIns = DB::select("CALL klaimapps_db.getPremiumInsrInfo(?,?,?,?)",['2',$r->get("draft_no"),$r->get("prod_no"),$listIns[0]->insr_id]);

            foreach ($listIns as $l){
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
        }catch (Throwable $exception){
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }
    public function getDataIns(Request $r){
        try{
            $listIns = DB::select("CALL klaimapps_db.getPremiumInsrInfo(?,?,?,?)",['3',$r->get("draft_no"),'','']);

            foreach ($listIns as $l){
                $l->claimAmt = 0;
                $l->deducAmt = 0;
                $l->recovAmt = 0;
                $l->netAmt = 0;
            }

            return response()->json([
                'status' => 200,
                'data' => $listIns,
            ], 200);
        }catch (Throwable $exception){
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }
    public function getClaimAmount(Request $r){
        try{
            $listIns = DB::select("CALL klaimapps_db.getPremiumInsrInfo(?,?,?,?)",['3',$r->get("draft_no"),'','']);
            if($listIns) {
                $cAmnt = str_replace(",", "",$r->get('claimAmt'));
                $dAmnt = str_replace(",", "",$r->get('deducAmt'));
                $rAmnt = str_replace(",", "",$r->get('recoveryAmt'));
                $sum = $cAmnt-$dAmnt-$rAmnt;
                $sisaNet = 0;$sisaClaim = 0;$sisaDeduc = 0;$sisaRec = 0;
                for($i = 0; $i < count($listIns); $i++){
                    if($i != count($listIns)-1){
                        //net
                        $netShare = $sum*($listIns[$i]->share_pct/100);
                        $sisaNet = $sum - $netShare;

                        //claim
                        $claimShare = $cAmnt*($listIns[$i]->share_pct/100);
                        $sisaClaim = $cAmnt - $claimShare;

                        //deduc
                        $deducShare = $dAmnt*($listIns[$i]->share_pct/100);
                        $sisaDeduc = $dAmnt - $deducShare;

                        //recov
                        $recShare = $rAmnt*($listIns[$i]->share_pct/100);
                        $sisaRec = $rAmnt - $recShare;
                        $amt[] = array(
                            "insr_id" => $listIns[$i]->insr_id,
                            "claimDesc" => number_format($claimShare,0),
                            "deducDesc" => number_format($deducShare,0),
                            "recoveryDesc" => number_format($recShare,0),
                            "netDesc" => number_format($netShare,0)
                        );
                    }else{
                        $amt[] = array(
                            "insr_id" => $listIns[$i]->insr_id,
                            "claimDesc" => number_format($sisaClaim,0),
                            "deducDesc" => number_format($sisaDeduc,0),
                            "recoveryDesc" => number_format($sisaRec,0),
                            "netDesc" => number_format($sisaNet,0)
                        );
                    }
                }
            }

            return response()->json([
                'status' => 200,
                'data' => $amt,
                'netClaimAmt' => number_format($sum,0)
            ], 200);
        }catch (Throwable $exception){
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }
}
