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
                $client[0]->report_date = date("d-m-Y", strtotime($client[0]->report_date));

                $clientInfo = DB::select("CALL klaimapps_db.getClientInfo(?,?)", [$client[0]->prod_no, $client[0]->draft_no]);
                if ($clientInfo) {
                    $clientInfo[0]->periode = HelperController::changeDate($clientInfo[0]->start_dd) . ' s/d ' . HelperController::changeDate($clientInfo[0]->end_dd);
                    $clientInfo[0]->start_dd = date("d-m-Y", strtotime($clientInfo[0]->start_dd));
                    $clientInfo[0]->end_dd = date("d-m-Y", strtotime($clientInfo[0]->end_dd));
                }
            }

            if (!empty($upd)) 
            {   
                foreach ($upd as $u) 
                {
                    $u->date_uploaded = date("d-m-Y", strtotime($u->date_uploaded));
                }
            }

            if (!empty($log)) 
            {   
                foreach($log as $l)
                {
                    $l->created_at = date("d-m-Y H:i:s", strtotime($l->created_at));
                }
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

            array_unshift($cob, array(
                "id" => 0,
                "cob_code" => 'All COB',
                "cob_desc" => 'All COB'
            ));

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
            $listIns = DB::select("CALL klaimapps_db.dataTable_claim(?,?)", [$r->typeStatus,$r->typeCOB]);

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

    public function validation(Request $r)
    {
        try 
        {   
            if ($r->statusId == 6 && empty($r->$ins)) 
            {
                return response()->json([
                    'status'  => 500,
                    'message' => 'Harap pilih asuransi!',
                ], 500);
            }

            $logId = DB::table('klaimapps_db.tb_klaim_log')->insertGetId([
                'klaim_id'      => $r->klaimId,
                'klaim_stat_id' => $r->statusId,
                'description'   => $r->description,
                'user_id'       => Auth::user()->id,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            DB::table('klaimapps_db.tb_klaim')->where('id', $r->klaimId)->update([
                'klaim_log_id' => $logId,
                'user_update'  => Auth::user()->id,
                'updated_at'   => now(),
            ]);

            $cob_code = (!empty($r->cobId)) ? DB::table('webapps_db.tb_cob')->where('id', $r->cobId)->value('cob_code') : 0;

            if ($r->statusId == 6) 
            {
                for ($i=0; $i < count($r->ins); $i++) 
                { 
                    DB::table('klaimapps_db.tb_klaim_ins')->where('insr_id', $r->ins[$i])->where('klaim_id', $r->klaimId)->update([
                        'paid_dd' => date('Y-m-d', strtotime($r->paid_date))
                    ]);
                }
            }

            if (!empty($r->file(['fileUpd']))) 
            {
                for ($i = 0; $i < count($r->file(['fileUpd'])); $i++) 
                {
                    $fileup = $r->file(['fileUpd'])[$i];

                    $extension = $fileup->getClientOriginalName(); // getting image extension
                    $fileName  = $extension;
                    $fileName  = str_replace("#", " ", $fileName);
                    $destinationPath = 'upload/' . $cob_code . '/' . $r->klaimId;
                    $fileup->move($destinationPath, $fileName);

                    DB::table('klaimapps_db.tb_uploads')->insert([
                        'klaim_id'      => $r->klaimId,
                        'file_name'     => $fileName,
                        'file_path'     => $destinationPath,
                        'date_uploaded' => now(),
                        'klaim_cob'     => $cob_code,
                        'status'        => $r->statusId,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);
                }
            }

            return response()->json([
                'status' => 200,
            ], 200);
        } 
        catch (Throwable $exception) 
        {
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal menyimpan data! Silahkan coba lagi.',
            ], 500);
        }
    }

    public function rollback(Request $r)
    {
        try
        {
            $lastId = DB::select('SELECT
                kl.id, 
                kl.klaim_id, 
                kl.klaim_stat_id
            FROM
                klaimapps_db.tb_klaim_log AS kl
            WHERE
                kl.klaim_id = '.$r->klaimId.'
            ORDER BY
                kl.created_at DESC
            LIMIT 1');

            if (empty($lastId)) 
            {
                return response()->json([
                    'status'  => 500,
                    'message' => 'Gagal memuat data! Silahkan coba lagi.',
                ], 500);
            }

            if ($lastId[0]->klaim_stat_id == 1) 
            {
                return response()->json([
                    'status'  => 500,
                    'message' => 'Status terakhir tidak boleh laporan awal klaim!.',
                ], 500);
            }

            DB::table('klaimapps_db.tb_klaim_log')->where('id', $lastId[0]->id)->delete();

            $rollbackId = $lastId = DB::select('SELECT
                kl.id, 
                kl.klaim_id, 
                kl.klaim_stat_id
            FROM
                klaimapps_db.tb_klaim_log AS kl
            WHERE
                kl.klaim_id = '.$r->klaimId.'
            ORDER BY
                kl.created_at DESC
            LIMIT 1');

            DB::table('klaimapps_db.tb_klaim')->where('id', $r->klaimId)->update([
                'klaim_log_id' => $rollbackId[0]->id,
                'user_update'  => Auth::user()->id,
                'updated_at'   => now(),
            ]);

            return response()->json([
                'status' => 200,
            ], 200);
        }
        catch (Throwable $exception) 
        {
            Log::error($exception);

            return response()->json([
                'status'  => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }
}
