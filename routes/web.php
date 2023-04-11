<?php

use App\Http\Controllers\BacteriaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\CultivoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EstudioController;
use App\Http\Controllers\IndicationController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\MuestraController;
use App\Http\Controllers\RecepcionController;
use App\Http\Controllers\RecipienteController;
use App\Http\Controllers\ResultController;

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

    Route::get('/configurations', [ConfigurationController::class, 'index'])->name('configuration');

    Route::get('/clientes', [ClienteController::class, 'index'])->name('cliente');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('cliente');
    Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit']);
    Route::put('/clientes/{id}', [ClienteController::class, 'update']);
    //Route::resource('/clientes', ClienteController::class);
    Route::get('/datos/{id}', [ClienteController::class, 'datos'])->name('datos');

    Route::get('/empresas', [EmpresaController::class, 'index'])->name('empresa');
    Route::post('/empresas', [EmpresaController::class, 'store'])->name('empresa');

    Route::get('/medicos', [MedicoController::class, 'index'])->name('medico');
    Route::post('/medicos', [MedicoController::class, 'store'])->name('medico');

    Route::get('/recepcion', [RecepcionController::class, 'index'])->name('recepcion');
    Route::post('/recepcion', [RecepcionController::class, 'store'])->name('recepcion');
    // Route::get('/tabla-recepcion', [RecepcionController::class, 'tablaRecepcion'])->name('recepcion.tabla');

    Route::get('/results', [ResultController::class, 'index'])->name('result');
    
    Route::get('/buscar_medico_id', [RecepcionController::class, 'buscarMedicoId']);
    Route::get('/buscar_medico_nombre', [RecepcionController::class, 'buscarMedicoNombre']);
    Route::get('/buscar_paciente_id', [RecepcionController::class, 'buscarPacienteId']);
    Route::get('/buscar_paciente_nombre', [RecepcionController::class, 'buscarPacienteNombre']);
    Route::get('/buscar_emp_id', [RecepcionController::class, 'buscarEmpId']);
    Route::get('/buscar_emp_nombre', [RecepcionController::class, 'buscarEmpNombre']);
    Route::get('/buscar_estudio_id', [RecepcionController::class, 'buscarEstudioId']);
    Route::get('/buscar_estudio_nombre', [RecepcionController::class, 'buscarEstudioNombre']);

    Route::get('/estudios', [EstudioController::class, 'index'])->name('estudio');
    Route::post('/estudios', [EstudioController::class, 'store'])->name('estudio');
    Route::put('/estudios/{id}', [EstudioController::class, 'update']);

    Route::get('/cultivos', [CultivoController::class, 'index'])->name('cultivo');

    Route::get('/bacterias', [BacteriaController::class, 'index'])->name('bacteria');

    Route::get('/indications', [IndicationController::class, 'index'])->name('indication');
    Route::post('/indications', [IndicationController::class, 'store'])->name('indication');
    Route::put('/indications/{id}', [IndicationController::class, 'update']);
    Route::delete('/indications/{id}', [IndicationController::class, 'destroy'])->name('indication.destroy');

    Route::get('/recipientes', [RecipienteController::class, 'index'])->name('recipiente');
    Route::post('/recipientes', [RecipienteController::class, 'store'])->name('recipiente');
    Route::put('/recipientes/{id}', [RecipienteController::class, 'update']);
    Route::delete('/recipientes/{id}', [RecipienteController::class, 'destroy'])->name('recipiente.destroy');

    Route::get('/muestras', [MuestraController::class, 'index'])->name('muestra');
    Route::post('/muestras', [MuestraController::class, 'store'])->name('muestra');
    Route::put('/muestras/{id}', [MuestraController::class, 'update']);
    Route::delete('/muestras/{id}', [MuestraController::class, 'destroy'])->name('muestra.destroy');
    
});

