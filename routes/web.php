<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
    'login' => true, // Registration Routes...
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);


Route::get('/', 'HomeController@index')->name('home');


#CLAIM
Route::group(['prefix' => 'claim', 'as' => 'claim::', 'middleware' => 'auth:web'], function () {
    Route::get('/list/{statusId?}', function () {
        return view('claim.list');
    });
    Route::get('/input', function () {
        return view('claim.input');
    });
    Route::get('/detail/{claimId}', function () {
        return view('claim.detail');
    });
    Route::get('/update/{claimId}', function () {
        return view('claim.edit');
    });
});

#UTILITY
Route::group(['prefix' => 'utility', 'as' => 'utility::', 'middleware' => 'auth:web'], function () {
    Route::group(['prefix' => 'cfl', 'as' => 'cfl::', 'middleware' => 'auth:web'], function () {
    Route::get('/input', function () {
        return view('utility.CauseOfLoss.input');
    });
     Route::get('/list', function () {
        return view('utility.CauseOfLoss.list');
    });
    Route::get('/show/{idcfl}', function () {
        return view('utility.CauseOfLoss.show');
    });
    Route::get('/update/{idcfl}', function () {
        return view('utility.CauseOfLoss.update');
    });
});
Route::group(['prefix' => 'lar', 'as' => 'lar::', 'middleware' => 'auth:web'], function () {
    Route::get('/input', function () {
        return view('utility.LossAdjuster.input');
    });
     Route::get('/list', function () {
        return view('utility.LossAdjuster.list');
    });
    Route::get('/show/{idlar}', function () {
        return view('utility.LossAdjuster.show');
    });
     Route::get('/update/{idlar}', function () {
        return view('utility.LossAdjuster.update');
    });

});
Route::group(['prefix' => 'ws', 'as' => 'ws::', 'middleware' => 'auth:web'], function () {
    Route::get('/input', function () {
        return view('utility.Workshop.input');
    });
     Route::get('/list', function () {
        return view('utility.Workshop.list');
    });
    Route::get('/show/{idws}', function () {
        return view('utility.Workshop.show');
    });
    Route::get('/update/{idws}', function () {
        return view('utility.Workshop.update');
    });
});
});

#REKAP DATA KLAIM
Route::group(['prefix' => 'recap', 'as' => 'recap::', 'middleware' => 'auth:web'], function () {
    Route::get('/claim', function () {
        return view('recap.claim');
    });
});
