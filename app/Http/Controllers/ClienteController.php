<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use App\Models\Cliente;
use App\Models\Configuration;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Grupo;
use App\Models\Medico;
use App\Models\Municipio;
use App\Models\Permiso;
use App\Models\PermisoUser;
use App\Models\Subgrupo;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        foreach ($clientes as $cliente) {
            $fec_nac = new DateTime($cliente->cli_fec_nac);
            $hoy = new DateTime();
            $edad = $hoy->diff($fec_nac)->y;
            $cliente->cli_edad = $edad;
        }
        return view('cliente.index', [
            'departamentos' => Departamento::all(), 
            'clientes' => $clientes,
            'countpac' => Cliente::count(),
            'municipios' => Municipio::all(),
            'medicos' => Medico::all(),
            'bancos' => Banco::all()
        ]);
    }

    public function countClientes()
    {
        $clientes = Cliente::count();
        return response()->json($clientes);
    }

    public function clientes($id)
    {
        $clientes = Cliente::where('id', $id)->get();
        foreach ($clientes as $cliente) {
            $fec_nac = new DateTime($cliente->cli_fec_nac);
            $hoy = new DateTime();
            $edad = $hoy->diff($fec_nac)->y;
            $cliente->cli_edad = $edad;
        }
        return response()->json($clientes);
    }

    public function datos($id)
    {
        $datos = Municipio::where('dep_id', $id)->get();
        return response()->json($datos);
    }
    
    public function getEstudioClienteRecepcion($id)
    {
        $cliente = DB::table('clientes as c')
                        ->join('facturas as f', 'f.cli_id', '=', 'c.id')
                        ->join('recepcions as r', 'r.fac_id', '=', 'f.id')
                        ->join('detalles as d', 'r.det_id', '=', 'd.id')
                        ->join('estudios as e', 'd.estudio_id', '=', 'e.id')
                        ->select('r.id as rec_id', 'e.est_cod', 'e.est_nombre', 'e.est_precio', 'e.est_moneda', 'f.fac_total', 'f.fac_importe', 'f.fac_cambio',
                                    DB::raw("DATE_FORMAT(r.created_at, '%d-%m-%Y') as fecha"),
                                    DB::raw("DATE_FORMAT(r.created_at, '%H:%i') as hora"), 'r.estado')
                        ->where('c.id', '=', $id)
                        ->get();
        return response()->json($cliente);
    }

    public function getMedicos()
    {
        $medicos = Medico::orderByDesc('id')->get();
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
        $request->validate([
            'cli_cod' => 'required|unique:clientes|max:10',
            'cli_nombre' => 'required|max:20',
            'cli_apellido_pat' => 'required|max:20',
            'cli_fec_nac' => 'required|date',
            'cli_genero' => 'required|max:10',
            'cli_email' => 'required|email|max:255',
            'cli_celular' => 'required|max:15',
            'cli_usuario' => 'required|max:10',
            'cli_password' => 'required',
            'cli_estado' => 'required',
            'cli_rol' => 'required'
        ]);
        // dd($request->all());

        
        $user = User::create([
            'user' => $request->input('cli_usuario'),
            'email' => $request->input('cli_email'),
            'password' => Hash::make($request->input('cli_password')),
            'estado' => $request->input('cli_estado'),
            'rol' => $request->input('cli_rol')
        ]);
        
        // Crear registro de cliente y asociarlo con el usuario creado anteriormente
        $paciente = Cliente::create([
            'cli_cod' => $request->input('cli_cod'),
            'cli_nombre' => $request->input('cli_nombre'),
            'cli_apellido_pat' => $request->input('cli_apellido_pat'),
            'cli_apellido_mat' => $request->input('cli_apellido_mat'),
            'cli_ci_nit' => $request->input('cli_ci_nit'),
            'cli_exp_ci' => $request->input('cli_ci_nit_exp'),
            'cli_fec_nac' => $request->input('cli_fec_nac'),
            'cli_genero' => $request->input('cli_genero'),
            'cli_correo' => $request->input('cli_email'),
            'cli_direccion' => $request->input('cli_direccion'),
            'cli_celular' => $request->input('cli_celular'),
            'cli_usuario' => $request->input('cli_usuario'),
            'cli_password' => $request->input('cli_password'),
            'dep_id' => $request->input('cli_departamento'),
            'mun_id' => $request->input('cli_municipio'),
            'med_id' => $request->input('med_id'),
            'user_id' => $user->id
        ]);

        $config = Configuration::first();

        $randomNumber = mt_rand(1000000, 9999999);

        $id = $paciente->id;
        $codigo = $paciente->cli_cod;
        $carnet = $randomNumber;
        $email = $paciente->cli_correo;
        $usuario = $paciente->cli_usuario;
        $pass = $paciente->cli_password;
        $web = $config->web;
        $logo = $config->logo;
        $fecha = now()->format('Ymd');

        $qrdata = [
            'Correo' => $email,
            'Usuario' => $usuario,
            'Contrasena' => $pass,
            'Sitio WEB' => $web
        ];

        $qrCode = QrCode::format('png')
                        ->size(400)
                        //->merge(public_path($logo), 0.5, true)
                        ->generate(json_encode($qrdata));

        $qrname = $fecha."_".$id.$codigo."_".$carnet."_QR.png";
        $directorio = "public/pacienteQR/".$id."/";

        if (!Storage::exists($directorio)) {
            Storage::makeDirectory($directorio);
        }

        $directorioRuta = str_replace("public/", "", $directorio);
        $ruta = $directorioRuta.$qrname;

        $qrCodePath = storage_path('app/'.$directorio . $qrname);
        file_put_contents($qrCodePath, $qrCode);

        if (file_exists($qrCodePath)) {
            $paceinteQR = Cliente::find($paciente->id);
            $paceinteQR->cli_qr = $ruta;
            $paceinteQR->save();
        }else{
            return false;
        }

    }

    public function generarQR($id)
    {
        $paciente = Cliente::find($id);
        $config = Configuration::first();

        $id = $paciente->id;
        $codigo = $paciente->cli_cod;
        $carnet = $paciente->cli_ci_nit;
        $email = $paciente->cli_correo;
        $usuario = $paciente->cli_usuario;
        $pass = $paciente->cli_password;
        $web = $config->web;
        $logo = $config->logo;
        $fecha = now()->format('Ymd');

        $qrdata = [
            'Correo' => $email,
            'Usuario' => $usuario,
            'Contrasena' => $pass,
            'Sitio WEB' => $web
        ];

        $qrCode = QrCode::format('png')
                        ->size(400)
                        //->merge(public_path($logo), 0.25, true)
                        ->generate(json_encode($qrdata));

        $qrname = $fecha."_".$id.$codigo."_".$carnet."_QR.png";
        $directorio = "public/pacienteQR/".$id."/";

        if (!Storage::exists($directorio)) {
            Storage::makeDirectory($directorio);
        }

        $directorioRuta = str_replace("public/", "", $directorio);
        $ruta = $directorioRuta.$qrname;

        $qrCodePath = storage_path('app/'.$directorio . $qrname);
        file_put_contents($qrCodePath, $qrCode);

        if (file_exists($qrCodePath)) {
            $paceinteQR = Cliente::find($paciente->id);
            $paceinteQR->cli_qr = $ruta;
            $paceinteQR->save();
        }else{
            return false;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $clientes = DB::table('clientes as c')
                    ->join('users as u', 'u.id', '=', 'c.user_id')
                    ->leftJoin('departamentos as d', 'd.id', '=', 'c.dep_id')
                    ->leftJoin('municipios as m', 'm.id', '=', 'c.mun_id')
                    ->leftJoin('medicos as med', 'med.id', '=', 'c.med_id')
                    ->select('c.*', 'u.estado', 'm.nombre as mun', 'd.nombre as dep', 'med.med_nombre', 'med.med_apellido_pat', 'med.med_apellido_mat')
                    ->where('c.id', '=', $id)
                    ->get();

        foreach ($clientes as $cliente) {
            $fec_nac = new DateTime($cliente->cli_fec_nac);
            $hoy = new DateTime();
            $edad = $hoy->diff($fec_nac)->y;
            $cliente->cli_edad = $edad;

            $espanol = setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'es');
            $fechaNacimiento = new DateTime($cliente->cli_fec_nac);
            $cliente->fecha_nacimiento = strftime('%e de %B de %Y', $fechaNacimiento->getTimestamp());
        }
        
        return response()->json($clientes);
    }

    public function updateActivarClientEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|integer'
        ]);
        
        $cliente = Cliente::find($id);
        $user = User::find($cliente->user_id);
        $user->estado = '1';
        $user->save();
    }
    public function updateDesactivarClientEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|integer'
        ]);
        
        $cliente = Cliente::find($id);
        $user = User::find($cliente->user_id);
        $user->estado = '0';
        $user->save();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cli_nombre_update' => 'required|max:20',
            'cli_apellido_pat_update' => 'required|max:20',
            'cli_fec_nac_update' => 'required|date',
            'cli_genero_update' => 'required|max:10',
            'cli_celular_update' => 'required|max:15',
            'cli_rol_update' => 'required'
        ]);
        
        $paciente = Cliente::find($id);
        $paciente->update([
            'cli_cod' => $request->input('cli_cod_update'),
            'cli_nombre' => $request->input('cli_nombre_update'),
            'cli_apellido_pat' => $request->input('cli_apellido_pat_update'),
            'cli_apellido_mat' => $request->input('cli_apellido_mat_update'),
            'cli_ci_nit' => $request->input('cli_ci_nit_update'),
            'cli_exp_ci' => $request->input('cli_ci_nit_exp_update'),
            'cli_fec_nac' => $request->input('cli_fec_nac_update'),
            'cli_genero' => $request->input('cli_genero_update'),
            'cli_direccion' => $request->input('cli_direccion_update'),
            'cli_celular' => $request->input('cli_celular_update'),
            'dep_id' => $request->input('cli_departamento_update'),
            'mun_id' => $request->input('cli_municipio_update'),
            'med_id' => $request->input('cli_medico_update')
        ]);

        $config = Configuration::first();

        $id = $paciente->id;
        $codigo = $paciente->cli_cod;
        $carnet = $paciente->cli_ci_nit;
        $email = $paciente->cli_correo;
        $usuario = $paciente->cli_usuario;
        $pass = $paciente->cli_password;
        $web = $config->web;
        $logo = $config->logo;
        $fecha = now()->format('Ymd');

        $qrdata = [
            'Correo' => $email,
            'Usuario' => $usuario,
            'Contrasena' => $pass,
            'Sitio WEB' => $web
        ];

        $qrCode = QrCode::format('png')
                        ->size(400)
                        //->merge(public_path($logo), 0.5, true)
                        ->generate(json_encode($qrdata));

        $qrname = $fecha."_".$id.$codigo."_".$carnet."_QR.png";
        $directorio = "public/pacienteQR/".$id."/";

        if (!Storage::exists($directorio)) {
            Storage::makeDirectory($directorio);
        }

        $directorioRuta = str_replace("public/", "", $directorio);
        $ruta = $directorioRuta.$qrname;

        $qrCodePath = storage_path('app/'.$directorio . $qrname);
        file_put_contents($qrCodePath, $qrCode);

        if (file_exists($qrCodePath)) {
            $paceinteQR = Cliente::find($paciente->id);
            $paceinteQR->cli_qr = $ruta;
            $paceinteQR->save();
        }else{
            return false;
        }

        return redirect()->route('cliente')->with('success', 'El registro se ha actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
