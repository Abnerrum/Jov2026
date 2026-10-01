<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionarioController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\PerfilController;

Route::get('/', function () {
    return redirect()->route(auth()->check() ? 'inicio' : 'login');
});


Route::get('/cadastro', [UsuarioController::class, 'showForm'])->name('signup.form');
Route::post('/signup', [UsuarioController::class, 'register'])->name('signup.register');

Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:6,1')->name('login.post');

Route::get('/inicio', [InicioController::class, 'index'])->middleware('auth')->name('inicio');

Route::get('/questionario', [QuestionarioController::class, 'index'])->name('questionario')->middleware('auth');

Route::post('/questionario', [QuestionarioController::class, 'store'])->middleware('auth')->name('questionario.store');
Route::get('/questionario/conclusao', [QuestionarioController::class, 'conclusao'])->middleware('auth')->name('questionario.conclusao');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/minha-conta', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::patch('/minha-conta', [PerfilController::class, 'update'])->middleware('throttle:6,1')->name('perfil.update');
    Route::put('/minha-conta/senha', [PerfilController::class, 'password'])->middleware('throttle:6,1')->name('perfil.password');
});
