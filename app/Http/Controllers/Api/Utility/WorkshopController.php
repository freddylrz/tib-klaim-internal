<?php

namespace App\Http\Controllers\Api\Utility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Log;
use Throwable;

class WorkshopController extends Controller
{
    public function index()
    {
        try
        {   
            $data = DB::select('SELECT
                klaimapps_db.tb_workshop.id,
                IFNULL( klaimapps_db.tb_workshop.`name`, "-" ) ws_name,
                IFNULL( klaimapps_db.tb_workshop.pic, "-" ) ws_pic,
                IFNULL( klaimapps_db.tb_workshop.email, "-" ) ws_email,
                IFNULL( klaimapps_db.tb_workshop.phone_no, "-" ) ws_phone 
            FROM
                klaimapps_db.tb_workshop 
            WHERE
                klaimapps_db.tb_workshop.id <> 0');

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
