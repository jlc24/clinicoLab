<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use App\Models\Medico;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Permiso;
use App\Models\PermisoUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departamentos = Departamento::all();
        $countmed = Medico::count();
        $medicos = Medico::all();
        return view('medico.index',[
            'medicos' => $medicos, 
            'departamentos' => $departamentos,
            'municipios' => Municipio::all(), 
            'countmed' => $countmed,
            'permisos' => Permiso::all(),
            'bancos' => Banco::all(),
        ]);
    }

    public function getMedicosEstudio($id)
    {
        $medicos = DB::table('medicos as med')
                        ->join('facturas as f', 'f.med_id', '=', 'med.id')
                        ->join('recepcions as r', 'f.id', '=', 'r.fac_id')
                        ->join('detalles as d', 'r.det_id', '=', 'd.id')
                        ->join('estudios as e', 'e.id', '=', 'd.estudio_id')
                        ->select('med.id', DB::raw("CONCAT(med.med_nombre, ' ', 
                                            med.med_apellido_pat, ' ', 
                                            med.med_apellido_mat) AS nombre"), 'med.med_convenio', DB::raw('COUNT(*) as cantidad'), 'e.est_nombre')
                        ->where('d.id', '=', $id)
                        ->groupBy('med.id', 'nombre', 'med.med_convenio', 'e.est_nombre')
                        ->get();
        return response()->json($medicos);
    }

    public function countMedicos()
    {
        $medicos = Medico::count();
        return response()->json($medicos);
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
        if ($request->hasFile('med_qr')) {
            $request->validate([
                'med_cod' => 'required|unique:medicos|max:10', 
                'med_nombre' => 'required|max:20',
                'med_apellido_pat' => 'required|max:50',
                'med_apellido_mat' => 'max:50',
                'med_convenio' => 'required',
                'med_banco' => 'required',
                'med_cuenta' => 'required',
                'med_qr' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
                'med_genero' => 'required|max:10', 
                'med_email' => 'required|email|max:255',
                'med_direccion' => 'max:255',
                'med_celular' => 'required|max:15',
                'med_especialidad' => 'max:50',
                'med_usuario' => 'required|max:10',
                'med_password' => 'required',
            ]);

            $user = User::create([
                'user' => $request->input('med_usuario'),
                'email' => $request->input('med_email'),
                'password' => Hash::make($request->input('med_password')),
                'estado' => $request->input('med_estado'),
                'rol' => $request->input('med_rol')
            ]);
    
            $medico = Medico::create([
                'med_cod' => $request->input('med_cod'),
                'med_nombre' => $request->input('med_nombre'),
                'med_apellido_pat' => $request->input('med_apellido_pat'),
                'med_apellido_mat' => $request->input('med_apellido_mat'),
                'med_ci_nit' => $request->input('med_ci_nit'),
                'med_exp_ci' => $request->input('med_ci_nit_exp'),
                'med_genero' => $request->input('med_genero'),
                'med_convenio' => $request->input('med_convenio'),
                'med_banco' => $request->input('med_banco'),
                'med_cuenta' => $request->input('med_cuenta'),
                'med_correo' => $request->input('med_email'),
                'med_celular' => $request->input('med_celular'),
                'med_direccion' => $request->input('med_direccion'),
                'med_especialidad' => $request->input('med_especialidad'),
                'med_usuario' => $request->input('med_usuario'),
                'med_password' => $request->input('med_password'),
                'dep_id' => $request->input('med_departamento'),
                'mun_id' => $request->input('med_municipio'),
                'user_id' => $user->id
            ]);

            $qr = $request->file('med_qr');
            $nombreQR = time()."_".$qr->getClientOriginalName();
            $rutaCarpetaDestino = "public/QR/".$medico->id."/";
            if (!Storage::exists($rutaCarpetaDestino)) {
                Storage::makeDirectory($rutaCarpetaDestino);
            }
            $newdirectory = str_replace("public/", "", $rutaCarpetaDestino);
            $ruta = $newdirectory.$nombreQR;
            
            $qr->move(storage_path('app/'.$rutaCarpetaDestino), $nombreQR);
                
            $permisos = Permiso::all();
            foreach ($permisos as $permiso) {
                PermisoUser::create([
                    'user_id' => $user->id,
                    'permiso_id' => $permiso->id,
                    'estado' => 0
                ]);
            }
            
        }else{
            $request->validate([
                'med_cod' => 'required|unique:medicos|max:10', 
                'med_nombre' => 'required|max:20',
                'med_apellido_pat' => 'required|max:50',
                'med_apellido_mat' => 'max:50',
                'med_convenio' => 'required',
                'med_banco' => 'required',
                'med_cuenta' => 'required',
                'med_genero' => 'required|max:10', 
                'med_email' => 'required|email|max:255',
                'med_direccion' => 'max:255',
                'med_celular' => 'required|max:15',
                'med_especialidad' => 'max:50',
                'med_usuario' => 'required|max:10',
                'med_password' => 'required',
            ]);

            // dd($request->all());
            $user = User::create([
                'user' => $request->input('med_usuario'),
                'email' => $request->input('med_email'),
                'password' => Hash::make($request->input('med_password')),
                'estado' => $request->input('med_estado'),
                'rol' => $request->input('med_rol')
            ]);
    
            $medico = Medico::create([
                'med_cod' => $request->input('med_cod'),
                'med_nombre' => $request->input('med_nombre'),
                'med_apellido_pat' => $request->input('med_apellido_pat'),
                'med_apellido_mat' => $request->input('med_apellido_mat'),
                'med_ci_nit' => $request->input('med_ci_nit'),
                'med_exp_ci' => $request->input('med_ci_nit_exp'),
                'med_genero' => $request->input('med_genero'),
                'med_convenio' => $request->input('med_convenio'),
                'med_banco' => $request->input('med_banco'),
                'med_cuenta' => $request->input('med_cuenta'),
                'med_correo' => $request->input('med_email'),
                'med_celular' => $request->input('med_celular'),
                'med_direccion' => $request->input('med_direccion'),
                'med_especialidad' => $request->input('med_especialidad'),
                'med_usuario' => $request->input('med_usuario'),
                'med_password' => $request->input('med_password'),
                'dep_id' => $request->input('med_departamento'),
                'mun_id' => $request->input('med_municipio'),
                'user_id' => $user->id
            ]);

            $ruta = null;
    
            $permisos = Permiso::all();
            foreach ($permisos as $permiso ) {
                PermisoUser::create([
                    'user_id' => $user->id,
                    'permiso_id' => $permiso->id,
                    'estado' => 0
                ]);
            }
        }

        $medicoQR = Medico::find($medico->id);
        $medicoQR->med_qr = $ruta;
        $medicoQR->save();

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $medicoQR = Medico::find($id);
        return response()->json($medicoQR);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medico $medico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'med_nombre_update' => 'required|max:20',
            'med_apellido_pat_update' => 'required|max:50',
            'med_genero_update' => 'required|max:10', 
            'med_celular_update' => 'required|max:15',
            'med_convenio_update' => 'required',
            'med_banco_update' => 'required',
            'med_cuenta_update' => 'required',
        ]);
        $medico = Medico::find($id);
        $medico->update([
            
            'med_nombre' => $request->input('med_nombre_update'),
            'med_apellido_pat' => $request->input('med_apellido_pat_update'),
            'med_apellido_mat' => $request->input('med_apellido_mat_update'),
            'med_ci_nit' => $request->input('med_ci_nit_update'),
            'med_exp_ci' => $request->input('med_ci_nit_exp_update'),
            'med_genero' => $request->input('med_genero_update'),
            'med_celular' => $request->input('med_celular_update'),
            'med_direccion' => $request->input('med_direccion_update'),
            'med_especialidad' => $request->input('med_especialidad_update'),
            'dep_id' => $request->input('med_departamento_update'),
            'mun_id' => $request->input('med_municipio_update'),
            'med_convenio' => $request->input('med_convenio_update'),
            'med_banco' => $request->input('med_banco_update'),
            'med_cuenta' => $request->input('med_cuenta_update')
        ]);
        
        return redirect()->route('medico')->with('success', 'El registro se ha modificado con éxito');
    }

    public function updateQR(Request $request, $id)
    {
        if ($request->hasFile('med_qr_update')) {
            $request->validate([
                'med_qr' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            ]);

            $qr = $request->file('med_qr_update');
            $nombreQR = time()."_".$qr->getClientOriginalName();
            $rutaCarpetaDestino = "public/QR/".$id."/";
            if (!Storage::exists($rutaCarpetaDestino)) {
                Storage::makeDirectory($rutaCarpetaDestino);
            }
            $newdirectory = str_replace("public/", "", $rutaCarpetaDestino);
            $ruta = $newdirectory.$nombreQR;
            
            $qr->move(storage_path('app/'.$rutaCarpetaDestino), $nombreQR);

            $medicoQR = Medico::find($id);
            $medicoQR->med_qr = $ruta;
            $medicoQR->save();
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medico $medico)
    {
        //
    }
}
