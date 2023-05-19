<?php

namespace App\Http\Controllers;

use App\Models\ComponenteAspecto;
use App\Models\DpComponente;
use App\Models\Parametro;
use Illuminate\Http\Request;

class DpComponenteController extends Controller
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
    public function show(DpComponente $dpComponente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DpComponente $dpComponente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DpComponente $dpComponente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comp_asps = ComponenteAspecto::where('dpcomp_id', '=', $id)->get();
        if ($comp_asps !== null) {
            foreach ($comp_asps as $comp_asp) {
                $parametros = Parametro::where('ca_id', '=', $comp_asp->id)->get();
                if ($parametros !== null) {
                    foreach ($parametros as $parametro) {
                        $parametro->delete();
                    }
                }
                $comp_asp->delete();
            }
        }
        $dpcomp = DpComponente::find($id);
        $dpcomp->delete();
    }
}
