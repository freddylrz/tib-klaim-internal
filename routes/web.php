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
    Route::get('/list', function () {
        return view('claim.list');
    });
    Route::get('/input', function () {
        return view('claim.input');
    });
});
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