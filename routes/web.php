<?php

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

