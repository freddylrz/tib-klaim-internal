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

class DataClaimController extends Controller
{
    public function detailClaim(Request $r){
        try {
            $client = DB::select("CALL klaimapps_db.detail_claim(?,?)", [$r->get("claimId"),1]);
            $upd = DB::select("CALL klaimapps_db.detail_claim(?,?)", [$r->get("claimId"),2]);
            $Ins = DB::select("CALL klaimapps_db.detail_claim(?,?)", [$r->get("claimId"),3]);
            $log = DB::select("CALL klaimapps_db.detail_claim(?,?)", [$r->get("claimId"),4]);
            if(!empty($client)){
                $client[0]->dol = date("d-m-Y", strtotime($client[0]->dol));

                $clientInfo = DB::select("CALL klaimapps_db.getClientInfo(?,?)", [ $client[0]->prod_no, $client[0]->draft_no]);
                if($clientInfo){
                    $clientInfo[0]->periode =  HelperController::changeDate($clientInfo[0]->start_dd).' s/d '.HelperController::changeDate($clientInfo[0]->end_dd);
                    $clientInfo[0]->start_dd = date("d-m-Y", strtotime($clientInfo[0]->start_dd));
                    $clientInfo[0]->end_dd = date("d-m-Y", strtotime($clientInfo[0]->end_dd));
                }
            }
            if(!empty($upd)){
                $upd[0]->date_uploaded = date("d-m-Y", strtotime($upd[0]->date_uploaded));
            }
            if(!empty($log)){
                $log[0]->created_at = date("d-m-Y H:i:s", strtotime($log[0]->created_at));
            }
            return response()->json([
                'status' => 200,
                'clientInfo' => $clientInfo,
                'clientData' => $client,
                'Ins' => $Ins,
                'dokument' => $upd,
                'log' => $log,
            ], 200);
        } catch (Throwable $exception) {
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }
    public function listClaim(){
        try {

            return response()->json([
                'status' => 200,
            ], 200);
        } catch (Throwable $exception) {
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }
    public function updateClaim(){
        try {

            return response()->json([
                'status' => 200,
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
