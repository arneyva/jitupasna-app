<?php

use App\Http\Controllers\BencanaController;
use App\Http\Controllers\KerusakanController;
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
    Route::post('store', [BencanaController::class, 'store'])->name('store');
    Route::get('detail/{id}', [BencanaController::class, 'show'])->name('show');
    Route::get('edit/{id}', [BencanaController::class, 'edit'])->name('edit');
    Route::post('update/{id}', [BencanaController::class, 'update'])->name('update');
    Route::get('destroy/{id}', [BencanaController::class, 'destroy'])->name('destroy');
});
Route::prefix('/kerusakan')->name('kerusakan.')->group(function () {
    Route::get('list', [KerusakanController::class, 'index'])->name('index');
    Route::get('create/{id}', [KerusakanController::class, 'create'])->name('create');
    Route::post('store/{id}', [KerusakanController::class, 'store'])->name('store');
});
