<?php

use App\Http\Controllers\API\PendataanPenumpangController;
use App\Http\Controllers\API\TrackingController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[UserController::class,'login']);

Route::get('list-angkutan',[PendataanPenumpangController::class,'get_angkutan']);
Route::get('list-penumpang',[PendataanPenumpangController::class,'list_penumpang']);
Route::get('list-riwayat-penumpang',[PendataanPenumpangController::class,'riwayat_penumpang']);
Route::post('absen-penumpang',[PendataanPenumpangController::class,'absen_penumpang']);
Route::post('daftar-penumpang',[PendataanPenumpangController::class,'filter_penumpang']);
Route::post('scan-penumpang',[PendataanPenumpangController::class,'scan_qr_penumpang']);


Route::post('ubah-akun',[UserController::class,'ubah_profil']);
Route::post('ubah-password',[UserController::class,'ubah_password']);


Route::post('tracking',[TrackingController::class,'tracking']);
