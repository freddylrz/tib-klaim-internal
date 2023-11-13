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

    public function insert(Request $r)
    {
        try
        {   
            $getId = DB::table('klaimapps_db.tb_loss_adjuster')->insertGetId([
                'foxpro_id'     => 0,
                'name'          => $r->name,
                'address'       => $r->address,
                'post_code'     => $r->post_code,
                'phone_no'      => $r->phone_no,
                'fax_no'        => $r->fax_no,
                'email'         => $r->email,
                'pic'           => $r->pic,
                'pic_email'     => $r->pic_email,
                'pic_no'        => $r->pic_no,
                'npwp'          => $r->npwp,
                'userId_add'    => Auth::user()->id,
                'userId_update' => Auth::user()->id,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            return response()->json([
                'status'    => 200,
                'message'   => 'Berhasil menyimpan data!',
                'lossAdjId' => $getId,
            ], 200); 
        }
        catch (Throwable $exception)
        {   
            Log::error($exception); 

            return response()->json([
                'status'  => 500,
                'message' => 'Gagal menyimpan data! Silahkan coba lagi.',
            ], 500); 
        }
    }

    public function detail(Request $r)
    {
        try
        {   
            $data = DB::select('SELECT
                l.id,
                l.`name`,
                IFNULL( l.address, "-" ) address,
                IFNULL( l.post_code, "-" ) post_code,
                IFNULL( l.phone_no, "-" ) phone_no,
                IFNULL( l.fax_no, "-" ) fax_no,
                IFNULL( l.email, "-" ) email,
                IFNULL( l.pic, "-" ) pic,
                IFNULL( l.pic_email, "-" ) pic_email,
                IFNULL( l.pic_no, "-" ) pic_no,
                IFNULL( l.npwp, "-" ) npwp
            FROM
                klaimapps_db.tb_loss_adjuster AS l 
            WHERE
                l.id = '.$r->get('lossAdjId'));

            return response()->json([
                'status'  => 200,
                'message' => 'Berhasil menyimpan data!',
                'data'    => $data,
            ], 200); 
        }
        catch (Throwable $exception)
        {   
            Log::error($exception); 

            return response()->json([
                'status'  => 500,
                'message' => 'Gagal menyimpan data! Silahkan coba lagi.',
            ], 500); 
        }
    }

    public function update(Request $r)
    {
        try
        {   
            DB::table('klaimapps_db.tb_loss_adjuster')->where('id', $r->lossAdjId)->update([
                'name'          => $r->name,
                'address'       => $r->address,
                'post_code'     => $r->post_code,
                'phone_no'      => $r->phone_no,
                'fax_no'        => $r->fax_no,
                'email'         => $r->email,
                'pic'           => $r->pic,
                'pic_email'     => $r->pic_email,
                'pic_no'        => $r->pic_no,
                'npwp'          => $r->npwp,
                'userId_update' => Auth::user()->id,
                'updated_at'    => now(),
            ]);

            return response()->json([
                'status'  => 200,
                'message' => 'Berhasil memperbarui data!'
            ], 200); 
        }
        catch (Throwable $exception)
        {   
            Log::error($exception); 

            return response()->json([
                'status'  => 500,
                'message' => 'Gagal memperbarui data! Silahkan coba lagi.',
            ], 500); 
        }
    }
}
