<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PlanoController;
use App\Http\Controllers\CardController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/Blog', [CardController::class, 'index'])->name('Blog');
Route::get('/Planos', [PlanoController::class, 'index'])->name('planos.index');

Route::get('/MindSyncPayment', function (Illuminate\Http\Request $request) {
    $nome = $request->query('nome');
    $valor = $request->query('valor');
    return view('mindSyncPayment', compact('nome', 'valor'));
})->name('mindSyncPayment');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

Route::middleware(['auth'])->group(function () {
    Route::get('/MenagerAuth', function () {
        return view('MenagerAuth');
    })->name('menager.auth');
});

Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/SuperAdmMindSync', function () {
        return view('SuperAdmMindSync');
    })->name('superadmin.mindsync');
    Route::post('/Planos', [PlanoController::class, 'create'])->name('planos.create');
    Route::post('/cards', [CardController::class, 'store'])->name('cards.store');
});

// Rotas de autenticação
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
