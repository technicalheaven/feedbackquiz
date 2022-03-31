<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiController;
use App\Http\Controllers\UserController;

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

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    Route::get('/service_options',[apiController::class,'service_options']);
    Route::post('/save_feedback',[apiController::class,'save_feedback']);
    Route::post('/user_feedback',[apiController::class,'user_feedback']);
    });
Route::get('/feedback_report',[apiController::class,'feedback_report']);
Route::post("login",[UserController::class,'login']);
Route::post("register",[UserController::class,'register']);

