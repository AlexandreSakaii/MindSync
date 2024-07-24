<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PlanoController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\PsychologistController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SessionTypeController;
use App\Http\Controllers\SessionTimeController;
use App\Http\Controllers\ConfigPsicologoController;
use App\Http\Controllers\DeshboardController;
use App\Http\Controllers\SessionController;




Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {return view('welcome');});
    Route::get('/login', function() {return redirect('/');})->name('login')->middleware('guest');
    Route::get('/Blog', [CardController::class, 'index'])->name('Blog');
    Route::get('/Planos', [PlanoController::class, 'index'])->name('planos.index');
    Route::get('/MindSyncPayment', [PlanoController::class, 'mindSyncPayment'])->name('MindSyncPayment');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
    Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');
    Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware(['auth:psychologist'])->group(function () {
        Route::get('/Deshboard', function () { return view('Deshboard'); })->name('deshboard');
        Route::get('/Deshboard', [DeshboardController::class, 'index'])->name('deshboard');

        Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
        Route::get('/patients/search', [PatientController::class, 'search'])->name('patients.search');

        Route::get('/ConfigPsicologo', [ConfigPsicologoController::class, 'index'])->name('configPsicologo.index');

        Route::post('/session-types', [SessionTypeController::class, 'store'])->name('sessionTypes.store');
        Route::delete('/session-types/{id}', [SessionTypeController::class, 'destroy'])->name('sessionTypes.destroy');
        Route::get('/session-types', [SessionTypeController::class, 'getSessionTypes'])->name('sessionTypes.get');

        Route::post('/session-times', [SessionTimeController::class, 'store'])->name('sessionTimes.store');
        Route::delete('/session-times/{id}', [SessionTimeController::class, 'destroy'])->name('sessionTimes.destroy');
        Route::get('/session-times', [SessionTimeController::class, 'getSessionTimes'])->name('sessionTimes.get');

        Route::post('/sessions', [SessionController::class, 'store'])->name('sessions.store');
        Route::get('/sessions/by-date', [SessionController::class, 'getSessionsByDate'])->name('sessions.by-date');
    });


    Route::middleware(['auth'])->group(function () {
        Route::get('/MenagerAuth', [PsychologistController::class, 'index'])->name('menager.auth');
        Route::post('/psychologists', [PsychologistController::class, 'create'])->name('psychologists.create');
        Route::get('/Configuracao', [ConfigController::class, 'showConfig'])->name('configuracao');
        Route::post('/update-email', [ConfigController::class, 'updateEmail'])->name('config.update.email');
        Route::post('/update-password', [ConfigController::class, 'updatePassword'])->name('config.update.password');
        Route::post('/add-payment-method', [ConfigController::class, 'addPaymentMethod'])->name('config.add.payment_method');
        Route::post('/update-clinic-data', [ConfigController::class, 'updateClinicData'])->name('config.update.clinic_data');
        Route::post('/update-clinic-address', [ConfigController::class, 'updateClinicAddress'])->name('config.update.clinic_address');
    });

    Route::middleware(['auth:superadmin'])->group(function () {
        Route::get('/SuperAdmMindSync', function () {
            return view('SuperAdmMindSync');
        })->name('superadmin.mindsync');
        Route::post('/Planos', [PlanoController::class, 'create'])->name('planos.create');
        Route::post('/cards', [CardController::class, 'store'])->name('cards.store');
    });


});
