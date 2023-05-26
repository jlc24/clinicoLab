<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <style>
            .custom-table {
                border-collapse: collapse;
                width: 100%;
                max-width: 800px;
                margin: auto;
                font-family: Arial, sans-serif;
            }

            .custom-table th,
            .custom-table td {
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #fff;
            }

            .custom-table th {
                background-color: #fff;
            }

            .custom-table tfoot tr td {
                background-color: #fff;
                text-align: right;
                border-top: 1px solid #fff;
            }

            .custom-table .text-right {
                text-align: right;
            }

            .custom-table td {
                font-size: 15px;
            }

            .custom-table tbody tr {
                margin-bottom: 0;
                padding-bottom: 0;
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

        </style>
        <title>Factura</title>
    </head>
    <body>
        <h3>{{ $config->nombre }}</h3>
        <h6>{{ $config->direccion }}</h6>
        <h6>{{ $config->telefono }}</h6>
        <h6>{{ $config->pais }} - {{ $config->departamento }}</h6>
        
        <h2 class="text-center">{{ __('FACTURA') }}</h2>
        <h4 class="text-center"><strong>Nº: </strong>{{ $paciente->num_factura }}</h4>
        <div class="row">
            <div class="col-xs-11" style="border: 1px solid #b2b3b4; border-radius: 5px; box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3); margin-left: 20px;">
                <table class="table table-sm custom-table">
                    <tbody>
                        <tr>
                            <td><strong>{{ __('Paciente') }}:</strong></td>
                            <td colspan="3">{{ $paciente->nombre }}</td>
                            <td><strong>{{ __('Fecha') }}:</strong></td>
                            <td>{{ date('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td><strong>{{ __('C.I./NIT.') }}:</strong></td>
                            <td>{{ $paciente->cli_ci_nit }}</td>
                            <td><strong>{{ __('Expedido') }}:</strong></td>
                            <td>{{ $paciente->cli_exp_ci }}</td>
                            <td><strong>{{ __('Hora') }}:</strong></td>
                            <td>{{ date('H:i', time()) }}</td>
                        </tr>
                        @if($paciente->nombre_med != null)
                            <tr>
                                <td><strong>{{ __('Medico') }}:</strong></td>
                                <td colspan="5">{{ $paciente->nombre_med }}</td>
                            </tr>
                        @endif
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
        </div><br>
        <p class="text-center" style="font-family: Arial, sans-serif; font-size: 18px;">Son: <strong style="text-decoration: underline;">{{ $paciente->fac_total_literal }}</strong></p>
        <br>
        <br>
        <p class="text-center" style="font-family: Arial, sans-serif; font-size: 15px;">Puedes verificar los resultados de tu análisis clínico en nuestro sitio web: {{ $config->web }}</p>
        <p style="margin-left: 150px; font-family: Arial, sans-serif; font-size: 15px">Usuario:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{ $paciente->cli_correo }}</strong></p>
        <p style="margin-left: 150px; font-family: Arial, sans-serif; font-size: 15px">Contraseña:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{ $paciente->cli_password }}</strong></p>
    </body>
</html>