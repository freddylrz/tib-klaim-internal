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
Route::get('list', function () {
     return view('CauseOfLoss.list');
     });
     Route::get('input', function () {
     return view('CauseOfLoss.input');
     });
Route::get('list', function () {
     return view('LossAdjuster.list');
     });
     Route::get('input', function () {
     return view('LossAdjuster.input');
     });

#CLAIM
Route::group(['prefix' => 'claim', 'as' => 'claim::', 'middleware' => 'auth:web'], function () {
    Route::get('/list', function () {
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
    Route::group(['prefix' => 'col', 'as' => 'col::', 'middleware' => 'auth:web'], function () {
    Route::get('/input', function () {
        return view('utility.CauseOfLoss.input');
    });
     Route::get('/list', function () {
        return view('utility.CauseOfLoss.list');
    });
});
});

Route::group(['prefix' => 'utility', 'as' => 'utility::', 'middleware' => 'auth:web'], function () {
    Route::group(['prefix' => 'lar', 'as' => 'lar::', 'middleware' => 'auth:web'], function () {
    Route::get('/input', function () {
        return view('utility.LossAdjuster.input');
    });
     Route::get('/list', function () {
        return view('utility.LossAdjuster.list');
    });
});
});

Route::group(['prefix' => 'utility', 'as' => 'utility::', 'middleware' => 'auth:web'], function () {
    Route::group(['prefix' => 'ws', 'as' => 'ws::', 'middleware' => 'auth:web'], function () {
    Route::get('/input', function () {
        return view('utility.Workshop.input');
    });
     Route::get('/list', function () {
        return view('utility.Workshop.list');
    });
});
});

#REKAP DATA KLAIM
Route::group(['prefix' => 'recap', 'as' => 'recap::', 'middleware' => 'auth:web'], function () {
    Route::get('/claim', function () {
        return view('recap.claim');
    });
});
