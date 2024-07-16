<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PlanoController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('Blog', function () {
    return view('Blog');
});



Route::get('MenagerAuth', function () {
    return view('MenagerAuth');
});

Route::get('/Planos', [PlanoController::class, 'index'])->name('planos.index');

Route::get('/MindSyncPayment', function (Illuminate\Http\Request $request) {
    $nome = $request->query('nome');
    $valor = $request->query('valor');
    return view('mindSyncPayment', compact('nome', 'valor'));
})->name('mindSyncPayment');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

Route::middleware(['auth', 'superadmin'])->group(function () {

});

Route::get('/SuperAdmMindSync', function () {
    return view('SuperAdmMindSync');
});

Route::post('/Planos', [PlanoController::class, 'create'])->name('planos.create');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



