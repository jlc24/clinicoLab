<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="{{ $config->nombre }}_{{ $config->nit }}_{{ $paciente->factura }}">
        <meta name="description" content="Recibo realizado en {{ $config->nombre }}">
        <meta name="keywords" content="Resultado, Estudio, Análisis, Pruebas, Recibo">
        <meta name="copyright" content="Copyright &copy; {{ date('Y') }}-{{ $config->nombre }}">
        <!-- Bootstrap CSS -->
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <style>
            .encabezado {
                border-collapse: collapse;
                width: auto;
                max-width: 800px;
                margin: auto;
                font-family: Arial, sans-serif;
                border: 1px solid #fff;
            }

            .encabezado td {
                padding: 0px;
                font-size: 10px;
            }

            .custom-table {
                border-collapse: collapse;
                width: 100%;
                max-width: 800px;
                margin: auto;
                font-family: Arial, sans-serif;
                padding: 5px 0px 5px 10px;
            }
            .custom-table th,
            .custom-table td {
                padding: 0px;
                text-align: left;
                border: 1px solid #fff;
            }
            .custom-table .text-right {
                text-align: right;
            }
            .custom-table td {
                font-size: 15px;
            }
            .custom-table tbody tr {
                margin: 10px;
                padding: 10px;
            }

            .table-descripcion {
                border-collapse: collapse;
                width: 710px;
                max-width: 800px;
                font-family: Arial, sans-serif;
                border: 3px solid white;
            }

            .table-descripcion thead {
                background-color: #2AA6E5;
                color: white;
            }

            .table-descripcion tbody tr:nth-of-type(odd) {
                background-color: #E9F0FE;
            }

            .table-descripcion tbody tr:nth-of-type(even) {
                background-color: #FFF;
            }

            .table-descripcion th,
            .table-descripcion td {
                padding: 10px;
                font-size: 15px;
                border: 2px solid white;
            }

            .table-descripcion tfoot td:nth-child(-n+3) {
                background-color: white;
            }

            .table-descripcion tfoot td:nth-last-child(-n+3) {
                background-color: white;
                background-color: #2AA6E5;
                text-align: right;
                color: white;
            }
            .marca-de-agua {
                position: absolute;
                top: 50%; /* Ajusta la posición vertical de la marca de agua */
                left: 50%; /* Ajusta la posición horizontal de la marca de agua */
                transform: translate(-50%, -50%); /* Centra la marca de agua */
                opacity: 0.1; /* Ajusta la opacidad de la marca de agua */
                z-index: 999; /* Asegúrate de que la marca de agua aparezca encima del contenido */
            }
            .marca-de-agua img {
                max-width: 400px;
                width: auto;
            }
        </style>
        <title>Recibo</title>
    </head>
    <body>
        <div class="row">
            <div class="col-xl-11" style="display: inline">
                <div class="col-xl-3" style="display: inline">
                    <div class="" style="width: 100px; height: auto; background-color: #fff; padding: 5px; border: 1px solid #fff; display: inline-block;">
                        @if($config->logo == null)
                            <img src="{{ asset('dist/img/default.png') }}" alt="" width="100px">
                        @else
                            <img src="{{ asset($config->logo) }}" alt="" width="100px" style="border-radius: 50%;">
                        @endif
                    </div>
                </div>
                <div class="col-xl-5" style="display: inline">
                    <div style="width: 500px; height: auto; background-color: #fff; padding: 5px; border: 1px solid #fff; display: inline-block;">
                        <p>Direccion: <span style="white-space: nowrap; text-transform: capitalize;">{{ $config->direccion }}</span></p>  
                        <p>Teléfono(s): <span style="color: #2c90e2">{{ $config->telefono }}</span></p>
                        <p>Pag. Web: <span style="color: #2c90e2">{{ $config->web }}</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="border: 1px solid #555555; padding: 5px; border-radius: 10px;" >
            <div class="marca-de-agua">
                <img src="{{ asset($config->logo) }}" alt="Marca de Agua">
            </div>
            <h3 class="text-center" style="color: #2c90e2">{{ __('RECIBO') }}</h3>
            <h4 class="text-center"><strong>Nº: </strong>{{ $paciente->num_factura }}</h4>
            <div class="row">
                <div style="border: 1px solid #2c90e2; border-radius: 5px; box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3); margin-left: 20px; margin-right: 20px;">
                    <table class="custom-table">
                        <tbody>
                            <tr>
                                <td style="color: #2c90e2"><strong>{{ __('Nombre') }}:</strong></td>
                                <td colspan="3">{{ $paciente->nombre }}</td>
                                <td style="color: #2c90e2"><strong>{{ __('Fecha') }}:</strong></td>
                                <td>{{ date('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td style="color: #2c90e2"><strong>{{ __('C.I./NIT.') }}:</strong></td>
                                <td>{{ $paciente->cli_ci_nit }}</td>
                                <td style="color: #2c90e2"><strong>{{ __('Expedido') }}:</strong></td>
                                <td>{{ $paciente->cli_exp_ci }}</td>
                                <td style="color: #2c90e2"><strong>{{ __('Hora') }}:</strong></td>
                                <td>{{ date('H:i', time()) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <h4>{{ __('DETALLE') }}:</h4>
            <div class="row">
                <div class="col-xs-12">
                    <table class="table-descripcion">
                        <thead >
                            <tr>
                                <th>#</th>
                                <th>{{ __('DESCRIPCION') }}</th>
                                <th class="text-center">{{ __('CANTIDAD') }}</th>
                                <th class="text-center">{{ __('P. UNITARIO') }}</th>
                                <th class="text-center">{{ __('TOTAL') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estudios as $estudio)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $estudio->est_nombre }}</td>
                                    <td class="text-center">1</td>
                                    <td class="text-right">{{ $estudio->est_precio }}</td>
                                    <td class="text-right">{{ $estudio->est_precio }}</td>
                                    <td class="text-right">Bs</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right"><strong>TOTAL</strong></td>
                                <td class="text-right" id="fac_total"><strong>{{ $paciente->fac_total }}</strong></td>
                                <td>Bs</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <p class="text-center" style="font-family: Arial, sans-serif; font-size: 18px;"></p>
            
            <p class="text-center" style="font-family: Arial, sans-serif; font-size: 15px;"></p>
            <table class="custom-table" style="margin: 0px 0px 0px 0px;">
                <tbody>
                    <tr>
                        <td colspan="4">Son: <strong style="text-decoration: underline;">{{ $paciente->fac_total_literal }}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="4">Puedes verificar los resultados de tu análisis clínico en nuestro sitio web: <strong style="color: #2c90e2">{{ $config->web }}</strong></td>
                    </tr>
                    <tr>
                        <td style="width: 100px"></td>
                        <td></td>
                        <td></td>
                        <td rowspan="4" class="text-center">
                            @if($paciente->cli_qr != null)
                                <img src="{{ asset('storage/'.$paciente->cli_qr) }}" alt="" width="100px">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 100px"></td>
                        <td style="width: 150px">Usuario:</td>
                        <td style="width: 250px"><strong>{{ $paciente->cli_correo }}</strong></td>
                    </tr>
                    <tr>
                        <td style="width: 100px"></td>
                        <td style="width: 150px">Contraseña:</td>
                        <td style="width: 250px"><strong>{{ $paciente->cli_password }}</strong></td>
                    </tr>
                    <tr>
                        <td style="width: 100px"></td>
                        <td></td>
                        <td></td>
                    </tr><br><br><br><br>
                    <tr>
                        <td colspan="4" style="text-align: center">{{ Auth::user()->usuario->usuario_nombre }} {{ Auth::user()->usuario->usuario_apellido_pat }} {{ Auth::user()->usuario->usuario_apellido_mat }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: center">{{ __('Recepción') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>