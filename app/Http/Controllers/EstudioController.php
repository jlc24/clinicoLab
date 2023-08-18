<?php

namespace App\Http\Controllers;

use App\Models\Componente;
use App\Models\Detalle;
use App\Models\DetalleProcedimiento;
use App\Models\Estudio;
use App\Models\Grupo;
use App\Models\Indication;
use App\Models\Material;
use App\Models\Metodologia;
use App\Models\Muestra;
use App\Models\Recipiente;
use App\Models\Subgrupo;
use App\Models\UMedida;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EstudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('estudio.index',[
            'muestras' => Muestra::all(),
            'recipientes' => Recipiente::all(),
            'indicaciones' => Indication::all(),
            'detalles' => Detalle::all(),
            'metodos' => Metodologia::all(),
            'unidades' => UMedida::all(),
            'detalleprocedimientos' => DetalleProcedimiento::all(),
            'componentes' => Componente::all(),
            'grupos' => Grupo::all(),
            'subgrupos' => Subgrupo::all()
        ]);
    }

    public function getEstudios()
    {
        $estudios = DB::table('estudios as e')
                        ->join('grupos as g', 'g.id', '=', 'e.grupo_id')
                        ->leftJoin('subgrupos as sg', 'sg.id', '=', 'e.subgrupo_id')
                        ->join('detalles as d', 'e.id', '=', 'd.estudio_id')
                        ->select('d.id', 'e.est_cod', 'e.est_nombre', 'g.nombre as grupo', 'sg.nombre as subgrupo', 'd.tipo')
                        ->orderBy('g.nombre', 'asc')
                        ->orderBy('sg.nombre', 'asc')
                        ->orderBy('e.est_nombre', 'asc')
                        ->get();
        return response()->json($estudios);
    }

    public function getDetalle($id)
    {
        $estudio = Detalle::find($id);
        return response()->json($estudio);
    }

    public function tabla_procedimiento($id)
    {
        $procedimiento = DB::table('procedimientos')
                            ->join('detalle_procedimientos', 'detalle_procedimientos.proc_id', '=', 'procedimientos.id')
                            ->join('detalles', 'detalle_procedimientos.det_id', '=', 'detalles.id')
                            ->select('detalle_procedimientos.id', 'procedimientos.id as proc_id', 'procedimientos.nombre', 'detalle_procedimientos.estado')
                            ->where('detalle_procedimientos.det_id', '=', $id)
                            ->get();

        return response()->json($procedimiento);
    }

    public function getAllMaterials()
    {
        $material = Material::where('mat_estado', '!=', 0)
                            ->whereRaw('mat_cantidad - mat_ventas != 0')
                            ->orderby('mat_nombre')
                            ->get();
        $umed_ids = $material->pluck('umed_id')->toArray();

        // Obtenemos los valores de unidad de medida correspondientes
        $unidades = [];
        foreach ($umed_ids as $umed_id) {
            $unidad = UMedida::find($umed_id);
            if (!$unidad) {
                $unidad = '';
            } else {
                $unidad = $unidad->unidad;
            }
            $unidades[] = $unidad;
        }

        // Añadimos los valores de unidad de medida a cada objeto de mat$material
        foreach ($material as $key => $value) {
            $value->unidad = $unidades[$key];
        }
        return response()->json($material);
    }

    public function getGrupos()
    {
        $grupos = Grupo::orderByDesc('id')->get();
        return response()->json($grupos);
    }

    public function getSubgrupos()
    {
        $subgrupos = Subgrupo::orderByDesc('id')->get();
        return response()->json($subgrupos);
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
            'est_cod' => 'required|unique:estudios|max:10',
            'est_nombre' => 'required|max:255',
            'est_muestra' => 'required',
            'est_precio' => 'required|decimal:2',
            'est_grupo' => 'required'
        ]);

        $estudio = Estudio::create([
            'est_cod' => $request->input('est_cod'),
            'est_nombre' => $request->input('est_nombre'),
            'est_descripcion' => $request->input('est_descripcion'),
            'est_precio' => $request->input('est_precio'),
            'est_moneda' => $request->input('est_moneda'),
            'grupo_id' => $request->input('est_grupo'),
            'subgrupo_id' => $request->input('est_subgrupo')
        ]);

        Detalle::create([
            'estudio_id' => $estudio->id,
            'muestra_id' => $request->input('est_muestra'),
            'recipiente_id' => $request->input('est_recipiente'),
            'indicacion_id' => $request->input('est_indicaciones'),
            'tipo' => 'DESHABILITADO'
        ]);

        

    }

    /**
     * Display the specified resource.
     */
    public function show(Estudio $estudio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $estudio = DB::table('estudios as e')
                    ->join('grupos as g', 'g.id', '=', 'e.grupo_id')
                    ->leftJoin('subgrupos as sg', 'sg.id', '=', 'e.subgrupo_id')
                    ->join('detalles as d', 'e.id', '=', 'd.estudio_id')
                    ->join('muestras as m', 'm.id', '=', 'd.muestra_id')
                    ->leftJoin('recipientes as r' , 'r.id', '=', 'd.recipiente_id')
                    ->join('indications as i', 'i.id', '=', 'd.indicacion_id')
                    ->select('e.*', 'd.muestra_id', 'd.recipiente_id', 'd.indicacion_id')
                    ->where('d.id', '=', $id)
                    ->get();
        return response()->json($estudio);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'est_nombre_update' => 'required|max:255',
            'est_muestra_update' => 'required',
            'est_precio_update' => 'required|decimal:2',
            'est_grupos_update' => 'required'
        ]);        

        $estudio = Estudio::find($id);
        $estudio->update([
            'est_cod' => $request->input('est_cod_update'),
            'est_nombre' => $request->input('est_nombre_update'),
            'est_descripcion' => $request->input('est_descripcion_update'),
            'est_precio' => $request->input('est_precio_update'),
            'est_moneda' => $request->input('est_moneda_update'),
            'grupo_id' => $request->input('est_grupos_update'),
            'subgrupo_id' => $request->input('est_subgrupos_update')
        ]);

        $detalle = Detalle::where('estudio_id', '=', $id)->first();
        $detalle->update([
            'estudio_id' => $estudio->id,
            'muestra_id' => $request->input('est_muestra_update'),
            'recipiente_id' => $request->input('est_recipiente_update'),
            'indicacion_id' => $request->input('est_indicaciones_update'),
        ]);

        return redirect()->route('estudio')->with('success', 'El registro se ha actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudio $estudio)
    {
        //
    }
}
