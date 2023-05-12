<script type="text/javascript">
    
    $(document).ready(function() {
        $("#modal_crear_material").on('shown.bs.modal', function() {
            $("#mat_nombre").trigger('focus');
        });
        $("#btnCloseAddMaterial").on('click', function() {
            $("#formulario_materiales").trigger('reset');
            const imgMaterial = document.getElementById('img_material');
            imgMaterial.src = '{{ asset("dist/img/default.png") }}';
        });

        $("#tabla_materiales").dataTable({
            responsive: true,
            columnDefs: [],
            "lengthMenu": [10, 20, 30, 100],
            /* Disable initial sort */
            "aaSorting": [],
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Registros del _START_ al _END_ de un total de _TOTAL_ ",
                "sInfoEmpty": "Registros del 0 al 0 de un total de 0 ",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
        
        $("#mat_id_moneda").on('change', function() {
            if ($(this).val() === 'sus') {
                $("#cambio_moneda").css('display', '');
            }else{
                $("#cambio_moneda").css('display', 'none');
            }
        });

        $("#usd").on('keyup change', function() {
            var cantidad = $(this).val();
            subtotal = (parseFloat(cantidad)*(6.91)).toFixed(2);
            $('#bob').val(subtotal);
        });
        $("#bob").on('keyup change', function() {
            var cantidad = $(this).val();
            subtotal = (parseFloat(cantidad)*(0.1447)).toFixed(2);
            $('#usd').val(subtotal);
        });

        $("#create_importe").on('click', function() {
            $("#mat_precio_compra").val($("#bob").val());
            $("#usd").val('1')
            $("#bob").val('6.91')
        });

        $("#btnRegisterMaterial").on('click', function(event) {
            event.preventDefault();
            var fileData = $("#mat_imagen").prop("files")[0];
            var estado = '0';
            var datos = new FormData();
            datos.append('mat_cod', $("#mat_cod").val());
            datos.append('mat_nombre', $("#mat_nombre").val());
            datos.append('mat_descripcion', $("#mat_descripcion").val());
            datos.append('cat_id', $("#mat_categoria").val());
            datos.append('mat_imagen', fileData);
            datos.append('mat_ventas', 0);
            datos.append('mat_estado', estado);

            $.ajax({
                url: '{{ route("material.store") }}',
                type: 'POST',
                data: datos,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: 'Dato registrado correctamente',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    //setTimeout(function(){
                        window.location.href = '{{ route('material') }}';
                    //}, 1000);
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
        });
        
        function updateEstado(id, estado, valor) {
            var datos = new FormData();
            datos.append('mat_estado', estado);
            $.ajax({
                url: '{{ route("material.updateEstado", ":id") }}'.replace(":id", id),
                type: 'POST',
                data: datos,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: 'Material '+valor+' correctamente',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    //setTimeout(function(){
                        window.location.href = '{{ route('material') }}';
                    //}, 1000);
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

        $(document).on('click', '.btn-inactivo', function() {
            var id = $(this).closest('tr').find('td:eq(0)').text();
            var estado = 0;
            var valor = 'desactivado';
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Si desactivas un material no podrás usarlo en otros procesos',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#40CC6C',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, desactivar!',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    updateEstado(id, estado, valor);
                }
            });
        });

        $(document).on('click', '.btn-activo', function() {
            var id = $(this).closest('tr').find('td:eq(0)').text();
            var stock = $(this).closest('tr').find('td:eq(4)').text();
            var estado = 1;
            var valor = 'activado';
            if (stock == 0) {
                Swal.fire({
                    title: 'Oops...',
                    text: 'No puede habilitar el material porque tiene 0 en stock',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Si activas un material podrás usarlo en otros procesos',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#40CC6C',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, activar!',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        updateEstado(id, estado, valor);
                    }
                });
            }
        });

        function getMaterial(id) {
            return  $.ajax({
                        url: '{{ route("material.edit", ":id") }}'.replace(':id', id),
                        type: 'GET',
                        dataType: 'json',
                    });
        }

        function getCompra(id) {
            return  $.ajax({
                        url: '{{ route("compra.edit", ":id") }}'.replace(':id', id),
                        type: 'GET',
                        dataType: 'json',
                    });
        }
        $(".btnEditarMaterial").on('click', function() {
            var id = $(this).closest('tr').find('td:eq(0)').text();
            getMaterial(id).then(function(data_mat) {
                $(".mat_id_update").val(data_mat.id);
                $(".mat_cod_update").val(data_mat.mat_cod);
                $(".mat_nombre_update").val(data_mat.mat_nombre);
                $(".mat_descripcion_update").text(data_mat.mat_descripcion);
                $(".mat_categoria_update").val(data_mat.cat_id);
                if (data_mat.mat_imagen == null) {
                    $(".img_material_update").attr("src", '{{ asset('dist/img/default.png') }}');
                }else{
                    $(".img_material_update").attr("src", data_mat.mat_imagen);
                }
            });
        });

        $(document).on('click', '.btnUpdateMaterial', function(event) {
            event.preventDefault();
            var mat_id = $(".mat_id_update").val();
            var imagenFile = $(".mat_imagen_update").prop("files")[0];
            if (!imagenFile || !$(".mat_imagen_update").prop("files").length) {
                Swal.fire({
                    title: 'Imagen no seleccionada',
                    text: '¿Deseas matener la imagen del material guardado o cambiar otra imagen?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#40CC6C',
                    cancelButtonColor: '#5C636A',
                    confirmButtonText: 'Mantener imagen',
                    cancelButtonText: 'Cambiar imagen'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var datos = new FormData();
                        datos.append('mat_cod', $(".mat_cod_update").val());
                        datos.append('mat_nombre', $(".mat_nombre_update").val());
                        datos.append('mat_descripcion', $(".mat_descripcion_update").val());
                        datos.append('cat_id', $(".mat_categoria_update").val());
                        
                        for (const [key, value] of datos) {
                            console.log(key, '- '+value);
                        };

                        $.ajax({
                            url: '{{ route("material.update", ":id") }}'.replace(":id", mat_id),
                            type: 'POST',
                            data: datos,
                            contentType: false,
                            processData: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: '¡Éxito!',
                                    text: 'Dato actualizado correctamente',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                //setTimeout(function(){
                                    window.location.href = '{{ route('material') }}';
                                //}, 1000);
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
                });
            }else{
                var datos = new FormData();
                datos.append('mat_cod', $(".mat_cod_update").val());
                datos.append('mat_nombre', $(".mat_nombre_update").val());
                datos.append('mat_descripcion', $(".mat_descripcion_update").val());
                datos.append('cat_id', $(".mat_categoria_update").val());
                datos.append('mat_imagen', imagenFile);
                
                for (const [key, value] of datos) {
                    console.log(key, '- '+value);
                };

                $.ajax({
                    url: '{{ route("material.update", ":id") }}'.replace(":id", mat_id),
                    type: 'POST',
                    data: datos,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            title: '¡Éxito!',
                            text: 'Dato actualizado correctamente',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        //setTimeout(function(){
                            window.location.href = '{{ route('material') }}';
                        //}, 1000);
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
        });

        $("#btnCloseAddCompra").on('click', function() {
            $(".formulario_comprar_material").trigger('reset');
        });

        $("#modal_abastecer_material").on('shown.bs.modal', function() {
            $(".mat_cantidad_abastecer").focus();
        });

        $(".btnAbastecerMaterial").on('click', function() {
            var id = $(this).closest('tr').find('td:eq(0)').text();
            getMaterial(id).then(function(data) {
                $(".mat_id_abastecer").val(data.id);
                $(".modal_abastecer_materialLabel").text('Abastecer Material: '+ data.mat_nombre);
            });
        });

        $(".btnRegistrarCompra").on('click', function(event) {
            event.preventDefault();
            if ($(".mat_unidad_abastecer").val() == "" || $(".mat_cantidad_abastecer").val() == 0 || $(".mat_fecha_elab_abastecer").val() == "" || $(".mat_fecha_venc_abastecer").val() == "" || $(".mat_precio_compra_abastecer").val() ==  "" || $(".mat_precio_compra_abastecer").val() == 0 || $(".mat_tipo_pago_abastecer").val() == "") {
                Swal.fire({
                    title: 'Oops...',
                    text: 'Faltan datos necesarios para realizar la compra del material, por favor revise',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                var datos = new FormData();
                datos.append('mat_id', $("#mat_id_abastecer").val());
                datos.append('comp_elaboracion', $("#mat_fecha_elab_abastecer").val());
                datos.append('comp_vencimiento', $("#mat_fecha_venc_abastecer").val());
                datos.append('umed_id', $("#mat_unidad_abastecer").val());
                datos.append('comp_cantidad', $("#mat_cantidad_abastecer").val());
                datos.append('comp_precio_compra', $("#mat_precio_compra_abastecer").val());
                datos.append('comp_precio_unitario', $("#mat_precio_unitario_abastecer").val());
                datos.append('comp_tipo', $("#mat_tipo_pago_abastecer").val());
                datos.append('prov_id', $("#mat_proveedor_abastecer").val());
                datos.append('comp_observacion', $("#mat_observacion_abastecer").val());
                datos.append('comp_estado', 'EN RESERVA');
                
                Swal.fire({
                    title: 'Registrar Compra',
                    text: '¿Estan correcto los datos?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#40CC6C',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, registrar!',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route("compra.store") }}',
                            type: 'POST',
                            data: datos,
                            contentType: false,
                            processData: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: '¡Éxito!',
                                    text: 'Dato actualizado correctamente',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                //setTimeout(function(){
                                    window.location.href = '{{ route('material') }}';
                                //}, 1000);
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
                });
            }
        });

        function getComprasMaterial(id) {
            $.ajax({
                url: '{{ route("getComprasMaterial", ":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data.length != 0) {
                        $('.tabla_compras_realizadas tbody').empty();
                        $.each(data, function(index, value) {
                            $('.tabla_compras_realizadas tbody').append(
                                '<tr class="' + (value.inMaterial == '1' ? 'table-warning' : '') + '"><td>' + value.id + '</td>'+
                                    '<td>' + value.unidad + '</td>'+
                                    '<td>' + value.comp_cantidad + '</td>'+
                                    '<td>' + value.comp_precio_compra + '</td>'+
                                    '<td>' + value.comp_precio_unitario + '</td>'+
                                    '<td class="text-center">'+
                                        '<a data-toggle="modal" data-target="#modal_config_parametro" class="btn btn-sm ' + (value.inMaterial == '1' ? 'btn-secondary btn-use-compra' : 'btn-outline-success btn-wait-compra') + ' " ' + (value.inMaterial == '1' ? 'title="En uso"' : 'title="Usar Compra"') + ' >'+
                                            (value.inMaterial == '1' ? '<i class="fas fa-check"></i>' : '<i class="fas fa-pause"></i>') + 
                                        '</a>'+
                                    '</td>'+
                                '</tr>'
                            );
                        });
                    }else {
                        $('.tabla_compras_realizadas tbody').empty().append('<td colspan="6" class="text-center">No hay datos recepcionados</td>');
                    }
                }
            });
        }
        
        $(".btnVerMaterial").on('click', function() {
            var id = $(this).closest('tr').find('td:eq(0)').text();
            getMaterial(id).then(function(data) {
                console.log(data);
                $(".modal_ver_materialLabel").text('Datos de Material: '+data.mat_nombre);
                if (data.mat_imagen == null) {
                    $(".show_img_material").attr('src', '{{ asset('dist/img/default.png') }}');
                }else{
                    $(".show_img_material").attr('src', data.mat_imagen);
                }
                $(".show_mat_cod").val(data.mat_cod);
                $(".show_mat_nombre").val(data.mat_nombre);
                $(".show_mat_unidad").val(data.umed_id)

                getCompra(data.comp_id).then(function(params) {
                    if (Object.keys(params).length !== 0) {
                        $('.tabla_compra_actual tbody').empty();
                        var tbody = $('.tabla_compra_actual').find('tbody');
                        var newRow = $("<tr>");
                        var cell1 = $("<td>").text(params.id);
                        var cell2 = $("<td>").text(params.comp_cantidad);
                        var cell3 = $("<td>").text(params.comp_precio_compra);
                        var cell4 = $("<td>").text(params.comp_precio_unitario);
                        var cell5 = $("<td>").text(data.mat_cantidad-data.mat_ventas);
                        newRow.append(cell1);
                        newRow.append(cell2);
                        newRow.append(cell3);
                        newRow.append(cell4);
                        newRow.append(cell5);
                        tbody.append(newRow);
                    }else{
                        $('.tabla_compra_actual tbody').empty().append('<td colspan="5" class="text-center">No hay datos recepcionados</td>');
                    }
                });
            });
            getComprasMaterial(id);
        });

        

    });
</script>