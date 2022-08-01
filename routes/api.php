<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MahasiswaControllerr;
use App\Http\Controllers\API\MatakuliahControllerr;
use App\Http\Controllers\API\NilaiController;
use App\Http\Controllers\API\UserController;

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
//REGISTER 
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// MAHASISWA -------------------
// ====> TAMBAH DATA 
Route::post('v1/mahasiswa', [MahasiswaControllerr::class, 'store']);
// MENAMPILKAN DATA 
Route::get('v1/mahasiswa', [MahasiswaControllerr::class, 'index']);
Route::get('v1/mahasiswa/{id}', [MahasiswaControllerr::class, 'show']);
// UPDATE DATA 
Route::put('v1/mahasiswa/{id}', [MahasiswaControllerr::class, 'update']);
// PROSES DELETE 
Route::delete('v1/mahasiswa/{id}', [MahasiswaControllerr::class, 'delete']);

// MATAKULIAH--------------------
// ====> TAMBAH DATA 
Route::post('v1/matakuliah', [MatakuliahControllerr::class, 'store']);
// MENAMPILKAN DATA 
Route::get('v1/matakuliah', [MatakuliahControllerr::class, 'index']);
Route::get('v1/matakuliah/{id}', [MatakuliahControllerr::class, 'show']);
// UPDATE DATA 
Route::put('v1/matakuliah/{id}', [MatakuliahControllerr::class, 'update']);
// PROSES DELETE 
Route::delete('v1/matakuliah/{id}', [MatakuliahControllerr::class, 'delete']);

// NILAI--------------------
// ====> TAMBAH DATA 
Route::post('v1/nilai', [NilaiController::class, 'store']);
// MENAMPILKAN DATA 
Route::get('v1/nilai', [NilaiController::class, 'index']);
Route::get('v1/nilai/{id}', [NilaiController::class, 'show']);
// UPDATE DATA 
Route::put('v1/nilai/{id}', [NilaiController::class, 'update']);
// PROSES DELETE 
Route::delete('v1/nilai/{id}', [nilaiController::class, 'delete']);


