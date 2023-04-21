<script type="text/javascript">
    function buscarPor() {
        const select = document.getElementById('buscar_resultado');
        const form1 = document.getElementById('form_buscar_paciente');
        const form2 = document.getElementById('form_buscar_estudio');
        const form3 = document.getElementById('form_buscar_fechas');
        // Ocultamos todos los formularios
        form1.style.display = 'none';
        form2.style.display = 'none';
        form3.style.display = 'none';

        // Mostramos el formulario correspondiente a la opción seleccionada
        const opcionSeleccionada = select.value;
        if (opcionSeleccionada === 'paciente') {
            $('#tabla_resultados tbody').empty().append('<td colspan="7" class="text-center" style="border: 1px solid #BAECCA;">No hay datos recepcionados</td>');
            $("#rec_paciente_id").val("");
            $("#rec_paciente_nombre").val("");
            $("#rec_paciente_clave").val("");
            form1.style.display = 'block';
            $("#rec_paciente_clave").focus();
        } else if (opcionSeleccionada === 'estudio') {
            $('#tabla_resultados tbody').empty().append('<td colspan="7" class="text-center" style="border: 1px solid #BAECCA;">No hay datos recepcionados</td>');
            $("#rec_estudio_id").val("");
            $("#rec_estudio_clave").val("");
            $("#rec_estudio_nombre").val("");
            form2.style.display = 'block';
            $("#rec_estudio_clave").focus();
        } else if (opcionSeleccionada === 'fecha') {
            $('#tabla_resultados tbody').empty().append('<td colspan="7" class="text-center" style="border: 1px solid #BAECCA;">No hay datos recepcionados</td>');
            $("#rec_fecha_inicio").val("");
            var hoy = new Date();
            $("#rec_fecha_final").val(hoy.toISOString().split('T')[0]);
            form3.style.display = 'block';
            $("#rec_fecha_inicio").focus();
        }
    }
    $(document).ready(function() {
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

        function cargarTablaResultado(data){
            if (data.length != 0) {
                $('#tabla_resultados tbody').empty();
                $.each(data, function(index, value) {
                    var html = '<tr><td style="border: 1px solid #C6C8CA;">' + value.numero + '</td>'+
                                '<td style="border: 1px solid #C6C8CA;">' + value.nombre + '</td>'+
                                '<td style="border: 1px solid #C6C8CA;">' + value.fecha + '</td>'+
                                '<td style="border: 1px solid #C6C8CA;">' + value.estudio + '</td>'+
                                '<td style="border: 1px solid #C6C8CA;">' + value.codigo + '</td>'+
                                '<td style="border: 1px solid #C6C8CA;"><a href="#" class="badge badge-danger">' + value.estado + '</a></td>';
                    if (value.estado == 'Pendiente' || value.estado == 'Resultado') {
                        html += '<td style="border: 1px solid #C6C8CA;">'+
                                    '<div class="btn-group" role="group" aria-label="Button group">'+
                                        '<a href="#" class="btn btn-sm btn-warning" title="Editar resultado"><i class="fas fa-edit"></i></a>'+
                                    '</div>'+
                                '</td>';
                    }else{
                        html += '<td style="border: 1px solid #C6C8CA;">'+
                                    '<div class="btn-group" role="group" aria-label="Button group">'+
                                        '<a href="#" class="btn btn-sm btn-info" title="Imprimir resultado"><i class="fas fa-print"></i></a>'+
                                    '</div>'+
                                '</td>';
                    }
                    html += '</tr>';
                    $('#tabla_resultados tbody').append(html);
                });
            }else {
                $('#tabla_resultados tbody').empty().append('<td colspan="7" class="text-center" style="border: 1px solid #BAECCA;">No hay datos recepcionados</td>');
            }
                
        }

        $("#btnBuscarPaciente").on('click', function() {
            var pacienteId = $("#rec_paciente_id").val();
            var pacienteNombre = $("#rec_paciente_nombre").val();
            $.ajax({
                url: '/buscar_recepcion_paciente/?q=' + pacienteId,
                dataType: 'json',
                success: function(data) {
                    Swal.fire({
                        title: 'Espere...',
                        text: 'Obteniendo datos de ' + pacienteNombre,
                        icon: 'info',
                        showConfirmButton: false,
                        timer: 2000,
                    })
                    setTimeout(function(){
                        Swal.fire({
                            title: '¡Éxito!',
                            text: 'Datos cargados',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        cargarTablaResultado(data);
                    }, 2000);
                }
            });
        });
        $("#btnBuscarEstudio").on('click', function() {
            var estudioId = $("#rec_estudio_id").val();
            var estudioNombre = $("#rec_estudio_nombre").val();
            $.ajax({
                url: '/buscar_recepcion_estudio/?q=' + estudioId,
                dataType: 'json',
                success: function(data) {
                    Swal.fire({
                        title: 'Espere...',
                        text: 'Obteniendo datos de ' + estudioNombre,
                        icon: 'info',
                        showConfirmButton: false,
                        timer: 2000,
                    })
                    setTimeout(function(){
                        Swal.fire({
                            title: '¡Éxito!',
                            text: 'Datos cargados',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        cargarTablaResultado(data);
                    }, 2000);
                }
            });
        });
        $("#btnBuscarFechas").on('click', function() {
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
                $.ajax({
                    url: '/buscar_recepcion_fechas/?q=' + fechaInicial + '&f=' + fechaFin,
                    dataType: 'json',
                    success: function(data) {
                        Swal.fire({
                            title: 'Espere...',
                            text: 'Obteniendo datos de fecha ' + fechaInicial + ' a ' + fechaFin,
                            icon: 'info',
                            showConfirmButton: false,
                            timer: 3000,
                        })
                        setTimeout(function(){
                            Swal.fire({
                                title: '¡Éxito!',
                                text: 'Datos cargados',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            cargarTablaResultado(data);
                        }, 2000);
                    }
                });
            }
        });
    })
    
</script>