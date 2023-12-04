<?php

namespace App\Http\Controllers\Api\Data_Claim;

use App\Http\Helper\HelperController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Log;
use Throwable;

class DataClaimController extends Controller
{
    public function detailClaim(Request $r)
    {
        try {
            $client = DB::select("CALL klaimapps_db.detail_claim(?,?)", [$r->get("claimId"), 1]);
            $upd = DB::select("CALL klaimapps_db.detail_claim(?,?)", [$r->get("claimId"), 2]);
            $Ins = DB::select("CALL klaimapps_db.detail_claim(?,?)", [$r->get("claimId"), 3]);
            $log = DB::select("CALL klaimapps_db.detail_claim(?,?)", [$r->get("claimId"), 4]);
            if (!empty($client)) {
                $client[0]->dol = date("d-m-Y", strtotime($client[0]->dol));

                $clientInfo = DB::select("CALL klaimapps_db.getClientInfo(?,?)", [$client[0]->prod_no, $client[0]->draft_no]);
                if ($clientInfo) {
                    $clientInfo[0]->periode = HelperController::changeDate($clientInfo[0]->start_dd) . ' s/d ' . HelperController::changeDate($clientInfo[0]->end_dd);
                    $clientInfo[0]->start_dd = date("d-m-Y", strtotime($clientInfo[0]->start_dd));
                    $clientInfo[0]->end_dd = date("d-m-Y", strtotime($clientInfo[0]->end_dd));
                }
            }
            if (!empty($upd)) {
                $upd[0]->date_uploaded = date("d-m-Y", strtotime($upd[0]->date_uploaded));
            }
            if (!empty($log)) {
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


    public function assetDatatable(Request $r)
    {
        try {
            $filter = array(
                array(
                    "type" => 1,
                    "filterDesc" => 'All Status'
                ),
                array(
                    "type" => 2,
                    "filterDesc" => 'Laporan Awal Klaim'
                ),
                array(
                    "type" => 3,
                    "filterDesc" => 'On Process'
                ),
                array(
                    "type" => 4,
                    "filterDesc" => 'Settled'
                ),
                array(
                    "type" => 5,
                    "filterDesc" => 'Proses Klaim Dibayar'
                ),
                array(
                    "type" => 6,
                    "filterDesc" => 'Proses Final'
                ),
                array(
                    "type" => 7,
                    "filterDesc" => 'Final'
                ),
                array(
                    "type" => 8,
                    "filterDesc" => 'Ditolak'
                ),
            );

            $cob = DB::select(
                'SELECT
                        webapps_db.tb_cob.id,
                        webapps_db.tb_cob.cob_code,
                        CONCAT(webapps_db.tb_cob.cob_code," | ",webapps_db.tb_cob.cob_name) as cob_desc
                    FROM
                        webapps_db.tb_cob
                    WHERE
                        webapps_db.tb_cob.cob_code <> " "');

            return response()->json([
                'status' => 200,
                'listStatus' => $filter,
                'listCOB' => $cob,
            ], 200);
        } catch (Throwable $exception) {
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }
    public function listClaim(Request $r)
    {

        try {
            $listIns = DB::select("CALL klaimapps_db.dataTable_claim(?)", [$r->type]);

            return response()->json([
                'status' => 200,
                'list' => $listIns,
            ], 200);
        } catch (Throwable $exception) {
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }

    public function updateClaim()
    {
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
