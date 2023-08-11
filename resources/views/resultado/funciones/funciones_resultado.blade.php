<script type="text/javascript">
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
        $('#tabla_resultados tbody').empty().append('<td colspan="7" class="text-center" style="border: 1px solid #BAECCA;">No hay datos recepcionados</td>');
        var hoy = new Date();
        $("#rec_fecha_inicio").val(hoy.toISOString().split('T')[0]);
        $("#rec_fecha_final").val(hoy.toISOString().split('T')[0]);
        $("#rec_fecha_inicio").focus();
        $("#pendiente").prop('checked', true);

        SearchFechas();

        $("#rec_paciente_clave").focus();
        $('#rec_paciente_clave').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '/buscar_paciente_id/?q=' + request.term,
                    dataType: 'json',
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                event.preventDefault();
                $('#rec_paciente_id').val(ui.item.id);
                $('#rec_paciente_clave').val(ui.item.cli_cod);
                $('#rec_paciente_nombre').val(ui.item.cli_nombre+' '+ui.item.cli_apellido_pat+' '+ui.item.cli_apellido_mat);
                return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li class='each'></li>" )
            .data( "item.autocomplete", item )
            .append("<div class='acItem'><span class='name'>"+item.cli_cod+"</span>"+"&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.cli_nombre+"</span><span class='name'>"+"&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.cli_apellido_pat+"</span><span class='name'>"+ "&nbsp;&nbsp;&nbsp;&nbsp;" + item.cli_apellido_mat+"</span></div>")
            .appendTo( ul );
        };
        $('#rec_paciente_nombre').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '/buscar_paciente_nombre/?q=' + request.term,
                    dataType: 'json',
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                event.preventDefault();
                $('#rec_paciente_id').val(ui.item.id);
                $('#rec_paciente_clave').val(ui.item.cli_cod);
                $('#rec_paciente_nombre').val(ui.item.cli_nombre+' '+ui.item.cli_apellido_pat+' '+ui.item.cli_apellido_mat);
                return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li class='each'></li>" )
            .data( "item.autocomplete", item )
            .append("<div class='acItem'><span class='name'>"+item.cli_cod+"</span>"+"&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.cli_nombre+"</span><span class='name'>"+"&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.cli_apellido_pat+"</span><span class='name'>"+ "&nbsp;&nbsp;&nbsp;&nbsp;" + item.cli_apellido_mat+"</span></div>")
            .appendTo( ul );
        };

        $('#rec_estudio_clave').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '/buscar_estudio_id/?q=' + request.term,
                    dataType: 'json',
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                event.preventDefault();
                $('#rec_estudio_id').val(ui.item.id);
                $('#rec_estudio_clave').val(ui.item.est_cod);
                $('#rec_estudio_nombre').val(ui.item.est_nombre);
                return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li class='each'></li>" )
            .data( "item.autocomplete", item )
            .append("<div class='acItem'><span class='name'>"+item.est_cod+"</span>"+"&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.est_nombre+"</span></div>")
            .appendTo( ul );
        };
        $('#rec_estudio_nombre').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '/buscar_estudio_nombre/?q=' + request.term,
                    dataType: 'json',
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                event.preventDefault();
                $('#rec_estudio_id').val(ui.item.id);
                $('#rec_estudio_clave').val(ui.item.est_cod);
                $('#rec_estudio_nombre').val(ui.item.est_nombre);
                return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li class='each'></li>" )
            .data( "item.autocomplete", item )
            .append("<div class='acItem'><span class='name'>"+item.est_cod+"</span>"+"&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.est_nombre+"</span></div>")
            .appendTo( ul );
        };

        function cargarTablaResultado(ruta){
            mostrarCargando();
            $.ajax({
                url: ruta,
                dataType: 'json',
                success: function(data) {
                    if (data.length != 0) {
                        $('#tabla_resultados tbody').empty();
                        $.each(data, function(index, value) {
                            var html = '<tr><td style="border: 1px solid #C6C8CA;">' + value.numero + '</td>'+
                                        '<td style="border: 1px solid #C6C8CA;">' + value.nombre + '</td>'+
                                        '<td style="border: 1px solid #C6C8CA;">' + value.fecha + '</td>'+
                                        '<td style="border: 1px solid #C6C8CA;">' + value.estudio + '</td>'+
                                        '<td style="border: 1px solid #C6C8CA;">' + value.codigo + '</td>'+
                                        '<td style="border: 1px solid #C6C8CA;">' + (value.estado == 'PENDIENTE' ? '<a href="javascript:void(0)" data-toggle="modal" data-target="#confirmPassword" class="badge badge-danger btn-res-pendiente">' + value.estado + '</a>' : '<span class="badge badge-success">' + value.estado + '</span>') + '</td>';
                            if (value.estado == 'PENDIENTE') {
                                html += '<td style="border: 1px solid #C6C8CA;">'+
                                            '<div class="btn-group" role="group" aria-label="Button group">'+
                                                '<a href="javascript:void(0)" data-toggle="modal" data-target="#modal_resultados" class="btn btn-sm btn-outline-warning btn-resultado" title="Editar resultado"><i class="fas fa-edit"></i></a>'+
                                            '</div>'+
                                        '</td>';
                            }else{
                                html += '<td style="border: 1px solid #C6C8CA;">'+
                                            '<div class="btn-group" role="group" aria-label="Button group">'+
                                                '<button data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-outline-info btn-imprimir-resultados" title="Imprimir resultado" target="_blank" rel="noopener noreferrer"><i class="fas fa-print"></i></button>'+
                                                //'<a class="btn btn-sm btn-outline-info btnVerResultado">Ver</a>'+
                                            '</div>'+
                                        '</td>';
                            }
                            html += '</tr>';
                            $('#tabla_resultados tbody').append(html);
                        });
                    }else {
                        $('#tabla_resultados tbody').empty().append('<td colspan="7" class="text-center" style="border: 1px solid #BAECCA;">No hay datos recepcionados</td>');
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
        function SearchPaciente() {
            var pacienteId = $("#rec_paciente_id").val();
            var pacienteNombre = $("#rec_paciente_nombre").val();
            if ($("#pendiente").prop('checked') == true) {
                cargarTablaResultado('/buscar_recepcion_paciente/?q=' + pacienteId + '&r=PENDIENTE');
            }else if ($("#resultado").prop('checked') == true) {
                cargarTablaResultado('/buscar_recepcion_paciente/?q=' + pacienteId + '&r=RESULTADO');
            }else if ($("#todo").prop('checked') == true) {
                cargarTablaResultado('/buscar_recepcion_paciente/?q=' + pacienteId + '&r=TODO');
            }
        }

        function SearchEstudio() {
            var estudioId = $("#rec_estudio_id").val();
            var estudioNombre = $("#rec_estudio_nombre").val();
            if ($("#pendiente").prop('checked') == true) {
                cargarTablaResultado('/buscar_recepcion_estudio/?q=' + estudioId + '&r=PENDIENTE');
            }else if ($("#resultado").prop('checked') == true) {
                cargarTablaResultado('/buscar_recepcion_estudio/?q=' + estudioId + '&r=RESULTADO');
            }else if ($("#todo").prop('checked') == true) {
                cargarTablaResultado('/buscar_recepcion_estudio/?q=' + estudioId + '&r=TODO');
            }
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
                    $("#rec_fecha_inicio").val("");
                    var hoy = new Date();
                    $("#rec_fecha_final").val(hoy.toISOString().split('T')[0]);
                },2000);
            }else if(fechaInicial <= fechaFin){
                if ($("#pendiente").prop('checked') == true) {
                    cargarTablaResultado('/buscar_recepcion_fechas/?q=' + fechaInicial + '&f=' + fechaFin + '&r=PENDIENTE');
                }else if ($("#resultado").prop('checked') == true) {
                    cargarTablaResultado('/buscar_recepcion_fechas/?q=' + fechaInicial + '&f=' + fechaFin + '&r=RESULTADO');
                }else if ($("#todo").prop('checked') == true) {
                    cargarTablaResultado('/buscar_recepcion_fechas/?q=' + fechaInicial + '&f=' + fechaFin + '&r=TODO');
                }
            }
        }

        $("#btnBuscarPaciente").on('click', function() {
            SearchPaciente();
        });

        $("#btnBuscarEstudio").on('click', function() {
            SearchEstudio();
        });

        $("#btnBuscarFechas").on('click', function() {
            SearchFechas();
        });

        $("#btnCloseSaveResult").on('click', function() {
            $('.tabla_procedimientos_resultado tbody tr').find('.chkProcedimiento').prop('checked', false);
            $('.tabla_procedimientos_resultado tbody').empty().append('<td colspan="3" class="text-center">No hay datos recepcionados</td>');
            $('.tabla_componentes_resultado tbody').empty().append('<td colspan="3" class="text-center">No hay datos recepcionados</td>');
            $(".divComponentes").css('display', 'none');
            $(".divAspectos").css('display', 'none');
        });

        function getProcedimientoRes(id) {
            $.ajax({
                url: '{{ route("getProcedimientoEstudio", ":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.length != 0) {
                        $('.tabla_procedimientos_resultado tbody').empty();
                        $.each(data, function(index, value) {
                            $('.tabla_procedimientos_resultado tbody').append(
                                '<tr>'+
                                    '<td hidden>' + value.dp_id + '</td>'+
                                    '<td><button class="btn btn-sm btn-outline-secondary btn-procedimiento-res">' + value.nombre + '</button></td>'+
                                    '<td hidden><input type="checkbox" name="chkProcedimiento" id="chkProcedimiento" class="chkProcedimiento"></td>'+
                                '</tr>'
                            );
                        });
                    }else {
                        $('.tabla_procedimientos_resultado tbody').empty().append('<td colspan="3" class="text-center">No hay datos recepcionados</td>');
                    }
                }
            });
        }

        function getClientResult(id) {
            mostrarCargando();
            $.ajax({
                url: '{{ route("getClienteResult", ":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data[0].estado == 'PENDIENTE') {
                        $(".res_estado").addClass('badge badge-danger').removeClass('badge badge-success');
                        $(".res-link-estado").addClass('btn-change-result-pendiente').removeClass('btn-change-result-success')
                        $(".res_estado").text(data[0].estado);
                    }else{
                        $(".res_estado").addClass('badge badge-success').removeClass('badge badge-danger');
                        $(".res-link-estado").addClass('btn-change-result-success').removeClass('btn-change-result-pendiente');
                        $(".res_estado").text(data[0].estado);
                    }
                    cerrarCargando();
                }  
            });
        }

        $(document).on('click', '.btn-resultado', function() {
            var id = $(this).closest('tr').find('td:eq(0)').text();
            mostrarCargando();
            $.ajax({
                url: '{{ route("getClienteResult", ":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $(".res_fac_id").val(data[0].fac_id)
                    $(".res_rec_id").val(data[0].rec_id);
                    $(".res_cli_id").val(data[0].cli_id);
                    $(".res_cli_nombre").text(data[0].nombre);
                    $(".res_cli_recepcion").text(data[0].fecha);
                    $(".res_cli_edad").text(data[0].edad+' años');
                    $(".res_cli_genero").text(data[0].cli_genero);
                    $(".res_est_nombre").text(data[0].est_nombre);
                    $(".res_det_id").val(data[0].det_id);
                    if (data[0].rec_observacion == null) {
                        $('.res_cli_observacion').val("")
                    }else{
                        $(".res_cli_observacion").val(data[0].rec_observacion);
                    }
                    setTimeout(function(){
                        getProcedimientoRes($(".res_det_id").val());
                        cerrarCargando();
                    }, 500);
                }  
            });
        });

        function getComponenteDp(valor) {
            mostrarCargando();
            $.ajax({
                url: '{{ route("getComponenteDp", ":id") }}'.replace(":id", valor),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length != 0) {
                        $('.tabla_componentes_resultado tbody').empty();
                        $.each(data, function(index, value) {
                            $('.tabla_componentes_resultado tbody').append(
                                '<tr>'+
                                    '<td hidden>' + value.id + '</td>'+
                                    '<td><button class="btn btn-sm btn-outline-secondary btn-componente-res" style="width: 150px; text-align: center">' + value.nombre + '</button></td>'+
                                    '<td hidden><input type="checkbox" name="chkComponente" id="chkComponente" class="chkComponente"></td>'+
                                '</tr>'
                            );
                        });
                        cerrarCargando();
                    }else {
                        $('.tabla_componentes_resultado tbody').empty().append('<td colspan="3" class="text-center">No hay datos recepcionados</td>');
                    }
                }
            });
        }

        $(document).on('click', '.btn-procedimiento-res', function() {
            var dp_id = $(this).closest('tr').find('td:eq(0)').text();

            if ($(".chkProcedimiento").is(':checked')) {
                $(this).addClass('btn-outline-secondary').removeClass('btn-success');
                $(".divComponentes").css('display', 'none');
                $(".btn-componente-res").addClass('btn-outline-secondary').removeClass('btn-warning');
                $(".chkComponente").prop('checked', false);
                $(".divAspectos").css('display', 'none');
                $(".chkProcedimiento").prop('checked', false);
                $('.tabla_componentes_resultado tbody').empty().append('<td colspan="3" class="text-center">No hay datos recepcionados</td>');
            }else{
                getComponenteDp(dp_id);
                $(this).removeClass('btn-outline-secondary').addClass('btn-success');
                $(".divComponentes").css('display', '');
                $(".chkProcedimiento").prop('checked', true);
            }
        });

        function desmarcarOpciones() {
            $('.chkComponente').not(this).prop('checked', false);
        }

        function tablaAspectoParametro(fac_id,rec_id,det_id,dp_id,dpc_id) {
            mostrarCargando();
            $.ajax({
                url: '/getDPCAspectoResult/?f='+fac_id+'&r='+rec_id+'&d='+det_id+'&p='+dp_id+'&c='+dpc_id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length != 0) {
                        $('.tabla_aspectos_resultado tbody').empty();
                        $.each(data, function(index, value) {
                            var umedid = value.umed_id;
                            var optionList = '';
                            @foreach ($unidades as $unidad)
                                var isSelected = {{ $unidad->id }} === umedid ? 'selected' : '' ;
                                optionList += '<option value="{{ $unidad->id }}" '+ isSelected + '>{{ $unidad->unidad }}</option>';
                            @endforeach
                            $('.tabla_aspectos_resultado tbody').append(
                                '<tr>'+
                                    '<td hidden>' + value.id + '</td>'+ //id de results
                                    '<td hidden>' + value.ca_id + '</td>'+ //id de aspectos
                                    '<td width="180px">' + value.nombre + '</td>'+
                                    '<td width="100px"><input type="text" value="' + (value.resultado == null ? '' : value.resultado) + '" class="form-control form-control-sm resultado-final" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly></td>'+
                                    '<td width="100px">'+
                                        '<select class="custom-select custom-select-sm res_aspecto_unidad" name="res_aspecto_unidad" id="res_aspecto_unidad" disabled>'+
                                            '<option value="" >Seleccionar...</option>'+
                                            optionList +
                                        '</select>'+
                                    '</td>'+
                                    '<td class="text-center">' + (value.referencia == null ? '' : value.referencia) + '</td>'+
                                '</tr>'
                            );
                        });
                        cerrarCargando();
                    }else {
                        $('.tabla_aspectos_resultado tbody').empty().append('<td colspan="5" class="text-center">No hay datos recepcionados</td>');
                    }
                }
            });
        }

        $(document).on('click', '.btn-componente-res', function() {
            var checkbox = $(this).closest('tr').find('.chkComponente');
            if (checkbox.is(':checked')) {
                $(this).addClass('btn-outline-secondary').removeClass('btn-warning');
                $(".divAspectos").css('display', 'none');
                checkbox.prop('checked', false);
            }else{
                $(this).removeClass('btn-outline-secondary').addClass('btn-warning');
                $(".divAspectos").css('display', '');
                checkbox.prop('checked', true);
            }
            $('.btn-componente-res').addClass('btn-outline-secondary').removeClass('btn-warning');
            $(this).removeClass('btn-outline-secondary').addClass('btn-warning');
            
            $('.chkComponente').prop('checked', false);
            checkbox.prop('checked', true);

            var thisButton = $(this);
            $('.tabla_componentes_resultado  tbody  tr').each(function() {
                var currentButton = $(this).find('.btn-componente-res');
                if (currentButton.hasClass('btn-warning') && currentButton[0] !== thisButton[0]) {
                currentButton.removeClass('btn-warning').addClass('btn-outline-secondary');
                }
            });
            desmarcarOpciones.call(checkbox.get(0));

            var dpc_id = $(this).closest('tr').find('td:eq(0)').text();
            var nombre = $(this).closest('tr').find('td:eq(1)').text();
            $(".nombre_comp_asp").text('RESULTADOS DE: ' + nombre);
            $(".res_dpc_id").val(dpc_id);
            var fac_id = $(".res_fac_id").val();
            var rec_id = $(".res_rec_id").val();
            var det_id = $(".res_det_id").val();
            var dp_id = $(".tabla_procedimientos_resultado tbody tr").find('td:eq(0)').text();
            var dpc_id = $(this).closest('tr').find('td:eq(0)').text();
            tablaAspectoParametro(fac_id,rec_id,det_id,dp_id,dpc_id);
        });

        function getParametro(id) {
            $.ajax({
                url: '{{ route("getParametro", ":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length != 0) {
                        $('.table_ver_parametro tbody').empty();
                        $.each(data, function(index, value) {
                            $('.table_ver_parametro tbody').append(
                                '<tr>'+
                                    '<td hidden>'+value.id+'</td>'+
                                    '<td>'+
                                        '<select class="custom-select custom-select-sm" disabled>'+
                                            '<option value="" >Genero...</option>'+
                                            '<option value="MASCULINO" ' + (value.genero === 'MASCULINO' ? 'selected' : '') + '>MASCULINO</option>'+
                                            '<option value="FENEMINO" ' + (value.genero === 'FENEMINO' ? 'selected' : '') + '>FENEMINO</option>'+
                                            '<option value="AMBOS" ' + (value.genero === 'AMBOS' ? 'selected' : '') + '>AMBOS</option>'+
                                        '</select>'+
                                    '</td>'+
                                    '<td width="50px"><input type="number" value="' + (value.edad_inicial === null ? '0' : value.edad_inicial ) + '" class="form-control form-control-sm" readonly></td>'+
                                    '<td width="50px"><input type="number" value="' + (value.edad_final === null ? '0' : value.edad_final ) + '" class="form-control form-control-sm" readonly></td>'+
                                    '<td>'+
                                        '<select class="custom-select custom-select-sm" disabled>'+
                                            '<option value="" >Tiempo...</option>'+
                                            '<option value="AÑOS" ' + (value.genero === 'AÑOS' ? 'selected' : '') + '>AÑOS</option>'+
                                            '<option value="MESES" ' + (value.genero === 'MESES' ? 'selected' : '') + '>MESES</option>'+
                                            '<option value="DIAS" ' + (value.genero === 'DIAS' ? 'selected' : '') + '>DIAS</option>'+
                                        '</select>'+
                                    '</td>'+
                                    '<td width="50px"><input type="number" value="' + (value.valor_inicial === null ? '0' : value.valor_inicial ) + '" class="form-control form-control-sm" readonly></td>'+
                                    '<td width="50px"><input type="number" value="' + (value.valor_final === null ? '0' : value.valor_final ) + '"" class="form-control form-control-sm" readonly></td>'+
                                    '<td><input type="text" value="' + value.referencia + '"" class="form-control form-control-sm" readonly></td>'+
                                '</tr>'
                            );
                        });
                    }else {
                        $('.table_ver_parametro tbody').empty().append('<td colspan="8" class="text-center fila_vacia">No hay datos recepcionados</td>');
                    }
                }
            });
        }

        $(document).on('click', '.btn-ver-parametro', function() {
            var ca_id = $(this).closest('tr').find('td:eq(1)').text();
            getParametro(ca_id);
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
                    var fac_id = $(".res_fac_id").val();
                    var rec_id = $(".res_rec_id").val();
                    var det_id = $(".res_det_id").val();
                    var dp_id = $(".tabla_procedimientos_resultado tbody tr").find('td:eq(0)').text();
                    var dpc_id = $(".res_dpc_id").val();
                    tablaAspectoParametro(fac_id,rec_id,det_id,dp_id,dpc_id);
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

        $(document).on('change', '.res_cli_observacion', function() {
            var rec_id = $(".res_rec_id").val();
            var datos = new FormData();
            datos.append('rec_observacion', $(".res_cli_observacion").val());
            mostrarCargando();
            $.ajax({
                url: '{{ route("updateObservacion", ":id") }}'.replace(":id", rec_id),
                type: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $.ajax({
                        url: '{{ route("result.show", ":id") }}'.replace(":id", rec_id),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $(".res_cli_observacion").val(data.rec_observacion);
                        }
                    });
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
        })

        function updateEstadoRecepcion(rec_id, datos) {
            $.ajax({
                url:'{{ route("updateEstadoRecepcion", ":id") }}'.replace(":id", rec_id),
                type:'POST',
                data: datos,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var res_select = $(".buscar_resultado").val();
                    if (res_select == 'paciente') {
                        SearchPaciente();
                    }else if (res_select == 'estudio') {
                        SearchEstudio();
                    }else if (res_select == 'fecha') {
                        SearchFechas();
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

        $('#confirmPassword').on('shown.bs.modal', function () {
            $('#password').trigger('focus');
        });

        $("#btnCloseConfirmPass").on('click', function() {
            $("#form_comfirmar_pass").trigger("reset");
        });

        $('#form_comfirmar_pass').on('submit', function(e) {
            e.preventDefault(); // evita el comportamiento predeterminado del formulario
            Swal.fire({
                title: '¿Esta seguro que los resultados del estudio ya se encuentran registrados?',
                text: 'Si cambia el estado de la recepcion ya NO podra registrar los resultados del estudio.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4CAF50',
                cancelButtonColor: '#D33',
                confirmButtonText: 'Si, Habilitar',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    if ($("#password").val().length >= 8) {
                        $.ajax({
                            type: 'POST',
                            url: $(this).attr('action'),
                            data: $(this).serialize(),
                            success: function(response) {
                                
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Contraseña verificada!!!',
                                        text: 'La contraseña coincide con la registrada',
                                        icon: 'success',
                                        showConfirmButton: false,
                                        //allowOutsideClick: false,
                                        timer: 2000
                                    });
                                    setTimeout(function() {
                                        mostrarCargando();
                                        var rec_id = $('.rec_id').val();
                                        var datos = new FormData();
                                        datos.append('res_estado', 'RESULTADO'); 
                                        updateEstadoRecepcion(rec_id, datos);
                                        
                                    }, 2000);
                                } else {
                                    const maxIntentos = parseInt(response.maxIntentos);
                                    let errorMessage = response.message;
                                    if (maxIntentos < 3) {
                                        errorMessage += ` Te quedan ${3 - maxIntentos} intentos.`;
                                        Swal.fire({
                                            title: 'Oops...!!!',
                                            html: `${errorMessage}`,
                                            icon: 'error',
                                            showConfirmButton: false,
                                            allowOutsideClick: false,
                                            timer: 2000
                                        });
                                        $("#password").focus();
                                        $("#password").val("");
                                    } else {
                                        errorMessage += ` Espere 60 segundos antes de volver a intentarlo.`
                                        let countdown = 60;
                                        const intervalId  = setInterval(() => {
                                            countdown--;
                                            const timerEl = Swal.getHtmlContainer().querySelector('#timer');
                                            if (timerEl) {
                                                timerEl.textContent = countdown;
                                            }
                                            if (countdown <= 0) {
                                                clearInterval(intervalId);
                                                Swal.close();
                                                $("#password").focus();
                                                $("#password").val("");
                                            }
                                        }, 1000); 
                                        // Desactivar los botones de confirmación para prevenir intentos adicionales durante el tiempo de espera
                                        Swal.fire({
                                            title: 'Oops...!!!',
                                            html: `${errorMessage}<br/><span id="timer">60</span> segundos restantes.`,
                                            icon: 'error',
                                            showConfirmButton: false,
                                            allowOutsideClick: false
                                        });
                                        Swal.disableButtons();
                                    }
                                }
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
                    }else{
                        Swal.fire({
                            title: 'Oops...',
                            text: 'La longitud de la contraseña debe ser mínimo de 8 dígitos.',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        $("#password").focus();
                        $("#password").val("");
                    }
                }
            });
        });

        $(document).on('click', '.btn-res-pendiente', function() {
            var rec_id = $(this).closest('tr').find('td:eq(0)').text();
            $(".rec_id").val(rec_id);
        });

        // $(document).on('click', '.btn-res-success', function() {
        //     var rec_id = $(this).closest('tr').find('td:eq(0)').text();
        //     var datos = new FormData();
        //     datos.append('res_estado', 'PENDIENTE');
        //     updateEstadoRecepcion(rec_id, datos);
        // });

        $(document).on('click', '.btnClosePdfGenerate', function() {
            var pdfFrame = document.querySelector('.pdfFrame');
            pdfFrame.src = "";
        });

        function PdfResultado(rec_id) {
            mostrarCargando();
            $.ajax({
                url: '{{ route("getRutaRecepcionCliente", ":id") }}'.replace(":id", rec_id),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.rec_ruta_file !== null) {
                        $(document).on('shown.bs.modal', '.exampleModal', function (event) {
                            var pdfFrame = document.querySelector('.pdfFrame');
                            var checkPDFReadyInterval = setInterval(function() {
                                if (data.rec_ruta_file !== null) {
                                    pdfFrame.src = "{{ asset('storage') }}"+"/"+data.rec_ruta_file;
                                    clearInterval(checkPDFReadyInterval);
                                }
                            }, 100);
                            cerrarCargando();
                        });
                    }else{
                        $.ajax({
                            url: '{{ route("resultado.pdf", ":id") }}'.replace(":id", rec_id),
                            type: 'GET',
                            success: function(response) {
                                var pdfFrame = document.getElementById('pdfFrame');
                                var checkPDFReadyInterval = setInterval(function() {
                                    if (response.rec_ruta_file !== null) {
                                        pdfFrame.src = "{{ asset('storage') }}"+"/"+response.rec_ruta_file;
                                        clearInterval(checkPDFReadyInterval);
                                    }
                                    cerrarCargando();
                                }, 100);
                                //window.open('{{ route("factura.pdf", ":id") }}'.replace(":id", fac_id), '_blank');
                            }
                        });
                    }
                }
            });
        }
        
        $(document).on('click', '.btn-imprimir-resultados', function() {
            var rec_id = $(this).closest('tr').find('td:eq(0)').text();
            $(".exampleModalLabel").text('Resultados');
            PdfResultado(rec_id);
        });
    
        $(document).on('click', '.btnVerResultado', function() {
            var rec_id = $(this).closest('tr').find('td:eq(0)').text();
            window.open('{{ route("resultado.pdf", ":id") }}'.replace(":id", rec_id), '_blank');
        });
    });
</script>