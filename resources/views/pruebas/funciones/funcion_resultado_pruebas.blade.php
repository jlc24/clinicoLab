<script>
    function buscarPor() {
        mostrarCargando();
        const select = document.getElementById('buscar_resultado');
        const form1 = document.getElementById('form_buscar_paciente');
        const form2 = document.getElementById('form_buscar_estudio');
        const form3 = document.getElementById('form_buscar_fechas');
        form1.style.display = 'none';
        form2.style.display = 'none';
        form3.style.display = 'none';
        const opcionSeleccionada = select.value;
        if (opcionSeleccionada === 'paciente') {
            $('#tabla_resultados tbody').empty().append('<td colspan="7" class="text-center" style="border: 1px solid #BAECCA;">No hay datos recepcionados</td>');
            $("#rec_paciente_id").val("");
            $("#rec_paciente_nombre").val("");
            $("#rec_paciente_clave").val("");
            form1.style.display = 'block';
            $("#rec_paciente_clave").focus();
            $("#pendiente").prop('checked', true);
        } else if (opcionSeleccionada === 'estudio') {
            $('#tabla_resultados tbody').empty().append('<td colspan="7" class="text-center" style="border: 1px solid #BAECCA;">No hay datos recepcionados</td>');
            $("#rec_estudio_id").val("");
            $("#rec_estudio_clave").val("");
            $("#rec_estudio_nombre").val("");
            form2.style.display = 'block';
            $("#rec_estudio_clave").focus();
            $("#pendiente").prop('checked', true);
        } else if (opcionSeleccionada === 'fecha') {
            $('#tabla_resultados tbody').empty().append('<td colspan="7" class="text-center" style="border: 1px solid #BAECCA;">No hay datos recepcionados</td>');
            $("#rec_fecha_inicio").val("");
            var hoy = new Date();
            $("#rec_fecha_final").val(hoy.toISOString().split('T')[0]);
            form3.style.display = 'block';
            $("#rec_fecha_inicio").focus();
            $("#pendiente").prop('checked', true);
        }
        cerrarCargando();
    }
    function isCheckEstado(element) {
        $(element).prop('checked', true);
    }
    $(document).ready(function() {
        filtroTabla('#searchPruebas', '#tabla_resultados_pruebas');
        $('#tabla_resultados tbody').empty().append('<td colspan="7" class="text-center" style="border: 1px solid #BAECCA;">No hay datos recepcionados</td>');
        var hoy = new Date();
        $("#rec_fecha_inicio").val(hoy.toISOString().split('T')[0]);
        $("#rec_fecha_final").val(hoy.toISOString().split('T')[0]);
        $("#rec_fecha_inicio").focus();
        $("#pendiente").prop('checked', true);

        $(document).on('click', '#btnCloseSaveResultPrueba', function() {
            SearchFechas();
        });

        function cargarTablaResultado(ruta){
            mostrarCargando();
            $.ajax({
                url: ruta,
                dataType: 'json',
                success: function(data) {
                    if (data.length != 0) {
                        $('#tabla_resultados_pruebas tbody').empty();
                        $.each(data, function(index, value) {
                            var html = '<tr><td style="border: 1px solid #C6C8CA;" hidden>' + value.numero + '</td>'+
                                        '<td style="border: 1px solid #C6C8CA;">' + value.prueba + '</td>'+
                                        '<td style="border: 1px solid #C6C8CA;">' + value.estudio + '</td>'+
                                        '<td style="border: 1px solid #C6C8CA;">' + (value.subgrupo == null ? '' : value.subgrupo) + '</td>'+
                                        '<td style="border: 1px solid #C6C8CA;">' + value.grupo + '</td>'+
                                        '<td style="border: 1px solid #C6C8CA;">' + (value.estado == 'PENDIENTE' ? '<span class="badge badge-danger btn-res-pendiente">' + value.estado + '</span>' : '<span class="badge badge-success">' + value.estado + '</span>') + '</td>';
                            if (value.estado == 'PENDIENTE') {
                                html += '<td style="border: 1px solid #C6C8CA;">'+
                                            '<div class="btn-group" role="group" aria-label="Button group">'+
                                                '<button data-toggle="modal" data-target="#modal_resultados_prueba" class="btn btn-sm btn-outline-warning btn-resultado-prueba" title="Editar resultado"><i class="fas fa-edit"></i></button>'+
                                            '</div>'+
                                        '</td>';
                            }else{
                                html += '<td style="border: 1px solid #C6C8CA;">'+
                                            '<div class="btn-group" role="group" aria-label="Button group">'+
                                                '<button data-toggle="modal" data-target="#modal_resultados_pruebas" class="btn btn-sm btn-outline-info btn-ver-resultados" title="Ver resultado" target="_blank" rel="noopener noreferrer"><i class="fas fa-eye"></i></button>'+
                                            '</div>'+
                                        '</td>';
                            }
                            html += '</tr>';
                            $('#tabla_resultados_pruebas tbody').append(html);
                        });
                    }else {
                        $('#tabla_resultados_pruebas tbody').empty().append('<td colspan="7" class="text-center" style="border: 1px solid #BAECCA;">No hay datos recepcionados</td>');
                    }
                    cerrarCargando();
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error('Error en la solicitud: ', textStatus, ', detalles: ', errorThrown);
                    Swal.fire({
                        title: 'Oops...',
                        text: 'Error en la solicitud: '+ textStatus+ ', detalles: '+ errorThrown,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });   
        }
        function SearchFechas() {
            var fechaInicial = $("#rec_fecha_inicio").val();
            var fechaFin = $("#rec_fecha_final").val();
            if (fechaInicial == "" || fechaInicial > fechaFin) {
                Swal.fire({
                    title: 'Fecha incorrecta',
                    text: 'debes ingresar un fecha inicial valida anterior a fecha final.',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000,
                })
                setTimeout(function() {
                    var hoy = new Date();
                    $("#rec_fecha_inicio").val(hoy.toISOString().split('T')[0]);
                    $("#rec_fecha_final").val(hoy.toISOString().split('T')[0]);
                },2000);
            }else if(fechaInicial <= fechaFin){
                if ($("#pendiente").prop('checked') == true) {
                    cargarTablaResultado('/getResultsPruebas/?q=' + fechaInicial + '&f=' + fechaFin + '&r=0');
                }else if ($("#resultado").prop('checked') == true) {
                    cargarTablaResultado('/getResultsPruebas/?q=' + fechaInicial + '&f=' + fechaFin + '&r=1');
                }else if ($("#todo").prop('checked') == true) {
                    cargarTablaResultado('/getResultsPruebas/?q=' + fechaInicial + '&f=' + fechaFin + '&r=TODO');
                }
            }
        }
        
        SearchFechas();

        $(document).on('change', '#rec_fecha_inicio', function() {
            SearchFechas();
        });

        $(document).on('change', '#rec_fecha_final', function() {
            SearchFechas();
        });

        $(document).on('click', '.btn-estado-pendiente', function() {
            SearchFechas();
        });

        $(document).on('click', '.btn-estado-resultado', function() {
            SearchFechas();
        });

        $(document).on('click', '.btn-estado-todos', function() {
            SearchFechas();
        });

        function getPrueba(id) {
            $.ajax({
                url: '{{ route("getPrueba", ":id") }}'.replace(":id", id),
                type:'GET',
                dataType : 'json',
                success:function (data) {
                    $('.res_estudio').text(data[0].estudio);
                    $(".res_grupo").text(data[0].grupo);
                    if (data[0].subgrupo !== null) {
                        $(".res_subgrupo").prop('hidden', false);
                        $(".res_subgrupo").text(data[0].subgrupo);
                    }
                }
            });
        }

        function getPruebaPacientes(id) {
            mostrarCargando();
            $.ajax({
                url: '{{ route("getPruebaPacientes", ":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success:function (data) {
                    if (data.length != 0) {
                        $('.tabla_pacientes_resultado tbody').empty();
                        $.each(data, function(index, value) {
                            var umedid = value.umed_id;
                            var optionList = '';
                            @foreach ($unidades as $unidad)
                                var isSelected = {{ $unidad->id }} === umedid ? 'selected' : '' ;
                                optionList += '<option value="{{ $unidad->id }}" '+ isSelected + '>{{ $unidad->unidad }}</option>';
                            @endforeach
                            $('.tabla_pacientes_resultado tbody').append(
                                '<tr>'+
                                    '<td hidden>' + value.id + '</td>'+ //id de results
                                    '<td width="30px"></td>'+ //id de results
                                    '<td width="150px">' + value.cli_cod + '</td>'+ //
                                    '<td width="100px"><input type="text" value="' + (value.resultado == null ? '' : value.resultado) + '" class="form-control form-control-sm resultado-final" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>'+
                                    '<td width="100px">'+
                                        '<select class="custom-select custom-select-sm res_aspecto_unidad" name="res_aspecto_unidad" id="res_aspecto_unidad">'+
                                            '<option value="" >Seleccionar...</option>'+
                                            optionList +
                                        '</select>'+
                                    '</td>'+
                                    '<td class="text-center">'+
                                        '<div class="form-group clearfix">'+
                                            '<div class="icheck-success d-inline">'+
                                                '<input type="checkbox" id="checkboxSuccess2" ' + (value.estado == 1 ? 'checked' : '') + ' disabled >'+
                                                '<label for="checkboxSuccess2">'+
                                                '</label>'+
                                            '</div>'+
                                        '</div>'+
                                    '</td>'+
                                '</tr>'
                            );
                        });
                        cerrarCargando();
                    }else {
                        $('.tabla_pacientes_resultado tbody').empty().append('<td colspan="5" class="text-center">No hay datos recepcionados</td>');
                    }
                }
            });
        }

        function getParametro(id) {
            $.ajax({
                url: '{{ route("getParametro", ":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success:function (data) {
                    $(".nombre_referencia").text(data[0].referencia);
                }
            });
        }

        $(document).on('click', '.btn-resultado-prueba', function() {
            var ca_id = $(this).closest('tr').find('td:eq(0)').text();
            $(".res_ca_id").val(ca_id);
            var prueba = $(this).closest('tr').find('td:eq(1)').text();
            $(".nombrePrueba").text(' '+prueba);
            getPrueba(ca_id);
            getParametro(ca_id);
            getPruebaPacientes(ca_id);
        });
        
        function upResults(id, datos) {
            mostrarCargando();
            $.ajax({
                url: '{{ route("result.update", ":id") }}'.replace(":id", id),
                type: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var ca_id = $(".res_ca_id").val();
                    getPruebaPacientes(ca_id);
                    cerrarCargando();
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error('Error en la solicitud: ', textStatus, ', detalles: ', errorThrown);
                    Swal.fire({
                        title: 'Oops...',
                        text: 'Error en la solicitud: '+ textStatus+ ', detalles: '+ errorThrown,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        }

        $(document).on('change', '.resultado-final', function() {
            var id = $(this).closest('tr').find('td:eq(0)').text();
            var resultado = $(this).closest('tr').find("td:eq(3) input").val();
            var umed = $(this).closest('tr').find('td:eq(4) select').val();
            var datos = new FormData();
            datos.append('resultado', resultado);
            datos.append('umed_id', umed);
            upResults(id, datos);
        });

        $(document).on('change', '.res_aspecto_unidad', function() {
            var id = $(this).closest('tr').find('td:eq(0)').text();
            var resultado = $(this).closest('tr').find("td:eq(3) input").val();
            var umed = $(this).closest('tr').find('td:eq(4) select').val();
            var datos = new FormData();
            datos.append('resultado', resultado);
            datos.append('umed_id', umed);
            upResults(id, datos);
        });

    });
</script>