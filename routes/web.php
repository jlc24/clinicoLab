<?php

use App\Http\Controllers\AspectoController;
use App\Http\Controllers\BacteriaController;
use App\Http\Controllers\CajaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ComponenteAspectoController;
use App\Http\Controllers\ComponenteController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\CultivoController;
use App\Http\Controllers\DetalleController;
use App\Http\Controllers\DetalleProcedimientoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EstudioController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\IndicationController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\MetodologiaController;
use App\Http\Controllers\MuestraController;
use App\Http\Controllers\ParametroController;
use App\Http\Controllers\ProcedimientoController;
use App\Http\Controllers\RecepcionController;
use App\Http\Controllers\RecipienteController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\UMedidaController;
use App\Models\Componente;
use App\Models\DetalleComponente;
use App\Models\DetalleProcedimiento;

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

    Route::get('/clientes/{id}', [ClienteController::class, 'clientes'])->name('clientes');
    Route::get('/datos/{id}', [ClienteController::class, 'datos'])->name('datos');

    Route::get('/empresas', [EmpresaController::class, 'index'])->name('empresa');
    Route::post('/empresas', [EmpresaController::class, 'store'])->name('empresa');
    Route::put('/empresas/{id}', [EmpresaController::class, 'update']);

    Route::get('/medicos', [MedicoController::class, 'index'])->name('medico');
    Route::post('/medicos', [MedicoController::class, 'store'])->name('medico');
    Route::put('/medicos/{id}', [MedicoController::class, 'update']);

    Route::get('/cajas', [CajaController::class, 'index'])->name('caja');
    Route::post('/cajas', [CajaController::class, 'store'])->name('caja');
    Route::put('/cajas/{id}', [CajaController::class, 'update']);

    Route::get('/getCajaStatus', [CajaController::class, 'getCajaStatus'])->name('getCajaStatus');

    Route::middleware(['verificarEstadoCaja'])->group(function () {
        Route::get('/recepcion', [RecepcionController::class, 'index'])->name('recepcion');
        Route::post('/recepcion', [RecepcionController::class, 'store'])->name('recepcion');
        Route::delete('/recepcion/{id}', [RecepcionController::class, 'destroy'])->name('recepcion.destroy');

        Route::get('/tabla_recepcion/{id}', [RecepcionController::class, 'tabla_recepcion'])->name('tabla_recepcion');

        Route::get('/buscar_emp_id', [RecepcionController::class, 'buscarEmpId']);
        Route::get('/buscar_emp_nombre', [RecepcionController::class, 'buscarEmpNombre']);
    
        Route::get('/validarFactura', [RecepcionController::class, 'validarFactura']);

        Route::post('/facturas', [FacturaController::class, 'store'])->name('factura');
        Route::put('/facturas/{id}', [FacturaController::class, 'update']);
    });
    Route::get('/buscar_paciente_id', [RecepcionController::class, 'buscarPacienteId']);
    Route::get('/buscar_paciente_nombre', [RecepcionController::class, 'buscarPacienteNombre']);
    Route::get('/buscar_estudio_id', [RecepcionController::class, 'buscarEstudioId']);
    Route::get('/buscar_estudio_nombre', [RecepcionController::class, 'buscarEstudioNombre']);
    Route::get('/buscar_medico_id', [RecepcionController::class, 'buscarMedicoId']);
    Route::get('/buscar_medico_nombre', [RecepcionController::class, 'buscarMedicoNombre']);

    Route::get('/buscar_recepcion_paciente', [ResultController::class, 'buscarRecepcionPaciente']);
    Route::get('/buscar_recepcion_estudio', [ResultController::class, 'buscarRecepcionEstudio']);
    Route::get('/buscar_recepcion_fechas', [ResultController::class, 'buscarRecepcionFechas']);
    
    Route::get('/results', [ResultController::class, 'index'])->name('result');

    Route::put('/detalles/{id}', [DetalleController::class, 'update'])->name('detalle.update');

    Route::put('/detalleprocedimientos/{id}', [DetalleProcedimientoController::class, 'update'])->name('detalleprocedimiento.update');

    Route::get('/estudios', [EstudioController::class, 'index'])->name('estudio');
    Route::post('/estudios', [EstudioController::class, 'store'])->name('estudio');
    Route::put('/estudios/{id}', [EstudioController::class, 'update']);

    Route::get('/getDetalle/{id}', [EstudioController::class, 'getDetalle'])->name('getDetalle');

    Route::get('/tabla_procedimiento/{id}', [EstudioController::class, 'tabla_procedimiento'])->name('tabla_procedimiento');

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

    Route::get('/metodologias', [MetodologiaController::class, 'index'])->name('metodologia');
    Route::post('/metodologias', [MetodologiaController::class, 'store'])->name('metodologia');
    Route::put('/metodologias/{id}', [MetodologiaController::class, 'update']);
    Route::delete('/metodologias/{id}', [MetodologiaController::class, 'destroy'])->name('metodologia.destroy');

    Route::get('/procedimientos', [ProcedimientoController::class, 'index'])->name('procedimiento');
    Route::post('/procedimientos', [ProcedimientoController::class, 'store'])->name('procedimiento');

    Route::post('/storeDetalleProc', [ProcedimientoController::class, 'storeDetalleProc'])->name('storeDetalleProc');
    Route::delete('/destroyDetalleProc/{id}', [ProcedimientoController::class, 'destroyDetalleProc'])->name('destroyDetalleProc');

    Route::put('/procedimiento/{id}', [ProcedimientoController::class, 'update'])->name('procedimiento.update');
    Route::delete('/procedimientos/{id}', [ProcedimientoController::class, 'destroy'])->name('procedimiento.destroy');

    Route::get('/getLastProcedimiento', [ProcedimientoController::class, 'getLastProcedimiento'])->name('getLastProcedimiento');
    Route::get('/getAllProcedimiento', [ProcedimientoController::class, 'getAllProcedimiento'])->name('getAllProcedimiento');

    Route::get('/getCompProcedimientoEstudio', [DetalleProcedimientoController::class, 'getCompProcedimientoEstudio'])->name('getCompProcedimientoEstudio');
    Route::get('/getComponenteEstudio/{id}', [DetalleProcedimientoController::class, 'getComponenteEstudio'])->name('getComponenteEstudio');
    Route::get('/getProcedimientoEstudio/{id}', [DetalleProcedimientoController::class, 'getProcedimientoEstudio'])->name('getProcedimientoEstudio');
    Route::get('/getComponenteDp/{id}', [DetalleProcedimientoController::class, 'getComponenteDp'])->name('getComponenteDp');
    Route::post('/updateDetalleComponente', [DetalleProcedimientoController::class, 'updateDetalleComponente'])->name('updateDetalleComponente');

    Route::get('/umedidas', [UMedidaController::class, 'index'])->name('umedida');
    Route::post('/umedidas', [UMedidaController::class, 'store'])->name('umedida');
    Route::put('/umedidas/{id}', [UMedidaController::class, 'update']);
    Route::delete('/umedidas/{id}', [UMedidaController::class, 'destroy'])->name('umedida.destroy');

    Route::get('/componentes', [ComponenteController::class, 'index'])->name('componente');
    Route::post('/componentes', [ComponenteController::class, 'store'])->name('componente');
    Route::put('/componentes/{id}', [ComponenteController::class, 'update']);
    Route::delete('/componentes/{id}', [ComponenteController::class, 'destroy'])->name('componente.destroy');

    Route::get('/getAllComponente', [ComponenteController::class, 'getAllComponente'])->name('getAllComponente');

    Route::delete('/destroyDetComp/{id}', [ComponenteController::class, 'destroyDetComp'])->name('destroyDetComp.destroy');

    Route::post('/aspectos', [AspectoController::class, 'store'])->name('aspecto');
    Route::get('/getAspectos', [AspectoController::class, 'getAspectos'])->name('getAspectos');
    Route::get('/getDPCAspecto/{id}', [AspectoController::class, 'getDPCAspecto'])->name('getDPCAspecto');

    Route::post('/componente_aspectos/{id}', [ComponenteAspectoController::class, 'update'])-> name('componente_aspectos.update');
    Route::delete('/componente_aspectos/{id}', [ComponenteAspectoController::class, 'destroy'])->name('componente_aspectos.destroy');

    Route::get('/getParametro/{id}', [ParametroController::class, 'getParametro'])->name('getParametro');
    Route::post('/parametros', [ParametroController::class, 'store'])->name('parametros');
    Route::post('/parametros/{id}', [ParametroController::class, 'update'])->name('parametros.update');
    Route::delete('/parametros/{id}', [ParametroController::class, 'destroy'])->name('parametros.destroy');
});

