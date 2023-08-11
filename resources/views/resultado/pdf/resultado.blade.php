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
                font-size: 13px;
                align-items: flex-start;
                align-content: flex-start;
            }

            .custom-table {
                border-collapse: collapse;
                width: 100%;
                max-width: 800px;
                margin: auto;
                font-family: Arial, sans-serif;
                padding: 10px 0 0 10px;
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
                background-color: #fff;
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
        <title>RESULTADO DE ESTUDIO</title>
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
        <div class="row" style="border: 1px solid #000; border-radius: 10px;" >
            <div class="marca-de-agua">
                <img src="{{ asset($config->logo) }}" alt="Marca de Agua">
            </div>
            <table class="custom-table">
                <tbody>
                    <tr>
                        <td style="color: #2c90e2"><strong>{{ __('Paciente') }}:</strong></td>
                        <td>{{ $paciente->nombre }}</td>
                        <td style="color: #2c90e2"><strong>{{ __('Edad') }}:</strong></td>
                        <td>{{ $paciente->edad }} {{ $paciente->cli_tiempo }}</td>
                        
                        <td rowspan="4">
                            @if($paciente->cli_qr != null)
                                <img src="{{ asset('storage/'.$paciente->cli_qr) }}" alt="" width="80px">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #2c90e2"><strong>{{ __('Género') }}:</strong></td>
                        <td>{{ $paciente->cli_genero }}</td>
                        <td style="color: #2c90e2"><strong>{{ __('Codigo Paciente') }}:</strong></td>
                        <td>{{ $paciente->rec_codigo }}</td>
                        
                        
                    </tr>
                    <tr>
                        <td style="color: #2c90e2"><strong>{{ __('Institución') }}:</strong></td>
                        <td>{{ $config->nombre }}</td>
                        <td style="color: #2c90e2"><strong>{{ __('Solicitud') }}:</strong></td>
                        <td>CL{{ $paciente->rec_id }}{{ $paciente->cli_ci_nit }}</td>
                        
                    </tr>
                    <tr>
                        <td style="color: #2c90e2"><strong>{{ __('Medico') }}:</strong></td>
                        <td>@if($paciente->nombre_med !== null)
                            {{ $paciente->nombre_med }}
                            @endif
                        </td>
                        <td style="color: #2c90e2"><strong>{{ __('Muestra') }}:</strong></td>
                        <td>{{ $paciente->muestra }}</td>
                    </tr>
                </tbody>
            </table><br>
            <h4 class="text-center" style="color: #2c90e2">{{ __('ANALISIS SOLICITADO') }}</h4>
            <div class="col-xs-11" style="margin-left: 0px;">
                @php
                    $resultados = $results->groupBy('componente')->toArray();

                    $chunkSize = ceil(count($resultados) / 2);
                    $chunks = array_chunk($resultados, $chunkSize, true);
                @endphp
                {{-- {{ dd($resultados) }} --}}
                @if(count($chunks) > 1)
                    <table class="table-descripcion" style="margin-left: 50px;">
                        <tbody>
                            <tr>
                                <td class="text-center" colspan="2" style="color: #2c90e2;"><strong>{{ $estudio->est_nombre }}</strong></td>
                            </tr>
                            <tr style="border: none;">
                                <td style="margin: 0px; padding: 0px; width: auto;">
                                    @foreach ($chunks[0] as $componente => $resultados)
                                        <table class="text-center">
                                            <thead class="text-center">
                                                <tr>
                                                    <th colspan="3" style="border-right: none; border-top: none; border-left: none; color: #2c90e2;">&nbsp;&nbsp;&nbsp;{{ $componente }}</th>
                                                </tr>
                                                <tr style="font-size: 15px;">
                                                    <th class="text-center" style="width: 100px; color: #2c90e2; border-left: none;">PRUEBA</th>
                                                    <th class="text-center" style="width: 100px; color: #2c90e2;">VALOR</th>
                                                    <th class="text-center" style="width: 100px; color: #2c90e2; border-right: none;">REFERENCIA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($resultados as $resultado)
                                                    <tr>
                                                        <td style="border-left: none;">{{ $resultado->aspecto }}</td>
                                                        {{-- <td style="font-size: 10px;"><strong>{{ $resultado->resultado }} {{ $resultado->unidad }}</strong></td> --}}
                                                        <td style="font-size: 10px;">
                                                            @if ($resultado->valor_inicial === null)
                                                                @php
                                                                    $resultadoReferencia = strtoupper(trim($resultado->referencia));
                                                                    $resultadoResultado = strtoupper(trim($resultado->resultado));
                                                                    $isInReferencia = in_array($resultadoResultado, explode(' ', $resultadoReferencia));
                                                                @endphp
                                                                <strong style="color: {{ $isInReferencia ? 'black' : 'red' }}">
                                                                    {{ $resultado->resultado }} {{ $resultado->unidad }}
                                                                </strong>
                                                            @else
                                                                @php
                                                                    $valorInicial = (float) $resultado->valor_inicial;
                                                                    $valorFinal = (float) $resultado->valor_final;
                                                                    $resultadoNumero = (float) $resultado->resultado;
                                                                    $isInRange = $resultadoNumero >= $valorInicial && $resultadoNumero <= $valorFinal;
                                                                @endphp
                                                                <strong style="color: {{ $isInRange ? 'black' : 'red' }}">
                                                                    {{ $resultado->resultado }} {{ $resultado->unidad }}
                                                                </strong>
                                                            @endif
                                                        </td>
                                                        <td style="border-right: none;">{{ $resultado->referencia }}</td>
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
                                                    <th colspan="3" style="border-right: none; border-top: none; border-left: none; color: #2c90e2">&nbsp;&nbsp;&nbsp;{{ $componente }}</th>
                                                </tr>
                                                <tr style="font-size: 15px;">
                                                    <th class="text-center" style="width: 100px; color: #2c90e2; border-left: none;">PRUEBA</th>
                                                    <th class="text-center" style="width: 100px; color: #2c90e2;">VALOR</th>
                                                    <th class="text-center" style="width: 100px; color: #2c90e2; border-right: none;">REFERENCIA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($resultados as $resultado)
                                                    <tr>
                                                        <td style="border-left: none;">{{ $resultado->aspecto }}</td>
                                                        {{-- <td style="font-size: 10px; "><strong>{{ $resultado->resultado }} {{ $resultado->unidad }}</strong></td> --}}
                                                        <td style="font-size: 10px;">
                                                            @if ($resultado->valor_inicial === null)
                                                                @php
                                                                    $resultadoReferencia = strtoupper(trim($resultado->referencia));
                                                                    $resultadoResultado = strtoupper(trim($resultado->resultado));
                                                                    $isInReferencia = in_array($resultadoResultado, explode(' ', $resultadoReferencia));
                                                                @endphp
                                                                <strong style="color: {{ $isInReferencia ? 'black' : 'red' }}">
                                                                    {{ $resultado->resultado }} {{ $resultado->unidad }}
                                                                </strong>
                                                            @else
                                                                @php
                                                                    $valorInicial = (float) $resultado->valor_inicial;
                                                                    $valorFinal = (float) $resultado->valor_final;
                                                                    $resultadoNumero = (float) $resultado->resultado;
                                                                    $isInRange = $resultadoNumero >= $valorInicial && $resultadoNumero <= $valorFinal;
                                                                @endphp
                                                                <strong style="color: {{ $isInRange ? 'black' : 'red' }}">
                                                                    {{ $resultado->resultado }} {{ $resultado->unidad }}
                                                                </strong>
                                                            @endif
                                                        </td>
                                                        <td style="border-right: none;">{{ $resultado->referencia }}</td>
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
                    $mostrarTablaResumida = count($resultsArray) > 10;
                @endphp
                
                    @if($mostrarTablaResumida)
                        @php
                            $chunks = array_chunk($resultsArray, ceil(count($resultsArray) / 2));
                        @endphp
                        <table class="table-descripcion" style="width: 600px; margin-left: 50px;">
                            <tbody>
                                <tr>
                                    <td class="text-center" colspan="2" style="color: #2c90e2; border-right: none; border-left: none; border-top: none;"><strong>{{ $estudio->est_nombre }}</strong></td>
                                </tr>
                                <tr style="border: none;">
                                    <td style="margin: 0px; padding: 0px; width: auto;">
                                        <table class="text-center">
                                            <thead class="text-center">
                                                <tr style="font-size: 15px;">
                                                    <th class="text-center" style="width: 100px; color: #2c90e2; border-top: none; border-left: none;">PRUEBA</th>
                                                    <th class="text-center" style="width: 100px; color: #2c90e2; border-top: none;">VALOR</th>
                                                    <th class="text-center" style="width: 100px; color: #2c90e2; border-top: none; border-right: none;">REFERENCIA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($chunks[0] as $resultado)
                                                    <tr>
                                                        <td style="border-left: none;">{{ $resultado->aspecto }}</td>
                                                        {{-- <td style="font-size: 10px;"><strong>{{ $result->resultado }} {{ $result->unidad }}</strong></td> --}}
                                                        <td style="font-size: 10px;">
                                                            @if ($resultado->valor_inicial === null)
                                                                @php
                                                                    $resultadoReferencia = strtoupper(trim($resultado->referencia));
                                                                    $resultadoResultado = strtoupper(trim($resultado->resultado));
                                                                    $isInReferencia = in_array($resultadoResultado, explode(' ', $resultadoReferencia));
                                                                @endphp
                                                                <strong style="color: {{ $isInReferencia ? 'black' : 'red' }}">
                                                                    {{ $resultado->resultado }} {{ $resultado->unidad }}
                                                                </strong>
                                                            @else
                                                                @php
                                                                    $valorInicial = (float) $resultado->valor_inicial;
                                                                    $valorFinal = (float) $resultado->valor_final;
                                                                    $resultadoNumero = (float) $resultado->resultado;
                                                                    $isInRange = $resultadoNumero >= $valorInicial && $resultadoNumero <= $valorFinal;
                                                                @endphp
                                                                <strong style="color: {{ $isInRange ? 'black' : 'red' }}">
                                                                    {{ $resultado->resultado }} {{ $resultado->unidad }}
                                                                </strong>
                                                            @endif
                                                        </td>
                                                        <td style="border-right: none;">{{ $resultado->referencia }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                    <td style="margin: 0px; padding: 0px; width: auto;">
                                        <table class="text-center">
                                            <thead class="text-center">
                                                <tr style="font-size: 15px;">
                                                    <th class="text-center" style="width: 100px; color: #2c90e2; border-top: none; border-left: none;">PRUEBA</th>
                                                    <th class="text-center" style="width: 100px; color: #2c90e2; border-top: none;">VALOR</th>
                                                    <th class="text-center" style="width: 100px; color: #2c90e2; border-top: none; border-right: none;">REFERENCIA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($chunks[1] as $resultado)
                                                    <tr>
                                                        <td style="border-left: none;">{{ $resultado->aspecto }}</td>
                                                        {{-- <td style="font-size: 10px;"><strong>{{ $result->resultado }} {{ $result->unidad }}</strong></td> --}}
                                                        <td style="font-size: 10px;">
                                                            @if ($resultado->valor_inicial === null)
                                                                @php
                                                                    $resultadoReferencia = strtoupper(trim($resultado->referencia));
                                                                    $resultadoResultado = strtoupper(trim($resultado->resultado));
                                                                    $isInReferencia = in_array($resultadoResultado, explode(' ', $resultadoReferencia));
                                                                @endphp
                                                                <strong style="color: {{ $isInReferencia ? 'black' : 'red' }}">
                                                                    {{ $resultado->resultado }} {{ $resultado->unidad }}
                                                                </strong>
                                                            @else
                                                                @php
                                                                    $valorInicial = (float) $resultado->valor_inicial;
                                                                    $valorFinal = (float) $resultado->valor_final;
                                                                    $resultadoNumero = (float) $resultado->resultado;
                                                                    $isInRange = $resultadoNumero >= $valorInicial && $resultadoNumero <= $valorFinal;
                                                                @endphp
                                                                <strong style="color: {{ $isInRange ? 'black' : 'red' }}">
                                                                    {{ $resultado->resultado }} {{ $resultado->unidad }}
                                                                </strong>
                                                            @endif
                                                        </td>
                                                        <td style="border-right: none;">{{ $resultado->referencia }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        @php
                            $chunks = array_chunk($resultsArray, ceil(count($resultsArray)));
                        @endphp
                        <table class="table-descripcion" style="width: 690px; margin-left: 10px;">
                            <tbody>
                                <tr>
                                    <td class="text-center" style="color: #2c90e2; font-size: 15px; padding-left: 5px;"><strong>{{ $estudio->est_nombre }}</strong></td>
                                </tr>
                                <tr style="border: none;">
                                    <td style="margin: 0px; padding: 0px; width: 100%;">
                                        <table class="text-center" style="width: 100%">
                                            <thead class="text-center">
                                                <tr style="font-size: 25px;">
                                                    <th class="text-center" style="width: 30%; color: #2c90e2; border-top: none; border-left: none; font-size: 15px;">PRUEBA</th>
                                                    <th class="text-center" style="width: 30%; color: #2c90e2; border-top: none; font-size: 15px;">RESULTADO</th>
                                                    <th class="text-center" style="width: 40%; color: #2c90e2; border-top: none; font-size: 15px;">REFERENCIA</th>
                                                    <th class="text-center" style="width: 40%; color: #2c90e2; border-top: none; font-size: 15px;">METODO</th>
                                                    <th class="text-center" style="width: 40%; color: #2c90e2; border-top: none; border-right: none; font-size: 15px;">MUESTRA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($chunks[0] as $resultado)
                                                    <tr>
                                                        <td style="font-size: 13px; border-left: none; border-bottom: none;">{{ $resultado->aspecto }}</td>
                                                        {{-- <td style="font-size: 13px; border-bottom: none;"><strong>{{ $result->resultado }} {{ $result->unidad }}</strong></td> --}}
                                                        <td style="font-size: 13px; border-bottom: none;">
                                                            @if ($resultado->valor_inicial === null)
                                                                @php
                                                                    $resultadoReferencia = strtoupper(trim($resultado->referencia));
                                                                    $resultadoResultado = strtoupper(trim($resultado->resultado));
                                                                    $isInReferencia = in_array($resultadoResultado, explode(' ', $resultadoReferencia));
                                                                @endphp
                                                                <strong style="color: {{ $isInReferencia ? 'black' : 'red' }}">
                                                                    {{ $resultado->resultado }} {{ $resultado->unidad }}
                                                                </strong>
                                                            @else
                                                                @php
                                                                    $valorInicial = (float) $resultado->valor_inicial;
                                                                    $valorFinal = (float) $resultado->valor_final;
                                                                    $resultadoNumero = (float) $resultado->resultado;
                                                                    $isInRange = $resultadoNumero >= $valorInicial && $resultadoNumero <= $valorFinal;
                                                                @endphp
                                                                <strong style="color: {{ $isInRange ? 'black' : 'red' }}">
                                                                    {{ $resultado->resultado }} {{ $resultado->unidad }}
                                                                </strong>
                                                            @endif
                                                        </td>
                                                        <td style="font-size: 13px; border-bottom: none;">{{ $resultado->referencia }}</td>
                                                        <td style="border-bottom: none;">{{ $resultado->procedimiento }}</td>
                                                        <td style="border-right: none; border-bottom: none;">{{ $paciente->muestra }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                @endif
            </div>
            <div class="row">
                
            </div>
            <table class="custom-table" style="padding-bottom: 10px;">
                <tbody><br>
                    <tr>
                        <td style="color: #2c90e2; width: 20%;"><strong>{{ __('Observaciones') }}:</strong></td>
                        <td colspan="2" rowspan="2" style="vertical-align: top;">{{ $paciente->rec_observacion }}</td>
                    </tr>
                    <tr>
                        <td style="color: #2c90e2"></td>
                    </tr>
                    <tr>
                        <td style="color: #2c90e2"><strong>{{ __('Fecha Muestra') }}:</strong></td>
                        <td>{{ $paciente->fecha }} {{ $paciente->hora }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="color: #2c90e2"><strong>{{ __('Fecha Entrega') }}:</strong></td>
                        <td>{{ $paciente->fecha_update }} {{ $paciente->hora_update }}</td>
                        <td></td>
                    </tr>
                    <br><br><br><br>
                    <br><br><br><br>
                    <tr>
                        <td colspan="3" style="text-align: center">{{ Auth::user()->usuario->usuario_nombre }} {{ Auth::user()->usuario->usuario_apellido_pat }} {{ Auth::user()->usuario->usuario_apellido_mat }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: center">{{ __('Responsable Análisis') }}</td>
                    </tr>
                    <br><br>
                    <tr>
                        <td colspan="3"><p><strong>NOTA: </strong>EL DOCUMENTO REFLEJA LOS RESULTADOS DE ANÁLISIS CLINICOS DEL PACIENTE. EL USO ILÍCITO DE ÉSTA SERÁ SANCIONADA DE ACUERDO A LA LEY, PARA SU VALIDACIÓN ESCANEAR CÓDIGO QR O DIRIGIRSE AL SITIO WEB.</p></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>