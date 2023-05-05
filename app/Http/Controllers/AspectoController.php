<?php

namespace App\Http\Controllers;

use App\Models\Aspecto;
use App\Models\ComponenteAspecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AspectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getAspectos()
    {
        $aspecto = Aspecto::all();
        return response()->json($aspecto);
    }

    public function getDPCAspecto($id)
    {
        $dpaspecto = DB::table('componente_aspectos as ca')
                        ->join('dp_componentes as dpc', 'ca.dpcomp_id', '=', 'dpc.id')
                        ->join('aspectos as a', 'ca.asp_id', '=', 'a.id')
                        ->select('ca.id', 'a.nombre', 'ca.umed_id')
                        ->where('dpc.id', '=', $id)
                        ->get();
        return response()->json($dpaspecto);
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
            'asp_nombre' => [ 'max:100',
                            Rule::unique('aspectos', 'nombre')
                        ],
            'dp_comp_id' => 'integer',
            'asp_id' => 'integer'
        ]);

        if ($request->input('asp_id') == '0') {
            $aspecto = Aspecto::create([
                'nombre' => $request->input('asp_nombre')
            ]);
            ComponenteAspecto::create([
                'dpcomp_id' => $request->input('dp_comp_id'),
                'asp_id' => $aspecto->id
            ]);
        }else{
            ComponenteAspecto::create([
                'dpcomp_id' => $request->input('dp_comp_id'),
                'asp_id' => $request->input('asp_id')
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Aspecto $aspecto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aspecto $aspecto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aspecto $aspecto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aspecto $aspecto)
    {
        //
    }
}
