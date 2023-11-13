<?php

namespace App\Http\Controllers\Api\Utility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Log;
use Throwable;

class CauseOfLossController extends Controller
{
    public function index()
    {
        try
        {   
            $data = DB::select('SELECT
                klaimapps_db.tb_caused.id, 
                klaimapps_db.tb_caused.cob_desc, 
                klaimapps_db.tb_caused.description
            FROM
                klaimapps_db.tb_caused
            WHERE
                klaimapps_db.tb_caused.id <> 0');

            return response()->json([
                'status'  => 200,
                'message' => 'Berhasil memuat data!',
                'data'    => $data,
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
