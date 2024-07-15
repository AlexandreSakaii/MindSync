<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('Planos', function () {
    return view('Planos');
});

Route::get('MindSyncPayment', function () {
    return view('MindSyncPayment');
});

Route::get('Blog', function () {
    return view('Blog');
});
