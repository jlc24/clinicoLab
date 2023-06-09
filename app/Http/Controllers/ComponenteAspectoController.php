<?php

namespace App\Http\Controllers;

use App\Models\ComponenteAspecto;
use App\Models\Parametro;
use Illuminate\Http\Request;

class ComponenteAspectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(ComponenteAspecto $componenteAspecto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ComponenteAspecto $componenteAspecto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $comp_asp = ComponenteAspecto::find($id);
        $comp_asp->umed_id = $request->input('umed_id');
        $comp_asp->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $parametros = Parametro::where('ca_id', '=', $id)->get();
        if ($parametros !== null) {
            foreach ($parametros as $parametro) {
                $parametro->delete();
            }
        }
        $comp_asp = ComponenteAspecto::find($id);
        $comp_asp->delete();
    }
}
