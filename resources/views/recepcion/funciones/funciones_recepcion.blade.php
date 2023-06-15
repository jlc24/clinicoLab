@include('cliente.funciones.funciones_cliente')

@include('medico.funciones.funciones_medico')

@include('empresa.funciones.funciones_empresa')

<script type="text/javascript">
    
    $(document).ready(function() {
        function EstadoFactura() {
            var fac_estado = new FormData();
            fac_estado.append('fac_estado', 0);
            $.ajax({
                url: '/validarFactura',
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    if (response.id == undefined) {
                        $.ajax({
                            url: "{{ route('factura') }}",
                            method: "POST",
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
                $('#rec_celular').val(ui.item.cli_celular);
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
                $('#rec_genero').val(ui.item.cli_genero);
                $('#rec_edad').val(ui.item.edad+' años');
                $('#rec_celular').val(ui.item.cli_celular);
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
                    if (data.length != 0) {
                        $('#tabla-estudios tbody').empty();
                        $.each(data, function(index, value) {
                            $('#tabla-estudios tbody').append(
                                '<tr><td>' + value.est_cod + '</td>'+
                                    '<td>' + value.est_nombre + '</td>'+
                                    '<td class="text-right">' + value.est_precio + '</td>'+
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
                        $('#est_precio_total').val(sumPrecios.toFixed(2));
                    }else {
                        $('#est_precio_total').val("");
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
                    Swal.fire({
                        title: 'Registrado',
                        text: 'Registro de Evento Exitoso',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
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
        $("#checkMedico").on('change', function () {
            if (this.checked) {
                $("#rec_medico_clave").prop("disabled", false);
                $("#rec_medico_nombre").prop("disabled", false);
                $("#rec_medico_add").css({"pointer-events": "", "opacity": ""});
                $("#rec_medico_clave").focus();
            }else{
                $("#rec_medico_clave").prop("disabled", true);
                $("#rec_medico_clave").val("");
                $("#rec_medico_nombre").prop("disabled", true);
                $("#rec_medico_nombre").val("");
                $("#rec_medico_add").css({"pointer-events": "none", "opacity": "0.5"});
                $("#rec_especialidad").val("");
            }
        })
        $("#checkEmpresa").on('change', function () {
            if (this.checked) {
                $("#rec_empresa_clave").prop("disabled", false);
                $("#rec_empresa_nombre").prop("disabled", false);
                $("#rec_empresa_add").css({"pointer-events": "", "opacity": ""});
                $("#rec_empresa_clave").focus();
            }else{
                $("#rec_empresa_clave").prop("disabled", true);
                $("#rec_empresa_clave").val("");
                $("#rec_empresa_nombre").prop("disabled", true);
                $("#rec_empresa_nombre").val("");
                $("#rec_empresa_add").css({"pointer-events": "none", "opacity": "0.5"});
            }
        })

        $('#modal_crear_factura').on('shown.bs.modal', function () {
            $('#fac_importe').trigger('focus');
        });

        $('#modal_enviar_cotizacion').on('shown.bs.modal', function () {
            $('#enviar_numero').trigger('focus');
        });

        $("#btnCloseSendCot").on('click', function() {
            $("#enviar_numero").val("");
            $("#enviar_texto").val("");
        })

        function cargarTablaDetalleFactura(){
            var id = $("#rec_factura").val();
            $.ajax({
                url: '{{ route("tabla_recepcion", ":id") }}'.replace(':id', id),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length != 0) {
                        $('#tabla-factura tbody').empty();
                        $.each(data, function(index, value) {
                            $('#tabla-factura tbody').append(
                                '<tr><td>' + value.est_cod + '</td>'+
                                    '<td>' + value.est_nombre + '</td>'+
                                    '<td>' + value.est_precio + '</td>'+
                                    '<td>' + value.est_moneda + '</td>'+
                                '</tr>');
                        });
                        var sumPrecios = 0;
                        $('#tabla-factura tbody tr').each(function() {
                            var precio = $(this).find('td:eq(2)').text();
                            if (precio != '') {
                                sumPrecios += parseFloat(precio);
                            }
                        });
                        $('#fac_precio_total').val(sumPrecios.toFixed(2));
                    }else {
                        $('#tabla-factura tbody').empty().append('<td colspan="7" class="text-center">No hay datos recepcionados para factura '+$("#rec_factura").val()+'</td>');
                    }
                }
            });
        }
        $("#btnEnviarCotizacion").on('click', function() {
            if($("#est_precio_total").val() == "" || $("#est_precio_total").val() == "0.00"){
                $(this).attr('data-toggle', '');
                $(this).attr('data-target', '');
                Swal.fire({
                    title: 'Oops...',
                    text: 'Debe registrar al menos un estudio o grupo de estudios',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 2000,
                })
                setTimeout(function(){
                    $("#rec_est_clave").trigger('focus');
                    $(this).attr('data-toggle', 'modal');
                    $(this).attr('data-target', '#modal_enviar_cotizacion');
                }, 2000);
            }else{
                $(this).attr('data-toggle', 'modal');
                $(this).attr('data-target', '#modal_enviar_cotizacion');
                $("#enviar_numero").val($("#rec_celular").val());
                var saludo = 'Hola Buenos días,';
                var medio = 'Por este medio te enviamos la información solicitada.';
                var tiempo = '*RESULTADOS SE ENTREGAN EL MISMO DIA*';
                var fin = 'Quedamos a tus órdenes para cualquier consulta.';
                var empresa = '{{ $empresa->nombre }}';
                var direccion = '{{ $empresa->direccion }}';
                var num_empresa = '*{{ $empresa->telefono }}*';
                var total = $("#est_precio_total").val();

                var datosArray = [];
                $("#tabla-estudios tbody tr").each(function (row, tr) {
                    var datosRow = {
                        estudio: $(tr).find('td:eq(1)').text(),
                        indicaciones: $(tr).find('td:eq(4)').text(),
                        precio: $(tr).find('td:eq(2)').text(),
                    };
                    datosArray.push(datosRow);
                })
                var contenido = '';
                for (let i = 0; i < datosArray.length; i++) {
                    const datosRow = datosArray[i];
                    contenido += 'Estudio: *' + datosRow.estudio + '*\n';
                    contenido += 'Indicaciones: *' + datosRow.indicaciones + '*\n';
                    contenido += 'Precio: *' + datosRow.precio + ' Bs*\n\n';
                }
                var mensaje =  saludo + '\n'+
                            medio + '\n\n' +
                            contenido + 'Total: *' + total + ' Bs*\n\n' +
                            tiempo + '\n\n' +
                            empresa + ", " + direccion + "." + '\n\n' +
                            "Whatsapp: " + num_empresa + ".";

                $("#enviar_texto").val(mensaje);
            }
        });
        $("#btnEnviarMensaje").on('click', function() {
            if ($("#enviar_numero").val() == "") {
                Swal.fire({
                    title: 'Oops...',
                    text: 'Debe ingresar un numero valido de Whatsapp',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 2000,
                })
                $("#enviar_numero").focus();
            }else{
                var codigo = $("#enviar_numero_codigo").val();
                var numero = $("#enviar_numero").val();
                var mensaje = $("#enviar_texto").val().replace(/\n/g, "%0A").replace(/_/g, '__').replace(/([*])(\s)/g, '$2$1').replace(/~/g, '_~').replace(/# /g, '%23%20').replace(/#/g, '%23');
    
                var link = 'https://api.whatsapp.com/send?phone=' + codigo + numero + '&text=' + mensaje;
                window.open(link);
            }
        });

        $("#btnUpdateRec").on('click' , function() {
            if ($("#rec_paciente_clave").val() == "" || $("#rec_paciente_nombre").val() == "") {
                $('#btnUpdateRec').attr('data-toggle', '');
                $('#btnUpdateRec').attr('data-target', '');
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
                $('#btnUpdateRec').attr('data-toggle', '');
                $('#btnUpdateRec').attr('data-target', '');
                Swal.fire({
                    title: 'Oops...',
                    text: 'Debe registrar al menos un estudio.',
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
                $("#fac_factura_id").text($("#rec_factura").val());
                $("#fac_paciente_id").val($("#rec_paciente_id").val());
                $("#fac_paciente_nombre").text($("#rec_paciente_nombre").val());
                $("#fac_paciente_edad").text($("#rec_edad").val());
                $("#fac_observacion").val($("#rec_observacion").val());
                $("#fac_referencia").val($("#rec_referencia").val());
                if ($("#rec_empresa_nombre").val() != "" || $("#rec_empresa_clave").val() != "") {
                    $("#block_empresa").css("display", "");
                    $("#fac_empresa_id").val($("#rec_empresa_id").val());
                    $("#fac_empresa_nombre").text($("#rec_empresa_nombre").val());
                }else{
                    $("#block_empresa").css("display", "none");
                    $("#fac_empresa_id").val("");
                }
                if ($("#rec_medico_nombre").val() != "" || $("#rec_medico_clave").val() != "") {
                    $("#block_medico").css("display", "");
                    $("#fac_medico_id").val($("#rec_medico_id").val());
                    $("#fac_medico_nombre").text($("#rec_medico_nombre").val());
                }else{
                    $("#block_medico").css("display", "none");
                    $("#fac_medico_id").val("");
                }
                cargarTablaDetalleFactura()
            }
        })
        $("#fac_importe").on('keyup change',function() {
            var total = document.getElementById("fac_precio_total").value;
            var importe = $(this).val();
            var cambio = (parseFloat(importe) - parseFloat(total)).toFixed(2);
            document.getElementById("fac_cambio").value = cambio;
        });

        function UpdateFactura(fac_id, datos) {
            mostrarCargando();
            $.ajax({
                url: "{{ route('factura.update', ':id') }}".replace(':id', fac_id),
                type: "POST",
                data: datos,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $.ajax({
                        url: '{{ route("factura.pdf", ":id") }}'.replace(":id", fac_id),
                        type: 'GET',
                        success: function(data) {
                            var pdfFrame = document.getElementById('pdfFrame');
                            var checkPDFReadyInterval = setInterval(function() {
                                if (data.fac_ruta_file !== null) {
                                    pdfFrame.src = "{{ asset('storage') }}"+"/"+data.fac_ruta_file;
                                    clearInterval(checkPDFReadyInterval);
                                }
                                cerrarCargando();
                            }, 100);
                            $(document).on('click', '.btnClosePdfGenerate', function () {
                                window.location.href = '{{ route('recepcion') }}';
                            });
                        }
                    });
                    // window.open('{{ route("factura.pdf", ":id") }}'.replace(":id", fac_id), '_blank');
                    // setTimeout(function(){
                        //window.location.href = '{{ route('recepcion') }}';
                    // }, 2000);
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

        $(document).on('click', '.btn-facturar-recepcion', function() {
            var id = $('.fac_factura_id').text();
            $(".exampleModalLabel").text('Factura');
            if($('#fac_tipo_pago').val() == 'EFECTIVO'){
                if (parseFloat($('#fac_importe').val()) < parseFloat($('#fac_precio_total').val())) {
                    Swal.fire({
                        title: 'Oops...',
                        text: 'Ingrese Monto de Pago Correcto',
                        icon: 'info',
                        showConfirmButton: false,
                        timer: 2000,
                    })
                    setTimeout(function(){
                        $('#fac_importe').trigger('focus');
                    }, 2000);
                    return false;
                }else{
                    var datos = new FormData();
                    datos.append('fac_paciente_id', $("#fac_paciente_id").val());
                    datos.append('fac_medico_id', $("#fac_medico_id").val());
                    datos.append('fac_empresa_id', $("#fac_empresa_id").val());
                    datos.append('fac_precio_total', $('#fac_precio_total').val());
                    datos.append('fac_estado', 1);
                    datos.append('fac_tipo_pago', $('#fac_tipo_pago').val());
                    //datos.append('fac_descuento', $('#fac_descuento').val());
                    datos.append('fac_observacion', $('#fac_observacion').val());
                    datos.append('fac_referencia', $('#fac_referencia').val());
                    datos.append('fac_importe', $('#fac_importe').val());
                    datos.append('fac_cambio', $('#fac_cambio').val());

                    UpdateFactura(id, datos);
                }
            }
        });

        const hoy = new Date();
        const mesActual = hoy.getMonth();
        const anioActual = hoy.getFullYear();

        for (let i = 1; i <= 12; i++) {
            $('#fac_fecha_exp_mes').append($('<option></option>').val(i).text(obtenerNombreDelMes(i - 1)));
        }

        $('#fac_fecha_exp_mes').val(mesActual + 1);

        for (let i = anioActual; i <= anioActual + 10; i++) {
            $('#fac_fecha_exp_anio').append($('<option></option>').val(i).text(i));
        }

        $('#fac_fecha_exp_anio').val(anioActual);

        function obtenerNombreDelMes(numeroDeMes) {
            const nombresDeMes = [
                'ENE', 'FEB', 'MAR', 'ABR',
                'MAY', 'JUN', 'JUL', 'AGO',
                'SEP', 'OCT', 'NOV', 'DIC'
            ];
            return nombresDeMes[numeroDeMes];
        }

        // $("#fac_num_tarjeta").on('keyup', function(event) {
            
        //     var input = $(this).val();

        //     let cardNumber = event.target.value;
        //     // Reemplazar los primeros dígitos con asteriscos
        //     let maskedCardNumber = cardNumber.slice(0, -4).replace(/./g, '*');

        //     // Separar los últimos 4 dígitos y agregarlos a la versión enmascarada de la tarjeta
        //     if (cardNumber.length > 4) {
        //         maskedCardNumber += ' ' + cardNumber.slice(-4).replace(/\s/g,'').replace(/(\d{4})/g, '$1');
        //     } else {
        //         maskedCardNumber += cardNumber.slice(-4);
        //     }
        //     $(event.target).val(maskedCardNumber);
        // });
        
        $("#fac_tipo_pago").on('change', function() {
            if ($(this).val() == 'EFECTIVO') {
                $(".efectivo").prop('hidden', false);
                $(".tarjeta_credito_debito").prop('hidden', true);
                $(".cheque").prop('hidden', true);
                $(".transferencia").prop('hidden', true);
                $(".otro").prop('hidden', true);
                $("#fac_importe").val("0.00");
                $("#fac_importe").trigger('focus');
            }else if ($(this).val() == 'CREDITO/DEBITO') {
                $(".efectivo").prop('hidden', true);
                $(".tarjeta_credito_debito").prop('hidden', false);
                $(".cheque").prop('hidden', true);
                $(".transferencia").prop('hidden', true);
                $(".otro").prop('hidden', true);
                $("#fac_num_tarjeta").trigger('focus');
            }else if ($(this).val() == 'CHEQUE') {
                $(".efectivo").prop('hidden', true);
                $(".tarjeta_credito_debito").prop('hidden', true);
                $(".cheque").prop('hidden', false);
                $(".transferencia").prop('hidden', true);
                $(".otro").prop('hidden', true);
                $("#fac_num_cheque").trigger('focus');
            }else if ($(this).val() == 'TRANSFERENCIA') {
                $(".efectivo").prop('hidden', true);
                $(".tarjeta_credito_debito").prop('hidden', true);
                $(".cheque").prop('hidden', true);
                $(".transferencia").prop('hidden', false);
                $(".otro").prop('hidden', true);
                $("#fac_trans_banco").trigger('focus');
            }else if ($(this).val() == 'OTRO') {
                $(".efectivo").prop('hidden', true);
                $(".tarjeta_credito_debito").prop('hidden', true);
                $(".cheque").prop('hidden', true);
                $(".transferencia").prop('hidden', true);
                $(".otro").prop('hidden', false);
                $("#fac_num_cheque").trigger('focus');
            }
        });

    });
</script>