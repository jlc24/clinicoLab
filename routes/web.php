<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MedicoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');

    Route::get('/clientes', [ClienteController::class, 'index'])->name('cliente');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('cliente');
    Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('cliente.edit');
    Route::get('/datos/{id}', [ClienteController::class, 'datos'])->name('datos');

    Route::get('/medicos', [MedicoController::class, 'index'])->name('medico');
    Route::post('/medicos', [MedicoController::class, 'store'])->name('medico');
    
});

