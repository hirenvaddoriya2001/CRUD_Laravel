<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dummyapi;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's

    //api resource
Route::apiResource('member', MemberController::class);

    });

Route::get("data", [dummyapi::class, 'getdata']); //simple api to get data
Route::get("device", [DeviceController::class, 'list']); // api for get data from database
Route::get("device/{name?}", [DeviceController::class, 'list_params']); // Get api with parameter {here '?' is make optional parameter}

//post api
Route::post("add", [DeviceController::class, 'add']);

//pu api
Route::put('update', [DeviceController::class, 'update']);

//search api
Route::get('search/{name}', [DeviceController::class, 'search']);

//delete api
Route::delete('delete/{id}', [DeviceController::class, 'delete']);

// api validation
Route::post("save", [DeviceController::class, 'testData']);

//upload api
Route::post("upload", [FileController::class, 'upload']);

//api sectum
Route::post("login",[UserController::class,'index']);
