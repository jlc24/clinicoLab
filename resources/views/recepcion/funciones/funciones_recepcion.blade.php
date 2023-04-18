@include('cliente.funciones.funciones_cliente')

@include('medico.funciones.funciones_medico')

@include('empresa.funciones.funciones_empresa')

<script type="text/javascript">
    
    $(document).ready(function() {
        function EstadoFactura() {
            $.ajax({
                url: '/validarFactura',
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    //console.log(response);
                    if (response.id == undefined) {
                        $.ajax({
                            url:"{{ route('factura') }}",
                            method:"POST",
                            data: fac_estado,
                            contentType: false,
                            processData: false,
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            success: function(response) {
                                $("#rec_factura").val(response.id);
                            },
                            error: function(xhr, status, error){
                                console.error('Error en la solicitud: ', status, ', detalles: ', error);
                                Swal.fire({
                                    title: 'Oops...',
                                    text: 'Se ha producido un error, ' + 'Error en la solicitud: ' + status + ', detalles: ' + error,
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            }
                        });
                    }else{
                        $("#rec_factura").val(response.id);
                    }
                },
                error: function(xhr, status, error){
                    console.error('Error en la solicitud: ', status, ', detalles: ', error);
                    Swal.fire({
                        title: 'Oops...',
                        text: 'Se ha producido un error, ' + 'Error en la solicitud: ' + status + ', detalles: ' + error,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        }
        if ($("#rec_factura").val() == "") {
            var fac_estado = new FormData();
            fac_estado.append('fac_estado', 0);
            Swal.fire({
                title: 'Espere...',
                text: 'Asignando factura y cargando tabla',
                icon: 'info',
                showConfirmButton: false,
                timer: 2000
            });
            setTimeout(function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Factura Asignada',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                });
                EstadoFactura();
                
            }, 1000)
            setTimeout(function(){
                cargarTablaRecepcion();
            }, 3000);
        }

        $('#rec_medico_clave').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '/buscar_medico_id/?q=' + request.term,
                    dataType: 'json',
                    success: function(data) {
                        //console.log(data);
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
                        //console.log(data);
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
                        //console.log(data);
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
                        //console.log(data);
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
                        //console.log(data);
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
                        //console.log(data);
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
                        //console.log(data);
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
                        //console.log(data);
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

        //----Capturar datos del formulario recepcion
        function cargarTablaRecepcion(){
            var id = $("#rec_factura").val();
            $.ajax({
                url: '{{ route("tabla_recepcion", ":id") }}'.replace(':id', id),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
                    if (data.length != 0) {
                        $('#tabla-estudios tbody').empty();
                        $.each(data, function(index, value) {
                            $('#tabla-estudios tbody').append(
                                '<tr><td>' + value.est_cod + '</td>'+
                                    '<td>' + value.est_nombre + '</td>'+
                                    '<td>' + value.est_precio + '</td>'+
                                    '<td>' + value.muestra + '</td>'+
                                    '<td>' + value.indicacion + '</td>'+
                                    '<td><a href="javascript:void(0);" data-id="'+ value.rec_id+ '" data-route="{{ route("recepcion.destroy", ":id") }} " class="btn btn-sm btn-outline-danger btn-delete-estudio" title="Eliminar Estudio"><i class="fas fa-trash-alt"></i></a></td>'+
                                '</tr>');
                        });
                        var sumPrecios = 0;
                        $('#tabla-estudios tbody tr').each(function() {
                            var precio = $(this).find('td:eq(2)').text();
                            if (precio != '') {
                                sumPrecios += parseFloat(precio);
                            }
                        });
                        //console.log(sumPrecios);
                        $('#est_precio_total').val(sumPrecios.toFixed(2));
                    }else {
                        $('#tabla-estudios tbody').empty().append('<td colspan="7" class="text-center">No hay datos recepcionados para factura '+$("#rec_factura").val()+'</td>');
                    }
                }
            });
        }
        $('#CargarRecepcion').on('click', function() {
            Swal.fire({
                title: 'Espere...',
                text: 'Cargando datos',
                icon: 'info',
                showConfirmButton: false,
                timer: 2000
            });
            setTimeout(function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Datos cargados',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                });
            }, 1000)
            setTimeout(function(){
                cargarTablaRecepcion();
            }, 3000);
        });

        $("#btnAddRecepcion").on('click', function() {
            event.preventDefault();
            var datos = new FormData();
            datos.append("caja_id", $("#rec_caja").val());
            datos.append("fac_id", $("#rec_factura").val());
            datos.append("det_id", $("#rec_est_id").val());
            datos.append("estado", $("#rec_estado").val());
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
                success: function (response) {
                    console.log('La solicitud ha sido completada con éxito.');
                    Swal.fire({
                        title: 'Registrado',
                        text: 'Registro de Evento Exitoso',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    cargarTablaRecepcion();
                    $("#rec_est_id").val("");
                    $("#rec_est_clave").val("");
                    $("#rec_est_nombre").val("");
                    $("#rec_est_precio").val("");
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error('Error en la solicitud: ', textStatus, ', detalles: ', errorThrown);
                    Swal.fire({
                        title: 'Oops...',
                        text: 'Se ha producido un error.',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $("#rec_est_id").val("");
                    $("#rec_est_clave").val("");
                    $("#rec_est_nombre").val("");
                    $("#rec_est_precio").val("");
                }
            });
        });

        $(document).on('click', '.btn-delete-estudio', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var route = $(this).data('route');
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¡No podrás revertir esto!',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, borrarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: route.replace(':id', id),
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire({
                                title: '¡Eliminado!',
                                text: response.success,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            setTimeout(function(){
                                cargarTablaRecepcion();
                            }, 2000);
                        },
                        error: function(xhr, status, error){
                            console.error('Error en la solicitud: ', status, ', detalles: ', error);
                            Swal.fire({
                                title: 'Oops...',
                                text: 'Se ha producido un error, ' + 'Error en la solicitud: ' + status + ', detalles: ' + error,
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    });
                }
            })
        });
        function cargarTablaDetalleFactura(){
            var id = $("#rec_factura").val();
            $.ajax({
                url: '{{ route("tabla_recepcion", ":id") }}'.replace(':id', id),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
                    if (data.length != 0) {
                        $('#tabla-factura tbody').empty();
                        $.each(data, function(index, value) {
                            $('#tabla-factura tbody').append(
                                '<tr><td>' + value.est_cod + '</td>'+
                                    '<td>' + value.est_nombre + '</td>'+
                                    '<td>' + value.est_precio + '</td>'+
                                '</tr>');
                        });
                        var sumPrecios = 0;
                        $('#tabla-factura tbody tr').each(function() {
                            var precio = $(this).find('td:eq(2)').text();
                            if (precio != '') {
                                sumPrecios += parseFloat(precio);
                            }
                        });
                        //console.log(sumPrecios);
                        $('#fac_precio_total').val(sumPrecios.toFixed(2));
                    }else {
                        $('#tabla-factura tbody').empty().append('<td colspan="7" class="text-center">No hay datos recepcionados para factura '+$("#rec_factura").val()+'</td>');
                    }
                }
            });
        }
        $("#btnUpdateRec").on('click' , function() {
            if ($("#rec_paciente_clave").val() == "" || $("#rec_paciente_nombre").val() == "") {
                Swal.fire({
                    title: 'Oops...',
                    text: 'Ingrese datos del paciente',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 2000,
                })
                setTimeout(function(){
                    $("#rec_paciente_clave").trigger('focus');
                    $('#btnUpdateRec').attr('data-toggle', 'modal');
                    $('#btnUpdateRec').attr('data-target', '#modal_crear_factura');
                }, 2000);
                
            }else if($("#est_precio_total").val() == "" || $("#est_precio_total").val() == "0.00"){
                Swal.fire({
                    title: 'Oops...',
                    text: 'Debe registrar al menos un estudio o grupo de estudios',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 2000,
                })
                setTimeout(function(){
                    $("#rec_est_clave").trigger('focus');
                    $('#btnUpdateRec').attr('data-toggle', 'modal');
                    $('#btnUpdateRec').attr('data-target', '#modal_crear_factura');
                }, 2000);
                
            }else{
                $('#btnUpdateRec').attr('data-toggle', 'modal');
                $('#btnUpdateRec').attr('data-target', '#modal_crear_factura');
                $("#fac_factura").val($("#rec_factura").val());
                $("#fac_paciente_nombre").val($("#rec_paciente_nombre").val())
                cargarTablaDetalleFactura()
            }
        })
        $("#fac_importe").on('keyup change',function() {
            var total = document.getElementById("fac_precio_total").value;
            var importe = $(this).val();
            var cambio = (parseFloat(importe) - parseFloat(total)).toFixed(2);
            document.getElementById("fac_cambio").value = cambio;
        });

        function UpdateFactura(estado) {
            event.preventDefault();
            var datos_fact = new FormData();
            var factura = $("#rec_factura").val();
            datos_fact.append('cli_id', $("#rec_paciente_id").val());
            datos_fact.append('med_id', $("#rec_medico_id").val());
            datos_fact.append('emp_id', $("#rec_empresa_id").val());
            datos_fact.append('fac_total', $("#est_precio_total").val());
            datos_fact.append('fac_estado', 1);
            datos_fact.append('fac_observacion', $("#rec_observacion").val());
            datos_fact.append('fac_referencia', $("#rec_referencia").val());
            datos_fact.append('fac_importe', $("#fac_importe").val());
            datos_fact.append('fac_cambio', $("#fac_cambio").val());
            for (var campo of datos_fact.values()) {
                console.log(campo);
            }
            $.ajax({
                url: '{{ route("factura.update", ":id") }}'.replace(':id', factura),
                method: "PUT",
                data: datos_fact,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire({
                        title: '¡Exito!',
                        text: 'Se genero la factura exitosamente',
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ver factura',
                        cancelButtonText: 'Continuar'
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.cancel) {
                            var fac_estado = new FormData();
                            $("#form_recepcion_factura")[0].reset();
                            $("#form_crear_factura")[0].reset();
                            fac_estado.append('fac_estado', 0);
                            Swal.fire({
                                title: 'Espere...',
                                text: 'Asignando factura y cargando tabla',
                                icon: 'info',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            setTimeout(function() {
                                Swal.fire({
                                    title: '¡Éxito!',
                                    text: 'Factura Asignada',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                EstadoFactura();
                                
                            }, 1000)
                            setTimeout(function(){
                                cargarTablaRecepcion();
                            }, 3000);
                        }else if (result.isConfirmed) {
                            $("#form_recepcion_factura")[0].reset();
                            $("#form_crear_factura")[0].reset();
                            var fac_estado = new FormData();
                            fac_estado.append('fac_estado', 0);
                            Swal.fire({
                                title: 'Espere...',
                                text: 'Asignando factura y cargando tabla',
                                icon: 'info',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            setTimeout(function() {
                                Swal.fire({
                                    title: '¡Éxito!',
                                    text: 'Factura Asignada',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                EstadoFactura();
                                
                            }, 1000)
                            setTimeout(function(){
                                cargarTablaRecepcion();
                            }, 3000);
                        }
                    });
                },
                error: function(xhr, status, error){
                    console.error('Error en la solicitud: ', status, ', detalles: ', error);
                    Swal.fire({
                        title: 'Oops...',
                        text: 'Se ha producido un error, ' + 'Error en la solicitud: ' + status + ', detalles: ' + error,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        }

        $("#btnRegisterFactura").on('click', function () {
            if($("#fac_tipo_pago").val() == 'EFECTIVO'){
                if (parseFloat($('#fac_importe').val()) < parseFloat($('#fac_precio_total').val())) {
                    Swal.fire({
                        title: 'Oops...',
                        text: 'Ingrese Monto de Pago Correcto',
                        icon: 'info',
                        showConfirmButton: false,
                        timer: 2000,
                    })
                    setTimeout(function(){
                        $("#fac_importe").trigger('focus');
                    }, 2000);
                    return false;
                }else{
                    Swal.fire({
                        title: '¿Está seguro?',
                        text: 'Revisar los datos antes de continuar',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Si, continuar',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            UpdateFactura(1);
                        }
                    });
                    
                }

            }
        })
    });
</script>