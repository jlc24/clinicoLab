<script type="text/javascript">
    
    $(document).ready(function() {
        $("#modal_crear_material").on('shown.bs.modal', function() {
            $("#mat_nombre").trigger('focus');
        });
        $("#modal_abastecer_material").on('shown.bs.modal', function() {
            $("#mat_cod_compra_abastecer").trigger('focus');
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

        $("#mat_categoria").on('change', function() {
            let categoria = $(this).find(":selected").text().toUpperCase();
            if (categoria.includes("EQUIPO")) {
                $("#vidaUtil").prop("hidden", false);
                $("#depreciacion").prop("hidden", false);
            }else{
                $("#vidaUtil").prop("hidden", true);
                $("#depreciacion").prop("hidden", true);
            }
        });
        $("#mat_categoria_update").on('change', function() {
            let categoria = $(this).find(":selected").text().toUpperCase();
            if (categoria.includes("EQUIPO")) {
                $("#vidaUtil_update").prop("hidden", false);
                $("#depreciacion_update").prop("hidden", false);
            }else{
                $("#vidaUtil_update").prop("hidden", true);
                $("#depreciacion_update").prop("hidden", true);
            }
        });

        $("#btnRegisterMaterial").on('click', function(event) {
            event.preventDefault();
            if ($("#mat_nombre").val() == '' || $("#mat_categoria").val() == '' || $("#mat_categoria").val() == null || $("#mat_vida_util").val() == "" || $("#mat_depreciacion").val() == "") {
                let vacio = '';
                if ($("#mat_nombre").val() == '') {
                    vacio = 'NOMBRE';
                }else if ($("#mat_categoria").val() == '') {
                    vacio = 'CATEGORIA';
                }else if ($("#mat_categoria").val() == null) {
                    vacio = 'CATEGORIA';
                }else if ($("#mat_categoria").find(":selected").text().toUpperCase().includes("EQUIPO") && $("#mat_vida_util").val() == "") {
                    vacio = 'VIDA UTIL';
                }else if ($("#mat_categoria").find(":selected").text().toUpperCase().includes("EQUIPO") && $("#mat_depreciacion").val() == "") {
                    vacio = 'DEPRECIACION';
                }
                Swal.fire({
                    title: 'Error!',
                    text: 'El campo ' + vacio + ' es requerido',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
                $("#mat_nombre").trigger('focus');
            }else{
                var fileData = $("#mat_imagen").prop("files")[0];
                var estado = '0';
                var datos = new FormData();
                //datos.append('mat_cod', $("#mat_cod").val());
                datos.append('mat_nombre', $("#mat_nombre").val());
                datos.append('mat_descripcion', $("#mat_descripcion").val());
                datos.append('cat_id', $("#mat_categoria").val());
                datos.append('mat_vida_util', $("#mat_vida_util").val());
                datos.append('mat_depreciacion', $("#mat_depreciacion").val());
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
            }
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
        $(document).on('click', '.btnEditarMaterial', function() {
            var id = $(this).closest('tr').find('td:eq(0)').text();
            let categoria = $(this).closest("tr").find("td:eq(3)").text().toUpperCase();
            if (categoria.includes("EQUIPO") ) {
                $(".vidaUtil_update").prop('hidden', false);
                $(".depreciacion_update").prop('hidden', false);
            }else{
                $(".vidaUtil_update").prop('hidden', true);
                $(".depreciacion_update").prop('hidden', true);
            }
            getMaterial(id).then(function(data_mat) {
                $(".mat_id_update").val(data_mat.id);
                //$(".mat_cod_update").val(data_mat.mat_cod);
                $(".mat_nombre_update").val(data_mat.mat_nombre);
                $(".mat_descripcion_update").text(data_mat.mat_descripcion);
                $(".mat_categoria_update").val(data_mat.cat_id);
                $(".mat_vida_util_update").val(data_mat.mat_vida_util);
                $(".mat_depreciacion_update").val(data_mat.mat_depreciacion);
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
                        if ($("#mat_nombre_update").val() == '' || $("#mat_categoria_update").val() == '' || $("#mat_categoria").val() == null || $("#mat_vida_util_update").val() == "" || $("#mat_depreciacion_update").val() == "") {
                            let vacio = '';
                            if ($("#mat_nombre_update").val() == '') {
                                vacio = 'NOMBRE';
                            }else if ($("#mat_categoria_update").val() == '') {
                                vacio = 'CATEGORIA';
                            }else if ($("#mat_categoria_update").val() == null) {
                                vacio = 'CATEGORIA';
                            }else if ($("#mat_categoria_update").find(":selected").text().toUpperCase().includes("EQUIPO") && $("#mat_vida_util_update").val() == "") {
                                vacio = 'VIDA UTIL';
                            }else if ($("#mat_categoria_update").find(":selected").text().toUpperCase().includes("EQUIPO") && $("#mat_depreciacion_update").val() == "") {
                                vacio = 'DEPRECIACION';
                            }
                            Swal.fire({
                                title: 'Error!',
                                text: 'El campo ' + vacio + ' es requerido',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            $("#mat_nombre_update").trigger('focus');
                        }else{
                            var datos = new FormData();
                            //datos.append('mat_cod', $(".mat_cod_update").val());
                            datos.append('mat_nombre', $(".mat_nombre_update").val());
                            datos.append('mat_descripcion', $(".mat_descripcion_update").val());
                            datos.append('cat_id', $(".mat_categoria_update").val());
                            datos.append('mat_vida_util', $("#mat_vida_util_update").val());
                            datos.append('mat_depreciacion', $("#mat_depreciacion_update").val());
                            // for (const [key, value] of datos) {
                            //     console.log(key, '- '+value);
                            // };
    
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
                    }
                });
            }else{
                if ($("#mat_nombre_update").val() == '' || $("#mat_categoria_update").val() == '' || $("#mat_categoria").val() == null || $("#mat_vida_util_update").val() == "" || $("#mat_depreciacion_update").val() == "") {
                    let vacio = '';
                    if ($("#mat_nombre_update").val() == '') {
                        vacio = 'NOMBRE';
                    }else if ($("#mat_categoria_update").val() == '') {
                        vacio = 'CATEGORIA';
                    }else if ($("#mat_categoria_update").val() == null) {
                        vacio = 'CATEGORIA';
                    }else if ($("#mat_categoria_update").find(":selected").text().toUpperCase().includes("EQUIPO") && $("#mat_vida_util_update").val() == "") {
                        vacio = 'VIDA UTIL';
                    }else if ($("#mat_categoria_update").find(":selected").text().toUpperCase().includes("EQUIPO") && $("#mat_depreciacion_update").val() == "") {
                        vacio = 'DEPRECIACION';
                    }
                    Swal.fire({
                        title: 'Error!',
                        text: 'El campo ' + vacio + ' es requerido',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $("#mat_nombre_update").trigger('focus');
                }else{
                    var datos = new FormData();
                    //datos.append('mat_cod', $(".mat_cod_update").val());
                    datos.append('mat_nombre', $(".mat_nombre_update").val());
                    datos.append('mat_descripcion', $(".mat_descripcion_update").val());
                    datos.append('cat_id', $(".mat_categoria_update").val());
                    datos.append('mat_vida_util', $("#mat_vida_util_update").val());
                    datos.append('mat_depreciacion', $("#mat_depreciacion_update").val());
                    datos.append('mat_imagen', imagenFile);
                    
                    // for (const [key, value] of datos) {
                    //     console.log(key, '- '+value);
                    // };
    
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
            }
        });

        $("#btnCloseAddCompra").on('click', function() {
            $(".formulario_comprar_material").trigger('reset');
        });

        $("#modal_abastecer_material").on('shown.bs.modal', function() {
            $(".mat_cantidad_abastecer").trigger('focus');
        });

        function getTablaComprasMaterial(id) {
            $.ajax({
                url: '{{ route("getAllComprasMaterial", ":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.length != 0) {
                        $('.tabla_compra_material tbody').empty();
                        $.each(data, function(index, value) {
                            $('.tabla_compra_material tbody').append(
                                '<tr><td>' + value.id + '</td>'+
                                    '<td>' + value.comp_cantidad + '</td>'+
                                    '<td>' + value.unidad + '</td>'+
                                    '<td class="text-right">' + value.comp_precio_compra + '</td>'+
                                    '<td class="text-right">' + value.comp_precio_unitario + '</td>'+
                                    '<td class="text-center">' + value.vencimiento + '</td>'+
                                    '<td class="text-center">'+
                                        '<span class="badge rounded-pill ' + (value.comp_estado == 1 ? 'badge-success">EN USO</span>' : value.comp_estado == 2 ? 'badge-warning text-dark">EN ESPERA</span>' : value.comp_estado == 3 ? 'badge-secondary">EN RESERVA</span>' : value.comp_estado == '4' ? 'badge-primary">AGOTADO</span>' : 'badge-danger">VENCIDO</span>') +
                                    '</td>'+
                                    '<td>'+
                                        '<div class="btn-group" role="group" aria-label="Button group">'+
                                        (value.comp_estado == 3 ? '<button data-toggle="modal" data-target="#modal_editar_compra" class="btn btn-sm btn-outline-warning btnEditarCompra" title="Editar Compra"><i class="fas fa-edit"></i></button>'+
                                                                  '<button data-id="' + value.id + '" data-route="{{ route("compra.delete", ":id") }}" class="btn btn-sm btn-outline-danger btnEliminarCompra" title="Eliminar Compra"><i class="fas fa-trash-alt"></i></button>' : '')+
                                        '</div>'+
                                    '</td>'+
                                '</tr>'
                            );
                        });
                    }else {
                        $('.tabla_compra_material tbody').empty().append('<td colspan="7" class="text-center">No hay datos recepcionados</td>');
                    }
                }
            });
        }

        $(document).on('click', '.btnAbastecerMaterial', function() {
            var id = $(this).closest('tr').find('td:eq(0)').text();
            let categoria = $(this).closest("tr").find("td:eq(3)").text().toUpperCase();
            if (categoria.includes("EQUIPO") ) {
                $(".equipo").prop('hidden', false);
                $(".otros").prop('hidden', true);
            }else{
                $(".equipo").prop('hidden', true);
                $(".otros").prop('hidden', false);
            }
            getMaterial(id).then(function(data) {
                $(".mat_id_abastecer").val(data.id);
                $(".modal_abastecer_materialLabel").text('Abastecer Material: '+ data.mat_nombre);
                if (data.umed_id != null) {
                    $(".mat_unidad_abastecer").val(data.umed_id);
                    $(".mat_unidad_abastecer_equipo").val(data.umed_id);
                }else {
                    var optionElement = $(".mat_unidad_abastecer_equipo").find("option:contains('%')");
                    if (optionElement.length > 0) {
                        optionElement.prop("selected", true);
                    }
                }
                $(".mat_vida_util_abastecer_equipo").val(data.mat_vida_util);
                $(".mat_depreciacion_abastecer_equipo").val(data.mat_depreciacion);
            });
            mostrarCargando();
            setTimeout(function(){
                updateVencimientoCompra($(".mat_id_abastecer").val());
                getTablaComprasMaterial($(".mat_id_abastecer").val());
                cerrarCargando();
            }, 500);
        });

        function updateCompEstado(id) {
            $.ajax({
                url: '{{ route("updateCompEstado", ":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    //console.log(response);
                }
            });
        }

        function updateVencimientoCompra(id) {
            $.ajax({
                url: '{{ route("updateVencimientoCompra", ":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log('hecho');
                }
            });
        }

        function registrarCompra(datos, mat_id) {
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
                            $(".formulario_comprar_material").trigger('reset');
                            updateVencimientoCompra(mat_id);
                            updateCompEstado(mat_id);
                            setTimeout(function(){
                                getTablaComprasMaterial(mat_id);
                            }, 500);
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
        $(document).on('click', '.btnRegistrarCompra', function(event) {
            event.preventDefault();
            if ($(".equipo").prop('hidden') === true) {
                if ($(".mat_cod_compra_abastecer").val() == "" || $(".mat_unidad_abastecer").val() == "" || $(".mat_cantidad_abastecer").val() == "" || $(".mat_cantidad_abastecer").val() == 0 || $(".mat_precio_compra_abastecer").val() ==  "" || $(".mat_precio_compra_abastecer").val() == 0 || $(".mat_fecha_elab_abastecer").val() == "" || $(".mat_fecha_venc_abastecer").val() == "" || $(".mat_tipo_pago_abastecer").val() == "" || $(".mat_observacion_abastecer").val() == "") {
                    let vacio = '';
                    if ($("#mat_cod_compra_abastecer").val() == '') {
                        vacio = 'CODIGO';
                    }else if ($("#mat_unidad_abastecer").val() == '') {
                        vacio = 'UNIDAD';
                    }else if ($("#mat_cantidad_abastecer").val() == "" || $(".mat_cantidad_abastecer").val() == 0) {
                        vacio = 'CANTIDAD';
                    }else if ($("#mat_precio_compra_abastecer").val() == "" || $(".mat_precio_compra_abastecer").val() == 0) {
                        vacio = 'PRECIO DE COMPRA';
                    }else if ($("#mat_fecha_elab_abastecer").val() == "") {
                        vacio = 'FECHA ELABORACION';
                    }else if ($("#mat_fecha_venc_abastecer").val() == "") {
                        vacio = 'FECHA VENCIMIENTO';
                    }else if ($("#mat_tipo_pago_abastecer").val() == "") {
                        vacio = 'TIPO PAGO';
                    }else if ($("#mat_observacion_abastecer").val() == "") {
                        vacio = 'OBSERVACION';
                    }
                    Swal.fire({
                        title: 'Error!',
                        text: 'El campo ' + vacio + ' es requerido',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    
                }else{
                    var mat_id = $(".mat_id_abastecer").val();
                    var datos = new FormData();
                    datos.append('mat_id', mat_id);
                    datos.append('comp_codigo', $("#mat_cod_compra_abastecer").val());
                    datos.append('comp_elaboracion', $("#mat_fecha_elab_abastecer").val());
                    datos.append('comp_vencimiento', $("#mat_fecha_venc_abastecer").val());
                    datos.append('umed_id', $("#mat_unidad_abastecer").val());
                    datos.append('comp_cantidad', $("#mat_cantidad_abastecer").val());
                    datos.append('comp_precio_compra', $("#mat_precio_compra_abastecer").val());
                    datos.append('comp_precio_unitario', $("#mat_precio_unitario_abastecer").val());
                    datos.append('comp_tipo', $("#mat_tipo_pago_abastecer").val());
                    datos.append('prov_id', $("#mat_proveedor_abastecer").val());
                    datos.append('comp_observacion', $("#mat_observacion_abastecer").val());
                    datos.append('comp_ventas', '0');
                    datos.append('comp_estado', '3');
                    
                    registrarCompra(datos, mat_id);
                }
            }else{
                if ($(".mat_cod_compra_abastecer_equipo").val() == "" || $(".mat_precio_compra_abastecer_equipo").val() ==  "" || $(".mat_precio_compra_abastecer_equipo").val() == 0 || $(".mat_tipo_pago_abastecer").val() == "" || $(".mat_observacion_abastecer").val() == "") {
                    let vacio = '';
                    if ($("#mat_cod_compra_abastecer_equipo").val() == '') {
                        vacio = 'CODIGO';
                    }else if ($("#mat_precio_compra_abastece_equipo").val() == "" || $(".mat_precio_compra_abastecer_equipo").val() == 0) {
                        vacio = 'PRECIO DE COMPRA';
                    }else if ($("#mat_tipo_pago_abastecer").val() == "") {
                        vacio = 'TIPO PAGO';
                    }else if ($("#mat_observacion_abastecer").val() == "") {
                        vacio = 'OBSERVACION';
                    }
                    Swal.fire({
                        title: 'Error!',
                        text: 'El campo ' + vacio + ' es requerido',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    
                }else{
                    var mat_id = $(".mat_id_abastecer").val();
                    let fechaHoy = new Date();
                    let vidaUtil = parseInt($(".mat_vida_util_abastecer_equipo").val(), 10);
                    let fechaVencimiento = new Date(fechaHoy);
                    fechaVencimiento.setFullYear(fechaHoy.getFullYear() + vidaUtil);
                    var fechaElaboracionFormatted = fechaHoy.toISOString().slice(0, 10);
                    var fechaVencimientoFormatted = fechaVencimiento.toISOString().slice(0, 10);
                    var datos = new FormData();
                    datos.append('mat_id', mat_id);
                    datos.append('comp_codigo', $("#mat_cod_compra_abastecer_equipo").val());
                    datos.append('comp_elaboracion', fechaElaboracionFormatted);
                    datos.append('comp_vencimiento', fechaVencimientoFormatted);
                    datos.append('comp_vida_util', $(".mat_vida_util_abastecer_equipo").val());
                    datos.append('comp_depreciacion', $(".mat_depreciacion_abastecer_equipo").val());
                    datos.append('umed_id', $("#mat_unidad_abastecer_equipo").val());
                    datos.append('comp_cantidad', 100);
                    datos.append('comp_precio_compra', $("#mat_precio_compra_abastecer_equipo").val());
                    datos.append('comp_precio_unitario', $("#mat_precio_unitario_abastecer_equipo").val());
                    datos.append('comp_tipo', $("#mat_tipo_pago_abastecer").val());
                    datos.append('prov_id', $("#mat_proveedor_abastecer").val());
                    datos.append('comp_observacion', $("#mat_observacion_abastecer").val());
                    datos.append('comp_ventas', '0');
                    datos.append('comp_estado', '3');
                    
                    // for (const [key, value] of datos) {
                    //     console.log(key, '- '+value);
                    // };
                    registrarCompra(datos, mat_id);
                }
            }
        });

        $(document).on('click', '.btnEditarCompra', function() {
            let comp_id = $(this).closest("tr").find("td:eq(0)").text();
            $(".mat_id_abastecer_update").val($(".mat_id_abastecer").val());
            $(".comp_id_update").val(comp_id);
            mostrarCargando();
            getCompra(comp_id).then(function(data) {
                if (Object.keys(data).length !== 0) {
                    $(".mat_cod_compra_abastecer_update").val(data.comp_codigo);
                    if (data.comp_vida_util != null) {
                        $(".compVidaUtil").prop('hidden', false);
                        $(".mat_vida_util_abastecer_equipo_update").val(data.comp_vida_util);
                        $(".compDepreciacion").prop('hidden', false);
                        $(".mat_depreciacion_abastecer_equipo_update").val(data.comp_depreciacion);
                        $(".mat_unidad_abastecer_update").prop('disabled', true);
                        $(".mat_cantidad_abastecer_update").prop('readonly', true);
                        $(".mat_fecha_elab_abastecer_update").prop('readonly', true);
                        $(".mat_fecha_venc_abastecer_update").prop('readonly', true);
                    }else{
                        $(".compVidaUtil").prop('hidden', true);
                        $(".mat_vida_util_abastecer_equipo_update").val("");
                        $(".compDepreciacion").prop('hidden', true);
                        $(".mat_depreciacion_abastecer_equipo_update").val("");
                        $(".mat_unidad_abastecer_update").prop('disabled', false);
                        $(".mat_cantidad_abastecer_update").prop('readonly', false);
                        $(".mat_fecha_elab_abastecer_update").prop('readonly', false);
                        $(".mat_fecha_venc_abastecer_update").prop('readonly', false);
                    }
                    $(".mat_unidad_abastecer_update").val(data.umed_id);
                    $(".mat_cantidad_abastecer_update").val(data.comp_cantidad);
                    $(".mat_precio_compra_abastecer_update").val(data.comp_precio_compra);
                    $(".mat_precio_unitario_abastecer_update").val(data.comp_precio_unitario);
                    
                    const fechaElaboracion = new Date(data.comp_elaboracion);
                    const fechaVencimiento = new Date(data.comp_vencimiento);

                    const formattedFechaElaboracion = fechaElaboracion.toISOString().split('T')[0];
                    const formattedFechaVencimiento = fechaVencimiento.toISOString().split('T')[0];
                    $(".mat_fecha_elab_abastecer_update").val(formattedFechaElaboracion);
                    $(".mat_fecha_venc_abastecer_update").val(formattedFechaVencimiento);
                    $(".mat_tipo_pago_abastecer_update").val(data.comp_tipo);
                    $(".mat_proveedor_abastecer_update").val(data.prov_id);
                    $(".mat_observacion_abastecer_update").val(data.comp_observacion);
                    cerrarCargando();
                }
            });
        });

        function updateCompra(datos, comp_id, mat_id) {
            Swal.fire({
                title: 'Actualizar Compra',
                text: '¿Estan correcto los datos?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#40CC6C',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, actualizar!',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("compra.update", ":id") }}'.replace(":id", comp_id),
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
                                text: 'Datos actualizados correctamente',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            updateVencimientoCompra(mat_id);
                            updateCompEstado(mat_id);
                            setTimeout(function(){
                                getTablaComprasMaterial(mat_id);
                            }, 500);
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
        $(document).on('click', '.btnUpdateCompra', function(e) {
            e.preventDefault();
            var comp_id = $('.comp_id_update').val();
            if ($(".mat_depreciacion_abastecer_equipo_update").val() == "") {
                if ($(".mat_cod_compra_abastecer_update").val() == "" || $(".mat_unidad_abastecer_update").val() == "" || $(".mat_cantidad_abastecer_update").val() == 0 || $(".mat_fecha_elab_abastecer_update").val() == "" || $(".mat_fecha_venc_abastecer_update").val() == "" || $(".mat_precio_compra_abastecer_update").val() ==  "" || $(".mat_precio_compra_abastecer_update").val() == 0 || $(".mat_tipo_pago_abastecer_update").val() == "" || $(".mat_observacion_abastecer_update").val() == "") {
                    let vacio = '';
                    if ($(".mat_cod_compra_abastecer_update").val() == '') {
                        vacio = 'CODIGO';
                    }else if ($(".mat_unidad_abastecer_update").val() == "") {
                        vacio = 'UNIDAD';
                    }else if ($(".mat_cantidad_abastecer_update").val() == "") {
                        vacio = 'CANTIDAD';
                    }else if ($(".mat_fecha_elab_abastecer_update").val() == "") {
                        vacio = 'FECHA ELABORACION';
                    }else if ($("#mat_fecha_venc_abastecer_update").val() == "") {
                        vacio = 'FECHA VENCIMIENTO';
                    }else if ($(".mat_precio_compra_abastecer_update").val() == "" || $(".mat_precio_compra_abastecer_update").val() == 0) {
                        vacio = 'PRECIO DE COMPRA';
                    }else if ($(".mat_tipo_pago_abastecer_update").val() == "") {
                        vacio = 'TIPO PAGO';
                    }else if ($(".mat_observacion_abastecer_update").val() == "") {
                        vacio = 'OBSERVACION';
                    }
                    Swal.fire({
                        title: 'Error!',
                        text: 'El campo ' + vacio + ' es requerido',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }else{
                    var mat_id = $(".mat_id_abastecer_update").val();
                    
                    var datos = new FormData();
                    datos.append('comp_codigo_update', $(".mat_cod_compra_abastecer_update").val());
                    datos.append('comp_fecha_elaboracion_update', $(".mat_fecha_elab_abastecer_update").val());
                    datos.append('comp_fecha_vencimiento_update', $(".mat_fecha_venc_abastecer_update").val());
                    datos.append('umed_id_update', $(".mat_unidad_abastecer_update").val());
                    datos.append('comp_cantidad_update', $(".mat_cantidad_abastecer_update").val());
                    datos.append('comp_precio_compra_update', $(".mat_precio_compra_abastecer_update").val());
                    datos.append('comp_precio_unitario_update', $(".mat_precio_unitario_abastecer_update").val());
                    datos.append('comp_tipo_update', $(".mat_tipo_pago_abastecer_update").val());
                    datos.append('prov_id_update', $(".mat_proveedor_abastecer_update").val());
                    datos.append('comp_observacion_update', $(".mat_observacion_abastecer_update").val());
    
                    updateCompra(datos, comp_id, mat_id);
                }
            }else{
                if ($(".mat_cod_compra_abastecer_update").val() == "" || $(".mat_precio_compra_abastecer_update").val() ==  "" || $(".mat_precio_compra_abastecer_update").val() == 0 || $(".mat_tipo_pago_abastecer_update").val() == "" || $(".mat_observacion_abastecer_update").val() == "") {
                    let vacio = '';
                    if ($(".mat_cod_compra_abastecer_update").val() == '') {
                        vacio = 'CODIGO';
                    }else if ($(".mat_precio_compra_abastecer_update").val() == "" || $(".mat_precio_compra_abastecer_update").val() == 0) {
                        vacio = 'PRECIO DE COMPRA';
                    }else if ($(".mat_tipo_pago_abastecer_update").val() == "") {
                        vacio = 'TIPO PAGO';
                    }else if ($(".mat_observacion_abastecer_update").val() == "") {
                        vacio = 'OBSERVACION';
                    }
                    Swal.fire({
                        title: 'Error!',
                        text: 'El campo ' + vacio + ' es requerido',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }else{
                    var mat_id = $(".mat_id_abastecer_update").val();
                    
                    var datos = new FormData();
                    datos.append('comp_codigo_update', $(".mat_cod_compra_abastecer_update").val());
                    datos.append('comp_fecha_elaboracion_update', $(".mat_fecha_elab_abastecer_update").val());
                    datos.append('comp_fecha_vencimiento_update', $(".mat_fecha_venc_abastecer_update").val());
                    datos.append('umed_id_update', $(".mat_unidad_abastecer_update").val());
                    datos.append('comp_cantidad_update', $(".mat_cantidad_abastecer_update").val());
                    datos.append('comp_precio_compra_update', $(".mat_precio_compra_abastecer_update").val());
                    datos.append('comp_precio_unitario_update', $(".mat_precio_unitario_abastecer_update").val());
                    datos.append('comp_tipo_update', $(".mat_tipo_pago_abastecer_update").val());
                    datos.append('prov_id_update', $(".mat_proveedor_abastecer_update").val());
                    datos.append('comp_observacion_update', $(".mat_observacion_abastecer_update").val());
    
                    updateCompra(datos, comp_id, mat_id);
                }
            }
        });

        $(document).on('click', '.btnEliminarCompra', function(e) {
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
                        url: route.replace(":id", id),
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire({
                                title: '¡Eliminado!',
                                text: response.success,
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            }).then((result)=>{
                                if (result.isConfirmed) {
                                    let mat_id = $(".mat_id_abastecer").val();
                                    getTablaComprasMaterial(mat_id);
                                }
                            });
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Error',
                                text: 'No se pudo realizar la operación.',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    });
                }
            })
        });

        function getComprasMaterial(id) {
            mostrarCargando();
            $.ajax({
                url: '{{ route("getComprasMaterial", ":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.length != 0) {
                        $('.tabla_compras_realizadas tbody').empty();
                        $.each(data, function(index, value) {
                            $('.tabla_compras_realizadas tbody').append(
                                '<tr class="' + ((value.comp_estado == '1' && value.comp_ventas < value.comp_cantidad) ? 'table-success' : (value.comp_estado == '1' && value.comp_ventas == value.comp_cantidad) ? 'table-danger' : (value.comp_estado == '2' ? 'table-warning' : '')) + '"><td>' + value.id + '</td>'+
                                    '<td>' + value.unidad + '</td>'+
                                    '<td hidden>' + value.umed_id + '</td>'+
                                    '<td>' + value.comp_cantidad + '</td>'+
                                    '<td>' + value.comp_precio_compra + '</td>'+
                                    '<td>' + value.comp_precio_unitario + '</td>'+
                                    '<td>' + value.vencimiento + '</td>'+
                                    '<td class="text-center">'+
                                        '<a data-toggle="modal" data-target="#modal_config_parametro" class="btn btn-sm ' + ((value.comp_estado == '1' && value.comp_ventas < value.comp_cantidad) ? 'btn-outline-success btn-use-compra' : (value.comp_estado == '1' && value.comp_ventas == value.comp_cantidad) ? 'btn-outline-danger btn-empty-compra' : (value.comp_estado == '2' ? 'btn-outline-warning btn-wait-compra' : 'btn-outline-secondary btn-reserved-compra')) + ' " ' + ((value.comp_estado == '1' && value.comp_ventas < value.comp_cantidad) ? 'title="En uso"' : (value.comp_estado == '1' && value.comp_ventas == value.comp_cantidad) ? 'title="Agotado"' : (value.comp_estado == '2' ? 'title="Usar Compra"' : 'title="En Reserva"') ) + ' >'+
                                            ((value.comp_estado == '1' && value.comp_ventas < value.comp_cantidad )? '<i class="fas fa-check-circle"></i>' : (value.comp_estado == '1' && value.comp_ventas == value.comp_cantidad) ? '<i class="fas fa-times-circle fa-lg"></i>' : (value.comp_estado == '2' ? '<i class="fas fa-plus-circle fa-lg"></i>' : '<i class="fas fa-pause fa-sm"></i>')) + 
                                        '</a>'+
                                    '</td>'+
                                '</tr>'
                            );
                        });
                    }else {
                        $('.tabla_compras_realizadas tbody').empty().append('<td colspan="7" class="text-center">No hay datos recepcionados</td>');
                    }
                    cerrarCargando();
                }
            });
        }

        function VerModal(id) {
            getMaterial(id).then(function(data) {
                $(".modal_ver_materialLabel").text('Datos de Material: '+data.mat_nombre);
                if (data.mat_imagen == null) {
                    $(".show_img_material").attr('src', '{{ asset('dist/img/default.png') }}');
                }else{
                    $(".show_img_material").attr('src', data.mat_imagen);
                }
                $(".show_mat_id").val(data.id);
                //$(".show_mat_cod").val(data.mat_cod);
                $(".show_mat_categoria").val(data.cat_id);
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
                        $('.tabla_compra_actual tbody').empty().append('<td colspan="5" class="text-center empty-file">No hay datos recepcionados</td>');
                    }
                });
            });
        }
        
        $(document).on('click', '.btnVerMaterial', function() {
            var id = $(this).closest('tr').find('td:eq(0)').text();
            VerModal(id);
            getComprasMaterial(id);
            updateVencimientoCompra(id);
        });

        function updateMaterialCompra(id, datos) {
            $.ajax({
                url: '{{ route("updateMaterialCompra", ":id") }}'.replace(":id", id),
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
                    VerModal(id);
                    updateCompEstado(id);
                    updateVencimientoCompra(id);
                    getComprasMaterial(id);
                    setTimeout(function(){
                        //setTimeout(function(){
                            window.location.href = '{{ route('material') }}';
                        //}, 1000);
                    }, 1000);
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

        $(document).on('click', '.btn-wait-compra', function() {
            var cant_ventas = $(".tabla_compra_actual tbody tr").find('td:eq(4)').text();
            if (cant_ventas == '0' || cant_ventas == '' ) {
                var id = $(".show_mat_id").val();
                var comp_id = $(this).closest('tr').find('td:eq(0)').text();
                var unidad = $(this).closest('tr').find('td:eq(2)').text();
                var mat_cantidad = $(this).closest('tr').find('td:eq(3)').text();
                var mat_precio_compra = $(this).closest('tr').find('td:eq(4)').text();
                var mat_precio_unitario = $(this).closest('tr').find('td:eq(5)').text();
                
                var datos = new FormData();
                datos.append('comp_id', comp_id);
                datos.append('umed_id', unidad);
                datos.append('mat_cantidad', mat_cantidad);
                datos.append('mat_precio_compra', mat_precio_compra);
                datos.append('mat_precio_unitario', mat_precio_unitario);
                updateMaterialCompra(id, datos); 
            }else{
                Swal.fire({
                    title: 'Oops...',
                    text: 'No puedes usar esta compra, aun tienes en stock',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        })
        

    });
</script>