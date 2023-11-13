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

    public function insert(Request $r)
    {
        try
        {   
            $getId = DB::table('klaimapps_db.tb_workshop')->insertGetId([
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
                'workshopId' => $getId,
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
                w.id,
                w.`name`,
                IFNULL( w.address, "-" ) address,
                IFNULL( w.post_code, "-" ) post_code,
                IFNULL( w.phone_no, "-" ) phone_no,
                IFNULL( w.fax_no, "-" ) fax_no,
                IFNULL( w.email, "-" ) email,
                IFNULL( w.pic, "-" ) pic,
                IFNULL( w.pic_email, "-" ) pic_email,
                IFNULL( w.pic_no, "-" ) pic_no,
                IFNULL( w.npwp, "-" ) npwp
            FROM
                klaimapps_db.tb_workshop AS w
            WHERE
                w.id = '.$r->get('workshopId'));

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
            DB::table('klaimapps_db.tb_workshop')->where('id', $r->workshopId)->update([
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
