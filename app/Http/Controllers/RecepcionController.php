<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Cliente;
use App\Models\Detalle;
use App\Models\Empresa;
use App\Models\Estudio;
use App\Models\Factura;
use App\Models\Indication;
use App\Models\Municipio;
use App\Models\Medico;
use App\Models\Muestra;
use App\Models\Recepcion;
use DateTime;
use Illuminate\Support\Facades\DB;

class RecepcionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('recepcion.index', [
            'departamentos' => Departamento::all(), 
            'clientes' => Cliente::all(),
            'countpac' => Cliente::count(),
            'municipios' => Municipio::all(),
            'countmed' => Medico::count(),
            'countemp' => Empresa::count(),
            'medicos' => Medico::all(),
            'recepciones' => Recepcion::all(),
            'detalles' => Detalle::all(),
            'estudios' => Estudio::all(),
            'muestras' => Muestra::all(),
            'indicacions' => Indication::all(),
            'caja' => Caja::latest()->first(),
        ]);
    }

    public function buscarMedicoId(Request $request)
    {
        $term = $request->input('q');
        $medicos = Medico::where('med_cod', 'LIKE', '%'.$term.'%')->get();
        return response()->json($medicos);
    }
    public function buscarMedicoNombre(Request $request)
    {
        $term = $request->input('q');
        $medicos = Medico::where('med_nombre', 'LIKE', '%'.$term.'%')
                        ->orWhere('med_apellido_pat', 'LIKE', '%'.$term.'%')
                        ->orWhere('med_apellido_mat', 'LIKE', '%'.$term.'%')
                        ->get();
        return response()->json($medicos);
    }

    public function buscarPacienteId(Request $request)
    {
        $term = $request->input('q');

        $pacientes = Cliente::where('cli_cod', 'LIKE', '%'.$term.'%')->get();
        foreach ($pacientes as $paciente ) {
            $fecha_nac = new DateTime($paciente->cli_fec_nac);
            $hoy = new DateTime();
            $edad = $hoy->diff($fecha_nac)->y;
            $paciente->edad = $edad;
        }
        return response()->json($pacientes);
    }
    public function buscarPacienteNombre(Request $request)
    {
        $term = $request->input('q');

        $pacientes = Cliente::where('cli_nombre', 'LIKE', '%'.$term.'%')
                        ->orWhere('cli_apellido_pat', 'LIKE', '%'.$term.'%')
                        ->orWhere('cli_apellido_mat', 'LIKE', '%'.$term.'%')
                        ->get();
        
        foreach ($pacientes as $paciente ) {
            $fecha_nac = new DateTime($paciente->cli_fec_nac);
            $hoy = new DateTime();
            $edad = $hoy->diff($fecha_nac)->y;
            $paciente->edad = $edad;
        }

        return response()->json($pacientes);
    }

    public function buscarEmpId(Request $request)
    {
        $term = $request->input('q');
        $empresas = Empresa::where('emp_cod', 'LIKE', '%'.$term.'%')->get();
        return response()->json($empresas);
    }

    public function buscarEmpNombre(Request $request)
    {
        $term = $request->input('q');
        $empresas = Empresa::where('emp_nombre', 'LIKE', '%'.$term.'%')->get();
        return response()->json($empresas);
    }

    public function buscarEstudioId(Request $request)
    {
        $term = $request->input('q');
        $estudios = DB::table('detalles')
                        ->join('estudios', 'detalles.estudio_id', '=', 'estudios.id')
                        ->select('detalles.id', 'est_cod', 'est_nombre', 'est_precio', 'est_moneda')
                        ->where('est_cod', 'LIKE', '%'.$term.'%')->get();
        return response()->json($estudios);
    }

    public function buscarEstudioNombre(Request $request)
    {
        $term = $request->input('q');
        $estudios = DB::table('detalles')
                        ->join('estudios', 'detalles.estudio_id', '=', 'estudios.id')
                        ->select('detalles.id', 'est_cod', 'est_nombre', 'est_precio', 'est_moneda')
                        ->where('est_nombre', 'LIKE', '%'.$term.'%')->get();
        return response()->json($estudios);
    }

    public function validarFactura()
    {
        $facturapendiente = DB::table('facturas')->where('fac_estado', '=', 0)->latest()->first();

        return response()->json($facturapendiente);
    }

    public function tabla_recepcion($id)
    {
        $estudios = DB::table('recepcions')
                        ->join('facturas', 'recepcions.fac_id', '=', 'facturas.id')
                        ->join('cajas', 'recepcions.caja_id', '=', 'cajas.id')
                        ->join('detalles', 'recepcions.det_id', '=', 'detalles.id')
                        ->join('estudios', 'detalles.estudio_id', '=', 'estudios.id')
                        ->join('muestras', 'detalles.muestra_id', '=', 'muestras.id')
                        ->join('indications', 'detalles.indicacion_id', '=', 'indications.id')
                        ->select('recepcions.id as rec_id',
                                'recepcions.caja_id',
                                'recepcions.fac_id',
                                'estudios.est_cod', 
                                'estudios.est_nombre', 
                                'estudios.est_precio', 
                                'muestras.nombre as muestra', 
                                'indications.nombre as indicacion')
                        ->where('recepcions.fac_id', $id)
                        ->get();
        return response()->json($estudios);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'caja_id' => 'required|integer',
            'fac_id' => 'required|integer',
            'det_id' => 'required|integer',
            'estado'=> 'required',
        ]);

        Recepcion::create([
            'caja_id' => $request->input('caja_id'),
            'fac_id' => $request->input('fac_id'),
            'det_id' => $request->input('det_id'),
            'estado' => 'Pendiente',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $recepcion = Recepcion::find($id);
        $recepcion->delete();
        return response()->json(['success', 'El registro se ha eliminado con éxito']);
    }
}
