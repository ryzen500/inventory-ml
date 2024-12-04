<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MasterProductController;
use App\Http\Controllers\Api\LocationsController;



// Master Products
Route::get('products', [MasterProductController::class, 'index']);  // GET daftar produk
Route::get('products/{id}', [MasterProductController::class, 'show']);  // GET detail produk
Route::post('products', [MasterProductController::class, 'store']);  // POST tambah produk
Route::put('products/{id}', [MasterProductController::class, 'update']);  // PUT update produk
Route::delete('products/{id}', [MasterProductController::class, 'destroy']);  // DELETE hapus produk


// Master Locations
Route::get('locations', [LocationsController::class, 'index']);  // GET daftar produk
Route::get('locations/{id}', [LocationsController::class, 'show']);  // GET detail produk
Route::post('locations', [LocationsController::class, 'store']);  // POST tambah produk
Route::put('locations/{id}', [LocationsController::class, 'update']);  // PUT update produk
Route::delete('locations/{id}', [LocationsController::class, 'destroy']);  // DELETE hapus produk


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
