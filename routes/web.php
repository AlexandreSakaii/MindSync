<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PlanoController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\PsychologistController;

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/Blog', [CardController::class, 'index'])->name('Blog');
    Route::get('/Planos', [PlanoController::class, 'index'])->name('planos.index');
    Route::get('/MindSyncPayment', [PlanoController::class, 'mindSyncPayment'])->name('MindSyncPayment');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
    Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

    // Rotas de autenticação
    Route::get('/login', function() {
        return redirect('/'); // Redirecionar para a página inicial onde o modal de login está presente
    })->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware(['auth:psychologist'])->group(function () {
        Route::get('/Deshboard', function () {
            return view('Deshboard');
        })->name('deshboard');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/MenagerAuth', [PsychologistController::class, 'index'])->name('menager.auth');
        Route::post('/psychologists', [PsychologistController::class, 'create'])->name('psychologists.create');
    });

    Route::middleware(['auth:superadmin'])->group(function () {
        Route::get('/SuperAdmMindSync', function () {
            return view('SuperAdmMindSync');
        })->name('superadmin.mindsync');
        Route::post('/Planos', [PlanoController::class, 'create'])->name('planos.create');
        Route::post('/cards', [CardController::class, 'store'])->name('cards.store');
    });
});
