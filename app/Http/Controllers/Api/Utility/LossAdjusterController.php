<?php

namespace App\Http\Controllers\Api\Utility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Log;
use Throwable;

class LossAdjusterController extends Controller
{
    public function index()
    {
        try
        {   
            $data = DB::select('SELECT
                klaimapps_db.tb_loss_adjuster.id,
                IFNULL( klaimapps_db.tb_loss_adjuster.`name`, "-" ) adj_name,
                IFNULL( klaimapps_db.tb_loss_adjuster.pic, "-" ) adj_pic,
                IFNULL( klaimapps_db.tb_loss_adjuster.email, "-" ) adj_email,
                IFNULL( klaimapps_db.tb_loss_adjuster.phone_no, "-" ) adj_phone 
            FROM
                klaimapps_db.tb_loss_adjuster 
            WHERE
                klaimapps_db.tb_loss_adjuster.id <> 0');

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
