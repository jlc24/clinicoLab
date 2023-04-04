<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Municipio;
use App\Models\Medico;
use DateTime;

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
        //
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
    public function destroy(string $id)
    {
        //
    }
}
