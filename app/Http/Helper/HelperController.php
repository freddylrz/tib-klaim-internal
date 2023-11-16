<?php

namespace App\Http\Helper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use Log;
use Throwable;

class HelperController
{
    public static function changeDate($date)
    {
        $nmeng = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $nmtur = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

        return str_ireplace($nmeng, $nmtur, date("d F Y", strtotime($date)));
    }
}
