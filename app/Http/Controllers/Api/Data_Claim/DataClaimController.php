<?php

namespace App\Http\Controllers\Api\Data_Claim;

use App\Http\Helper\HelperController;
use App\Models\tb_klaim;
use App\Models\tb_klaim_log;
use App\Models\tb_klaim_ins;
use App\Models\tb_uploads;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Log;
use Throwable;

class DataClaimController extends Controller
{
    public function detailClaim(){
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
    public function listClaim(){
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
    public function updateClaim(){
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
