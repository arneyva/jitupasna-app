<?php

use App\Http\Controllers\BencanaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.example');
});
Route::get('/create', function () {
    return view('create');
});
Route::get('/1', function () {
    return view('base-data-before-disaster');
});
// 
Route::prefix('/bencana')->name('bencana.')->group(function () {
    Route::get('list', [BencanaController::class, 'index'])->name('index');
    Route::get('create', [BencanaController::class, 'create'])->name('create');
});
