<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\ApiCntroller;

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

Route::group([
    'middleware' => 'api',
    'namespace'=>'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {


    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
    Route::get('/user-profile', [App\Http\Controllers\AuthController::class, 'userProfile']);  
  
});


Route::group([
    'namespace'=>'App\Http\Controllers',

], function ($router) {

    Route::get('addRooms','ApiController@addRooms');
    Route::post('bookRooms','ApiController@bookRooms');
    Route::post('getRooms','ApiController@getRooms');

    
   
});



