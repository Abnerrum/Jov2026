<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionarioController;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/cadastro', [UsuarioController::class, 'showForm'])->name('signup.form');
Route::post('/signup', [UsuarioController::class, 'register'])->name('signup.register');

Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/questionario', [QuestionarioController::class, 'index'])->name('questionario')->middleware('auth');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');