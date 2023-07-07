<?php

namespace App\Http\Controllers;

use App\Models\Subgrupo;
use Illuminate\Http\Request;

class SubgrupoController extends Controller
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
        $request->validate([
            'subgrupos_nombre' => 'required|max:50'
        ]);

        Subgrupo::create([
            'nombre' => $request->input('subgrupos_nombre')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subgrupo $subgrupo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subgrupo $subgrupo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subgrupo $subgrupo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subgrupo $subgrupo)
    {
        //
    }
}
