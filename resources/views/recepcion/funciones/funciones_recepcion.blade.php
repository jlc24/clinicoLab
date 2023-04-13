@include('cliente.funciones.funciones_cliente')

@include('medico.funciones.funciones_medico')

<script type="text/javascript">
    $(document).ready(function() {

        $('#rec_medico_clave').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '/buscar_medico_id/?q=' + request.term,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        response(data);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                event.preventDefault();
                $('#rec_medico_id').val(ui.item.id);
                $('#rec_medico_clave').val(ui.item.med_cod);
                $('#rec_medico_nombre').val(ui.item.med_nombre+' '+ui.item.med_apellido_pat+' '+ui.item.med_apellido_mat);
                $('#rec_especialidad').val(ui.item.med_especialidad);
                return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li class='each'></li>" )
            .data( "item.autocomplete", item )
            .append("<div class='acItem'><span class='name'>"+item.med_cod+"</span>"+"&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.med_nombre+"</span><span class='name'>"+"&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.med_apellido_pat+"</span><span class='name'>"+ "&nbsp;&nbsp;&nbsp;&nbsp;" + item.med_apellido_mat+"</span></div>")
            .appendTo( ul );
        };
        $('#rec_medico_nombre').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '/buscar_medico_nombre/?q=' + request.term,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        response(data);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                event.preventDefault();
                $('#rec_medico_id').val(ui.item.id);
                $('#rec_medico_clave').val(ui.item.med_cod);
                $('#rec_medico_nombre').val(ui.item.med_nombre+' '+ui.item.med_apellido_pat+' '+ui.item.med_apellido_mat);
                $('#rec_especialidad').val(ui.item.med_especialidad);
                return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li class='each'></li>" )
            .data( "item.autocomplete", item )
            .append("<div class='acItem'><span class='name'>"+item.med_cod+"</span>"+" "+"<span class='name'>"+item.med_nombre+"</span><span class='name'>"+"&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.med_apellido_pat+"</span><span class='name'>"+ "&nbsp;&nbsp;&nbsp;&nbsp;" + item.med_apellido_mat+"</span></div>")
            .appendTo( ul );
        };

        $('#rec_paciente_clave').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '/buscar_paciente_id/?q=' + request.term,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
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
                $('#rec_genero').val(ui.item.cli_genero);
                $('#rec_edad').val(ui.item.edad+' años');
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
                        console.log(data);
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
                $('#rec_genero').val(ui.item.cli_genero);
                $('#rec_edad').val(ui.item.edad+' años');
                return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li class='each'></li>" )
            .data( "item.autocomplete", item )
            .append("<div class='acItem'><span class='name'>"+item.cli_cod+"</span>"+"&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.cli_nombre+"</span><span class='name'>"+"&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.cli_apellido_pat+"</span><span class='name'>"+ "&nbsp;&nbsp;&nbsp;&nbsp;" + item.cli_apellido_mat+"</span></div>")
            .appendTo( ul );
        };

        $('#rec_empresa_clave').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '/buscar_emp_id/?q=' + request.term,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        response(data);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                event.preventDefault();
                $('#rec_empresa_id').val(ui.item.id);
                $('#rec_empresa_clave').val(ui.item.emp_cod);
                $('#rec_empresa_nombre').val(ui.item.emp_nombre);
                return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li class='each'></li>" )
            .data( "item.autocomplete", item )
            .append("<div class='acItem'><span class='name'>"+item.emp_cod+"</span>"+"&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.emp_nombre+"</span></div>")
            .appendTo( ul );
        };
        $('#rec_empresa_nombre').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '/buscar_emp_nombre/?q=' + request.term,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        response(data);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                event.preventDefault();
                $('#rec_empresa_id').val(ui.item.id);
                $('#rec_empresa_clave').val(ui.item.emp_cod);
                $('#rec_empresa_nombre').val(ui.item.emp_nombre);
                return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li class='each'></li>" )
            .data( "item.autocomplete", item )
            .append("<div class='acItem'><span class='name'>"+item.emp_cod+"</span>"+"&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.emp_nombre+"</span></div>")
            .appendTo( ul );
        };

        $('#rec_est_clave').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '/buscar_estudio_id/?q=' + request.term,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        response(data);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                event.preventDefault();
                $('#rec_est_id').val(ui.item.id);
                $('#rec_est_clave').val(ui.item.est_cod);
                $('#rec_est_nombre').val(ui.item.est_nombre);
                $('#rec_est_precio').val(ui.item.est_precio+" "+ui.item.est_moneda);
                return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li class='each'></li>" )
            .data( "item.autocomplete", item )
            .append("<div class='acItem'><span class='name'>"+item.est_cod+"</span>"+"&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.est_nombre+"</span></div>")
            .appendTo( ul );
        };
        $('#rec_est_nombre').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '/buscar_estudio_nombre/?q=' + request.term,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        response(data);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                event.preventDefault();
                $('#rec_est_id').val(ui.item.id);
                $('#rec_est_clave').val(ui.item.est_cod);
                $('#rec_est_nombre').val(ui.item.est_nombre);
                $('#rec_est_precio').val(ui.item.est_precio+" "+ui.item.est_moneda);
                return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li class='each'></li>" )
            .data( "item.autocomplete", item )
            .append("<div class='acItem'><span class='name'>"+item.est_cod+"</span>"+"&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.est_nombre+"</span></div>")
            .appendTo( ul );
        };

        // $("#buscar_estudio").validate(function(){
        //     rules: {
        //         rec_est_id: {
        //             required: true,
        //             minLength: 1
        //         }
        //     },
        //     messages: {
        //         rec_est_id: {
        //             required: "Este campo es obligatorio",
        //             minLength: "No debe estar vacio"
        //         }
        //     }
        // })
        //----Capturar datos del formulario recepcion
        $('#rec_paciente_id').on('change', function() {
            var id = $(this).val();
            if (id != '') {
                $.ajax({
                    url: '{{ route("tabla_recepcion", ":id") }}'.replace(':id', id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('#tabla-estudios tbody').empty();
                        $.each(data, function(index, value) {
                            $('#tabla-estudios tbody').append(
                                '<tr><td>' + value.est_cod + '</td>'+
                                    '<td>' + value.est_nombre + '</td>'+
                                    '<td>' + value.est_precio + '</td>'+
                                    '<td>' + value.muestra + '</td>'+
                                    '<td>' + value.indicacion + '</td>'+
                                    '<td><a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a></td>'+
                                '</tr>');
                        });
                    }
                });
            } else {
                $('#tabla-estudios tbody').append('<td colspan="7" class="text-center">Detalle no disponible</td>');
            }
        });
        $("#btnAddRecepcion").on('click', function() {
            var datos = new FormData();
            datos.append("det_id", $("#rec_est_id").val());
            datos.append("cli_id", $("#rec_paciente_id").val());
            datos.append("med_id", $("#rec_medico_id").val());
            datos.append("emp_id", $("#rec_empresa_id").val());
            datos.append("estado", $("#rec_estado").val());
            datos.append("observacion", $("#rec_observacion").val());
            datos.append("referencia", $("#rec_referencia").val());
            for (var campo of datos.values()) {
                console.log(campo);
            }
            $.ajax({
                url:"{{ route('recepcion') }}",
                method:"POST",
                data: datos,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            })
            .done(function(response){
                console.log('La solicitud ha sido completada con éxito.');
                Swal.fire({
                    title: 'Registrado',
                    text: 'Registro de Evento Exitoso',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                })
                $("#rec_est_id").val("");
                $("#rec_est_clave").val("");
                $("#rec_est_nombre").val("");
                $("#rec_est_precio").val("");

            })
            .fail(function(xhr, textStatus, errorThrown){
                console.error('Error en la solicitud: ', textStatus, ', detalles: ', errorThrown);
            });
        });

    });
</script>