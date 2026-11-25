<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ccobah; 
use App\Http\Controllers\Capi;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// 1.	Response Wrapper Method
Route::get('barang', [Capi::class, 'barang']);

// 2.	Direct Response
Route::get('pembeli', [Capi::class, 'pembeli']);

// 3.	Token via query parameter
Route::get('suplier', [Capi::class, 'suplier']);

// 4.	Token via header authorization
Route::get('pesanan', [Capi::class, 'pesanan']);

// 5.	Via apiKey
Route::get('pembelian', [Capi::class, 'pembelian']);

Route::post('barangsimpan', [Capi::class, 'barangsimpan']);
Route::post('barangsimpan2', [Capi::class, 'barangsimpan2']);

Route::put('/mhs/{id}',   [Capi::class, 'update']);
Route::patch('/mhs/{id}', [Capi::class, 'patch']);
Route::delete('/mhs/{id}', [Capi::class, 'destroy']);