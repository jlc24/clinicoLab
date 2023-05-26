<?php

namespace App\Http\Controllers;

use App\Models\ComponenteAspecto;
use App\Models\Configuration;
use App\Models\Detalle;
use App\Models\DetalleProcedimiento;
use App\Models\DpComponente;
use App\Models\Factura;
use App\Models\Medico;
use App\Models\Procedimiento;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function pdfFactura($id) //id de factura
    {
        $paciente = DB::table('clientes as c')
                    ->join('facturas as f', 'f.cli_id', '=', 'c.id')
                    ->join('recepcions as r', 'r.fac_id', '=', 'f.id')
                    ->leftjoin('medicos as m', 'm.id', '=', 'c.med_id')
                    ->select('f.id as factura', 'f.fac_total', 'f.fac_ruta_file', 'c.cli_fec_nac', 'c.*', 'c.id as cli_id',
                            DB::raw("CONCAT(c.cli_nombre, ' ', 
                                            c.cli_apellido_pat, ' ', 
                                            c.cli_apellido_mat) AS nombre"), 
                            DB::raw("DATE_FORMAT(r.created_at, '%d-%m-%Y') as fecha"),
                            DB::raw("DATE_FORMAT(r.created_at, '%H:%i') as hora"), 
                            DB::raw("CONCAT(m.med_nombre, ' ', 
                                            m.med_apellido_pat, ' ', 
                                            m.med_apellido_mat) AS nombre_med"))
                    ->where('f.id', '=', $id)
                    ->first();
        if ($paciente->fac_ruta_file == null) {
            $fecha_nac = new DateTime($paciente->cli_fec_nac);
            $hoy = new DateTime();
            $edad = $hoy->diff($fecha_nac)->y;
            $paciente->edad = $edad;
            
            $estudios = DB::table('detalles as d')
                        ->join('estudios as e', 'e.id', '=', 'd.estudio_id')
                        ->join('recepcions as r', 'r.det_id', '=', 'd.id')
                        ->join('facturas as f', 'f.id', '=', 'r.fac_id')
                        ->join('clientes as c', 'f.cli_id', '=', 'c.id')
                        ->select('e.est_nombre', 'e.est_precio', 'e.est_precio', 'e.est_moneda')
                        ->where('f.id', '=', $id)
                        ->get();
            
    
            function convertirNumeroALetras($numero) {
                list($parteEnteraStr, $parteDecimalStr) = explode('.', strval($numero));
                $parteEntera = intval($parteEnteraStr);
                $parteDecimal = intval(isset($parteDecimalStr) ? $parteDecimalStr : '0');
            
                $resultado = '';
            
                if ($parteEntera > 0) {
                    if ($parteEntera === 1) {
                        $resultado = 'un boliviano';
                    } else {
                        $resultado = numeroALetras($parteEntera);
                    }
                }
            
                if ($parteDecimal > 0) {
                    $centavosEnLetras = str_pad(strval($parteDecimal), 2, '0', STR_PAD_LEFT);
                    $resultado .= " con {$centavosEnLetras}/100 bolivianos";
                }else{
                    $resultado .= " con 00/100 bolivianos";
                }
            
                return $resultado;
            }
            
            function numeroALetras($numero) {
                $unidades = ['', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve'];
                $decenas = ['diez', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve'];
                $decenas2 = ['','diez', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'];
                $centenas = ['', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos'];
                $resultado = '';
                if ($numero === 0) {
                    return 'cero';
                }
                if ($numero >= 1000) {
                    $millares = floor($numero / 1000);
                    $resultado .= numeroALetras($millares) . ' mil ';
                    $numero %= 1000;
                }
                if ($numero >= 100) {
                    $resultado .= $centenas[floor($numero / 100)] . ' ';
                    $numero %= 100;
                }
                if ($numero >= 10 && $numero < 20) {
                    $resultado .= $decenas[$numero - 10] . ' ';
                    $numero = 0;
                }
                if ($numero >= 20 || $numero === 10) {
                    if ($numero >= 21 && $numero <= 29) {
                        switch ($numero) {  case '21': $resultado .= 'veintiuno'; break;
                                            case '22': $resultado .= 'veintidós'; break;
                                            case '23': $resultado .= 'veintitrés'; break;
                                            case '24': $resultado .= 'veinticuatro'; break;
                                            case '25': $resultado .= 'veinticinco'; break;
                                            case '26': $resultado .= 'veintiséis'; break;
                                            case '27': $resultado .= 'veintisiete'; break;
                                            case '28': $resultado .= 'veintiocho'; break;
                                            case '29': $resultado .= 'veintinueve'; break;
                        }
                        $numero = 0;
                    }else{
                        $resultado .= $decenas2[floor($numero / 10)] . ' ';
                        $numero %= 10;
                    }
                }
                if ($numero > 0) {
                    $resultado .= $unidades[$numero] . ' ';
                }
                return trim($resultado);
            }
    
            $num = $paciente->fac_total;
            $fac_total_literal = convertirNumeroALetras(($num));
            $paciente->fac_total_literal = $fac_total_literal;
    
            $factura = $paciente->factura;
            $factura = str_pad($factura, 6, '0', STR_PAD_LEFT);
            $paciente->num_factura = $factura;
            
            //var_dump($paciente);
    
            $pdf = Pdf::loadView('recepcion.pdf.recepcion', [
                'config' => Configuration::all()->first(), 
                'paciente' => $paciente,
                'estudios' => $estudios
            ]);
    
            $date = now()->format('Ymd');
            $filename = "factura_"."$id".$date.$id."_cancelado.pdf";
            $directory = "public/factura/".$id."/";
    
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }
            $newdirectory = str_replace("public/", "", $directory);
            $ruta = $newdirectory.$filename;
            
            $facfile = Factura::find($id);
            $facfile->fac_ruta_file = $ruta;
            $facfile->save();
            
            $pdf->save(storage_path('app/'.$directory.$filename));
            
            //return $pdf->stream('factura.pdf');
            return response()->json($facfile);
        }
            
    }

    public function getRutaFacturaCliente($id)
    {
        $facturapdf = Factura::find($id);
        return response()->json($facturapdf);
    }

    public function pdfResultado($id) //id de recepcion por factura
    {
        $paciente = DB::table('clientes as c')
                    ->join('facturas as f', 'f.cli_id', '=', 'c.id')
                    ->join('recepcions as r', 'r.fac_id', '=', 'f.id')
                    ->leftjoin('medicos as m', 'm.id', '=', 'c.med_id')
                    ->select('f.id as factura', 'f.fac_total', 'r.id as rec_id', 'c.cli_fec_nac', 'c.*', 'c.id as cli_id',
                            DB::raw("CONCAT(c.cli_nombre, ' ', 
                                            c.cli_apellido_pat, ' ', 
                                            c.cli_apellido_mat) AS nombre"), 
                            DB::raw("DATE_FORMAT(r.created_at, '%d/%m/%Y') as fecha"),
                            DB::raw("DATE_FORMAT(r.updated_at, '%d/%m/%Y') as fecha_update"),
                            DB::raw("DATE_FORMAT(r.created_at, '%H:%i') as hora"), 
                            DB::raw("CONCAT(m.med_nombre, ' ', 
                                            m.med_apellido_pat, ' ', 
                                            m.med_apellido_mat) AS nombre_med"))
                    ->where('r.id', '=', $id)
                    ->first();
        
        $fecha_nac = new DateTime($paciente->cli_fec_nac);
        $hoy = new DateTime();
        $edad = $hoy->diff($fecha_nac)->y;
        $paciente->edad = $edad;
        
        $estudio = DB::table('detalles as d')
                    ->join('estudios as e', 'e.id', '=', 'd.estudio_id')
                    ->join('recepcions as r', 'r.det_id', '=', 'd.id')
                    ->join('facturas as f', 'f.id', '=', 'r.fac_id')
                    ->join('clientes as c', 'f.cli_id', '=', 'c.id')
                    ->select('e.id as est_id', 'e.est_nombre')
                    ->where('r.id', '=', $paciente->rec_id)
                    ->first();

        $results = DB::table('results as res')
                    ->join('recepcions as r', 'res.rec_id', '=', 'r.id')
                    ->join('detalles as d', 'res.det_id', '=', 'd.id')
                    ->join('detalle_procedimientos as dp', 'res.dp_id', '=', 'dp.id')
                    ->join('dp_componentes as dpc', 'res.dpc_id', '=', 'dpc.id')
                    ->join('componentes as c', 'dpc.comp_id', '=', 'c.id')
                    ->join('componente_aspectos as ca', 'res.ca_id', '=', 'ca.id')
                    ->join('parametros as p', 'p.ca_id', '=', 'ca.id')
                    ->join('aspectos as a', 'ca.asp_id', '=', 'a.id')
                    ->select('res.id', 'res.fac_id', 'res.rec_id', 'res.det_id', 'res.dp_id', 'res.dpc_id', 'c.nombre' , 'res.ca_id', 'a.nombre as aspecto', 'res.resultado', 'res.umed_id',
                    'p.referencia')
                    ->where('r.id', '=', $paciente->rec_id)
                    ->get();

        //var_dump($paciente);

        $pdf = Pdf::loadView('resultado.pdf.resultado', [
            'config' => Configuration::all()->first(), 
            'paciente' => $paciente,
            'estudio' => $estudio,
            'results' => $results
        ]);
        return $pdf->stream('resultados.pdf');
    }
}
