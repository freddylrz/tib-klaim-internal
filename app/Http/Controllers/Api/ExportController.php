<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Log;
use Throwable;

class ExportController extends Controller
{
    public function index(Request $r)
    {
        try
        {   
            $cob = DB::select('SELECT
                0 AS cob_id,
                "Semua COB" AS cob_code UNION
            SELECT
                x.cob_id,
                webapps_db.tb_cob.cob_code 
            FROM
                ( SELECT tb_klaim.cob_id FROM klaimapps_db.tb_klaim WHERE tb_klaim.cob_id IS NOT NULL GROUP BY tb_klaim.cob_id ) AS x
                INNER JOIN webapps_db.tb_cob ON x.cob_id = webapps_db.tb_cob.id');

            $statusKlaim = array(
                array(
                    "id"   => 0,
                    "desc" => "Semua Status",
                ),
                array(
                    "id"   => 1,
                    "desc" => "Laporan Awal",
                ),
                array(
                    "id"   => 2,
                    "desc" => "On Process",
                ),
                array(
                    "id"   => 3,
                    "desc" => "Settled",
                ),
                array(
                    "id"   => 4,
                    "desc" => "Proses Bayar",
                ),
                array(
                    "id"   => 5,
                    "desc" => "Final",
                ),
                array(
                    "id"   => 6,
                    "desc" => "Ditolak",
                ),
            );

            $workshop = DB::select('SELECT
                w.id, 
                w.`name`
            FROM
                klaimapps_db.tb_workshop AS w
            WHERE
                w.id <> 0'); 

            $lossAdj = DB::select('SELECT
                0 AS id, 
                "Semua Data" AS `name` UNION
            SELECT
                l.id, 
                l.`name`
            FROM
                klaimapps_db.tb_loss_adjuster AS l
            WHERE
                l.id <> 0');        

            return response()->json([
                'status'      => 200,
                'cob'         => $cob,
                'statusKlaim' => $statusKlaim,
                'workshop'    => $workshop,
                'lossAdj'     => $lossAdj,
            ], 200); 
        }
        catch (Throwable $exception)
        {   
            Log::error($exception); 

            return response()->json([
                'status' => 500
            ], 500); 
        }
    }
}
