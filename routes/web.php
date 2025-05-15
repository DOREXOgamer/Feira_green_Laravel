<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Rotas Públicas
Route::get('/buscar', [HomeController::class, 'buscar'])->name('busca');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/cadastro', [RegisterController::class, 'showRegistrationForm'])->name('register');


// Rotas Protegidas
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/', [HomeController::class, 'home'])->name('home');

    // Profile routes
    Route::get('/perfil', [HomeController::class, 'perfil'])->name('perfil');
    Route::post('/perfil/update', [HomeController::class, 'updatePerfil'])->name('perfil.update');
    Route::post('/produto/add', [HomeController::class, 'addProduto'])->name('produto.add');
    Route::get('/produto/{id}', [HomeController::class, 'showProduto'])->name('produto.show');
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});
