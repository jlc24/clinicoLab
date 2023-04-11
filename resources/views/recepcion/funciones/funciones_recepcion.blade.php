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
                $('#rec_est_precio').val(ui.item.est_precio);
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
                $('#rec_est_precio').val(ui.item.est_precio);
                return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li class='each'></li>" )
            .data( "item.autocomplete", item )
            .append("<div class='acItem'><span class='name'>"+item.est_cod+"</span>"+"&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.est_nombre+"</span></div>")
            .appendTo( ul );
        };

        //----Capturar datos del formulario recepcion
        $("#btnAddRecepcion").on('click', function() {
            // var datos = new FormData();
            // datos.append("estudio_id", $("#rec_est_id").val());
            // datos.append("cliente_id", $("#rec_paciente_id").val());
            // datos.append("medico_id", $("#rec_medico_id").val());
            // datos.append("empresa_id", $("#rec_empresa_id").val());
            // datos.append("estado", $("#rec_estado").val());
            // datos.append("observacion", $("#rec_observacion").val());
            // datos.append("referencia", $("#rec_referencia").val());
            var data = $("#buscar_estudio").serialize();
            //alert(data); return false;
            $.ajax({
                url:"{{ route('recepcion') }}",
                method:"POST",
                data: data,
                dataType: 'JSON',
                headers: {
                    // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    "_token": "{{ csrf_token() }}"
                },
                success:function(response){
                    console.log(response)
                    if(response){
                        Swal.fire({
                            type: 'success',
                            title: 'Registro de Evento Exitoso',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        //$('#RecepcionTabla').load('tabla_recepcion.php');
                        $('#rec_est_id').val("");
                        $('#rec_est_clave').val("");
                        $('#rec_est_nombre').val("");
                        $('#rec_est_precio').val("");
                    }else{
                        Swal.fire({
                            type: 'error',
                            title: 'Se ha Producido un Error.',
                            showConfirmButton: false,
                            timer: 2000//1500
                        })
                    }
                },
                error:function(xhr, textStatus, errorThrown){
                    console.log(textStatus);
                }
            })
        });

    });
</script>