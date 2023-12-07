<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Log;
use Throwable;

class DashboardController extends Controller
{
    public function index(Request $r)
    {
        try
        {
            $data1 = DB::select('CALL klaimapps_db.dashboard(1)');
            $data2 = DB::select('CALL klaimapps_db.dashboard(2)');
            $data3 = DB::select('CALL klaimapps_db.dashboard(3)');

            return response()->json([
                'status' => 200,
                'data1'  => $data1,
                'data2'  => $data2,
                'data3'  => $data3,
            ], 200);
        }
        catch (Throwable $exception) 
        {
            Log::error($exception);

            return response()->json([
                'status' => 500,
                'message' => 'Gagal memuat data! Silahkan coba lagi.',
            ], 500);
        }
    }
}
