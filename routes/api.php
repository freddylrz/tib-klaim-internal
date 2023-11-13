<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('/claim')->group(function () {
    Route::prefix('/input')->group(function () {
        Route::get('/asset', ['uses' => 'Api\Data_Claim\InputClaimController@inputAsset']);
        Route::get('/dataTable', ['uses' => 'Api\Data_Claim\InputClaimController@getDataTable']);
    });
});
Route::prefix('/utiliy')->group(function () {
    Route::prefix('/cause-of-loss')->group(function () {
        Route::get('/', ['uses' => 'Api\Utility\CauseOfLossController@index']);
    });


    Route::prefix('/loss-adjuster')->group(function () {
        Route::get('/', ['uses' => 'Api\Utility\LossAdjusterController@index']);
    });


    Route::prefix('/workshop')->group(function () {
        Route::get('/', ['uses' => 'Api\Utility\WorkshopController@index']);
    });
});
