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

Route::group(['middleware' => ['cors','auth:api']], function ($router)
{
    Route::prefix('/claim')->group(function () {
        Route::prefix('/input')->group(function () {
            Route::get('/asset', ['uses' => 'Api\Data_Claim\InputClaimController@inputAsset']);
            Route::get('/dataTable', ['uses' => 'Api\Data_Claim\InputClaimController@getDataTable']);
            Route::get('/data-client', ['uses' => 'Api\Data_Claim\InputClaimController@getDataClient']);
            Route::get('/premium-info', ['uses' => 'Api\Data_Claim\InputClaimController@getDataPremium']);
            Route::get('/share-insurance', ['uses' => 'Api\Data_Claim\InputClaimController@getDataIns']);
            Route::get('/claim-amount', ['uses' => 'Api\Data_Claim\InputClaimController@getClaimAmount']);
        });
    });
    Route::prefix('/utiliy')->group( function ()
    {
        Route::prefix('/cause-of-loss')->group( function ()
        {
            Route::get('/', ['uses' => 'Api\Utility\CauseOfLossController@index']);
            Route::get('/asset', ['uses' => 'Api\Utility\CauseOfLossController@asset']);
            Route::post('/insert', ['uses' => 'Api\Utility\CauseOfLossController@insert']);
            Route::get('/detail', ['uses' => 'Api\Utility\CauseOfLossController@detail']);
            Route::post('/update', ['uses' => 'Api\Utility\CauseOfLossController@update']);
        });


        Route::prefix('/loss-adjuster')->group( function ()
        {
            Route::get('/', ['uses' => 'Api\Utility\LossAdjusterController@index']);
            Route::post('/insert', ['uses' => 'Api\Utility\LossAdjusterController@insert']);
            Route::get('/detail', ['uses' => 'Api\Utility\LossAdjusterController@detail']);
            Route::post('/update', ['uses' => 'Api\Utility\LossAdjusterController@update']);
        });


        Route::prefix('/workshop')->group( function ()
        {
            Route::get('/', ['uses' => 'Api\Utility\WorkshopController@index']);
            Route::post('/insert', ['uses' => 'Api\Utility\WorkshopController@insert']);
            Route::get('/detail', ['uses' => 'Api\Utility\WorkshopController@detail']);
            Route::post('/update', ['uses' => 'Api\Utility\WorkshopController@update']);
        });
    });
});
