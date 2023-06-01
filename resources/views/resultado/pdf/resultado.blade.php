<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="{{ $config->nombre }}_{{ $config->nit }}_{{ $paciente->factura }}">
        <meta name="description" content="Resultado de estudio realizado en {{ $config->nombre }}">
        <meta name="keywords" content="Resultado, Estudio, Análisis, Pruebas">
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
                width: 600px;
                max-width: 800px;
                margin: auto;
                font-family: Arial, sans-serif;
                border: 1px solid #000;
            }

            .table-descripcion tbody tr:nth-of-type(odd) {
                background-color: #E9F0FE;
            }

            .table-descripcion tbody tr:nth-of-type(even) {
                background-color: #FFF;
            }

            .table-descripcion th,
            .table-descripcion td {
                padding: 0px;
                font-size: 11px;
                border: 1px solid #000;
            }
            
            .table-descripcion tbody tr td {
                margin: 0px;
                padding: 0px;
            }
        </style>
        <title>RESULTADO DE ESTUDIO</title>
    </head>
    <body>
        <div class="row">
            <div class="col-xl-11" >
                <div class="text-right" style="width: 300px; height: auto; background-color: #fff; padding: 5px; border: 1px solid white; display: inline-block; margin-left: 50px;">
                    @if($config->logo == null)
                        <img src="{{ asset('dist/img/default.png') }}" alt="" width="100px">
                    @else
                        <img src="{{ asset($config->logo) }}" alt="" width="80px" height="80px" style="border-radius: 50%;">
                    @endif
                </div>
                <div style="width: 300px; height: auto; background-color: #fff; padding: 5px; border: 1px solid white; display: inline-block;">
                    <table class="encabezado">
                        <tbody>
                            <tr>
                                <td>{{ $config->nombre }}</td>
                            </tr>
                            <tr>
                                <td>{{ $config->nit }}</td>
                            </tr>
                            <tr>
                                <td>{{ $config->telefono }}</td>
                            </tr>
                            <tr>
                                <td>{{ $config->direccion }}</td>
                            </tr>
                            <tr>
                                <td style="text-transform: uppercase;">{{ $config->departamento }} - {{ $config->pais }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <h3 class="text-center">{{ __('RESULTADO') }}</h3>
        <div class="row">
            <div class="col-xs-11" style="border: 1px solid #b2b3b4; border-radius: 5px; box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3); margin-left: 20px;">
                <table class="custom-table">
                    <tbody>
                        <tr>
                            <td><strong>{{ __('Codigo') }}:</strong></td>
                            <td>{{ $paciente->rec_id }}{{ $paciente->cli_cod }}{{ $paciente->cli_ci_nit }}</td>
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

        <div class="row">
            <div class="col-xs-11" style="margin-left: 0px;">
                @php
                    $resultados = $results->groupBy('componente')->toArray();
                    $chunkSize = ceil(count($resultados) / 2);
                    $chunks = array_chunk($resultados, $chunkSize, true);
                @endphp
                
                @if(count($chunks) > 1)
                    <table class="table-descripcion" style="margin-left: 50px;">
                        <tbody>
                            <tr>
                                <td class="text-center" colspan="2" style="color: chocolate;"><strong>{{ $estudio->est_nombre }}</strong></td>
                            </tr>
                            <tr style="border: none;">
                                <td style="margin: 0px; padding: 0px; width: auto;">
                                    @foreach ($chunks[0] as $componente => $resultados)
                                        <table class="text-center">
                                            <thead class="text-center">
                                                <tr>
                                                    <th colspan="3" style="border-right: none; border-top: none; border-left: none;">&nbsp;&nbsp;&nbsp;{{ $componente }}</th>
                                                </tr>
                                                <tr style="font-size: 15px;">
                                                    <th class="text-center" style="width: 100px; color: orange; border-left: none;">PRUEBA</th>
                                                    <th class="text-center" style="width: 100px; color: orange;">VALOR</th>
                                                    <th class="text-center" style="width: 100px; color: orange; border-right: none;">REFERENCIA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($resultados as $resultado)
                                                    <tr>
                                                        <td style="color: red; border-left: none;">{{ $resultado->aspecto }}</td>
                                                        <td style="font-size: 10px; font-family: 'Times New Roman', Times, serif;"><strong>{{ $resultado->resultado }} {{ $resultado->umed_id }}</strong></td>
                                                        <td style="color: blue; border-right: none;">{{ $resultado->referencia }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endforeach
                                </td>
                                <td style="margin: 0px; padding: 0px; width: auto;">
                                    @foreach ($chunks[1] as $componente => $resultados)
                                        <table class="text-center">
                                            <thead class="text-center">
                                                <tr>
                                                    <th colspan="3" style="border-right: none; border-top: none; border-left: none;">&nbsp;&nbsp;&nbsp;{{ $componente }}</th>
                                                </tr>
                                                <tr style="font-size: 15px;">
                                                    <th class="text-center" style="width: 100px; color: orange; border-left: none;">PRUEBA</th>
                                                    <th class="text-center" style="width: 100px; color: orange;">VALOR</th>
                                                    <th class="text-center" style="width: 100px; color: orange; border-right: none;">REFERENCIA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($resultados as $resultado)
                                                    <tr>
                                                        <td style="color: red; border-left: none;">{{ $resultado->aspecto }}</td>
                                                        <td style="font-size: 10px; font-family: 'Times New Roman', Times, serif;"><strong>{{ $resultado->resultado }} {{ $resultado->umed_id }}</strong></td>
                                                        <td style="color: blue; border-right: none;">{{ $resultado->referencia }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @else
                <!-- Divide el array $results en dos partes -->
                @php
                    $resultsArray = $results->toArray();
                    $chunks = array_chunk($resultsArray, ceil(count($resultsArray) / 2));
                @endphp

                    <table class="table-descripcion" style="width: 600px; margin-left: 50px;">
                        <tbody>
                            <tr>
                                <td class="text-center" colspan="2" style="color: chocolate; border-right: none; border-left: none; border-top: none;"><strong>{{ $estudio->est_nombre }}</strong></td>
                            </tr>
                            <tr style="border: none;">
                                <td style="margin: 0px; padding: 0px; width: auto;">
                                    <table class="text-center">
                                        <thead class="text-center">
                                            <tr style="font-size: 15px;">
                                                <th class="text-center" style="width: 100px; color: orange; border-top: none; border-left: none;">PRUEBA</th>
                                                <th class="text-center" style="width: 100px; color: orange; border-top: none;">VALOR</th>
                                                <th class="text-center" style="width: 100px; color: orange; border-top: none; border-right: none;">REFERENCIA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($chunks[0] as $result)
                                                <tr>
                                                    <td style="color: red; border-left: none;">{{ $result->aspecto }}</td>
                                                    <td style="font-size: 10px; font-family: 'Times New Roman', Times, serif;"><strong>{{ $result->resultado }} {{ $result->umed_id }}</strong></td>
                                                    <td style="color: blue; border-right: none;">{{ $result->referencia }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                <td style="margin: 0px; padding: 0px; width: auto;">
                                    <table class="text-center">
                                        <thead class="text-center">
                                            <tr style="font-size: 15px;">
                                                <th class="text-center" style="width: 100px; color: orange; border-top: none; border-left: none;">PRUEBA</th>
                                                <th class="text-center" style="width: 100px; color: orange; border-top: none;">VALOR</th>
                                                <th class="text-center" style="width: 100px; color: orange; border-top: none; border-right: none;">REFERENCIA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($chunks[1] as $result)
                                                <tr>
                                                    <td style="color: red; border-left: none;">{{ $result->aspecto }}</td>
                                                    <td style="font-size: 10px; font-family: 'Times New Roman', Times, serif;"><strong>{{ $result->resultado }} {{ $result->umed_id }}</strong></td>
                                                    <td style="color: blue; border-right: none;">{{ $result->referencia }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            </div>
        </div><br>
        <br>
        <p class="text-center" style="font-family: Arial, sans-serif; font-size: 15px;">Puedes verificar los resultados de tu análisis clínico en nuestro sitio web: {{ $config->web }}</p>
        <p style="margin-left: 150px; font-family: Arial, sans-serif; font-size: 15px">Usuario:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{ $paciente->cli_correo }}</strong></p>
        <p style="margin-left: 150px; font-family: Arial, sans-serif; font-size: 15px">Contraseña:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{ $paciente->cli_password }}</strong></p>
        <br><br><br><br><br><br><br>
        <p class="text-center">Firma del Medico</p>
    </body>
</html>