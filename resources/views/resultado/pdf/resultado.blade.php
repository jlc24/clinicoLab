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
                padding: 0px;
                text-align: left;
                border: 1px solid #fff;
            }

            .custom-table .text-right {
                text-align: right;
            }

            .custom-table td {
                font-size: 12px;
            }

            .custom-table tbody tr {
                margin: 10px;
                padding: 10px;
            }

            .table-descripcion {
                border-collapse: collapse;
                width: 700px;
                max-width: 800px;
                margin: auto;
                font-family: Arial, sans-serif;
                border: 1px solid #000;
            }

            /* .table-descripcion thead {
                background-color: #2AA6E5;
                color: white;
            } */

            .table-descripcion tbody tr:nth-of-type(odd) {
                background-color: #E9F0FE;
            }

            .table-descripcion tbody tr:nth-of-type(even) {
                background-color: #FFF;
            }

            .table-descripcion th,
            .table-descripcion td {
                padding: 0px;
                font-size: 10px;
                border: 1px solid #000;
            }
            
            .table-descripcion tbody tr td {
                margin: 0px;
                padding: 0px;
            }
        </style>
        <title>Resultado</title>
    </head>
    <body>
        <h4>{{ $config->nombre }}</h4>
        <h6>{{ $config->direccion }}</h6>
        <h6>{{ $config->telefono }}</h6>
        <h6>{{ $config->pais }} - {{ $config->departamento }}</h6>
        
        <h3 class="text-center">{{ __('RESULTADO') }}</h3>
        <div class="row">
            <div class="col-xs-11" style="border: 1px solid #b2b3b4; border-radius: 5px; box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3); margin-left: 20px;">
                <table class="custom-table">
                    <tbody>
                        <tr>
                            <td><strong>{{ __('Codigo') }}:</strong></td>
                            <td>{{ $paciente->cli_cod }}</td>
                            <td><strong>{{ __('Fecha Toma') }}:</strong></td>
                            <td>{{ $paciente->fecha }}</td>
                            <td><strong>{{ __('Hora') }}:</strong></td>
                            <td>{{ $paciente->hora }}</td>
                        </tr>
                        <tr>
                            <td><strong>{{ __('Paciente') }}:</strong></td>
                            <td>{{ $paciente->nombre }}</td>
                            <td><strong>{{ __('Edad') }}:</strong></td>
                            <td>{{ $paciente->edad }} años</td>
                            <td><strong>{{ __('Género') }}:</strong></td>
                            <td>{{ $paciente->cli_genero }}</td>
                        </tr>
                        <tr>
                            <td><strong>{{ __('Medico') }}:</strong></td>
                            <td>@if($paciente->nombre_med !== null)
                                {{ $paciente->nombre_med }}
                                @endif
                            </td>
                            <td><strong>{{ __('Fecha Resultado') }}:</strong></td>
                            <td>{{ $paciente->fecha_update }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        @php
            $resultsArray = $results->toArray();
        @endphp

        <!-- Divide el array $results en dos partes -->
        @php
            $chunks = array_chunk($resultsArray, ceil(count($resultsArray) / 2));
        @endphp
        <div class="row">
            <div class="col-xs-11" style="margin-left: 0px;">
                <table class="table-descripcion">
                    <tbody>
                        <tr>
                            <td class="text-center" colspan="2" style="color: chocolate;"><strong>{{ $estudio->est_nombre }}</strong></td>
                        </tr>
                        <tr style="border: none;">
                            <td style="margin: 0px; padding: 0px; width: auto; border: none;">
                                <table style="border-collapse: collapse; width: 300px; max-width: 800px; margin: auto; font-family: Arial, sans-serif;">
                                    <thead>
                                        <th class="text-center" style="color: orange;">PRUEBA</th>
                                        <th class="text-center" style="color: orange;">VALOR</th>
                                        <th class="text-center" style="color: orange;">REFERENCIA</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($chunks[0] as $result)
                                            <tr>
                                                <td class="text-center" style="color: red;">{{ $result->aspecto }}</td>
                                                <td class="text-center">{{ $result->resultado }}</td>
                                                <td class="text-center" style="color: blue;">{{ $result->referencia }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td style="margin: 0px; padding: 0px; width: auto; border: none;">
                                <table style="border-collapse: collapse; width: 300px; max-width: 800px; margin: auto; font-family: Arial, sans-serif;">
                                    <thead>
                                        <th class="text-center" style="color: orange;">PRUEBA</th>
                                        <th class="text-center" style="color: orange;">VALOR</th>
                                        <th class="text-center" style="color: orange;">REFERENCIA</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($chunks[1] as $result)
                                            <tr>
                                                <td class="text-center" style="color: red;">{{ $result->aspecto }}</td>
                                                <td class="text-center">{{ $result->resultado }}</td>
                                                <td class="text-center" style="color: blue;">{{ $result->referencia }}</td>
                                            </tr>
                                        @endforeach
    
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><br>
        <br>
        <p class="text-center" style="font-family: Arial, sans-serif; font-size: 15px;">Puedes verificar los resultados de tu análisis clínico en nuestro sitio web: {{ $config->web }}</p>
        <p style="margin-left: 150px; font-family: Arial, sans-serif; font-size: 15px">Usuario:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{ $paciente->cli_correo }}</strong></p>
        <p style="margin-left: 150px; font-family: Arial, sans-serif; font-size: 15px">Contraseña:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{ $paciente->cli_password }}</strong></p>
    </body>
</html>