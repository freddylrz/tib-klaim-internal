<?php

namespace App\Http\Controllers\Api\Utility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
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

    public function asset(Request $r)
    {
        try
        {
            $data = DB::select('SELECT
                tb_cob.id, 
                tb_cob.cob_code
            FROM
                tb_cob');

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
            $getId = DB::table('klaimapps_db.tb_caused')->insertGetId([
                'foxpro_id'   => 0,
                'cob_id'      => $r->cobId,
                'cob_desc'    => DB::table('webapps_db.tb_cob')->where('id', $r->cobId)->value('cob_code'),
                'description' => $r->description,
                'userId_add'  => Auth::user()->id,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            return response()->json([
                'status'   => 200,
                'message'  => 'Berhasil menyimpan data!',
                'causedId' => $getId,
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
                c.id,
                c.cob_id,
                c.cob_desc,
                c.description 
            FROM
                klaimapps_db.tb_caused AS c 
            WHERE
                c.id = '.$r->get('causedId'));

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
            DB::table('klaimapps_db.tb_caused')->where('id', $r->causedId)->update([
                'cob_id'      => $r->cobId,
                'cob_desc'    => DB::table('webapps_db.tb_cob')->where('id', $r->cobId)->value('cob_code'),
                'description' => $r->description,
                'userId_add'  => Auth::user()->id,
                'updated_at'  => now(),
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
