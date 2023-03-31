<?php

namespace App\Http\Controllers;

use App\Models\Bacteria;
use Illuminate\Http\Request;

class BacteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('bacteria.index');
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
    public function show(Bacteria $bacteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bacteria $bacteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bacteria $bacteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bacteria $bacteria)
    {
        //
    }
}
