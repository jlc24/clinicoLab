<script>
    $(document).ready(function() {
        filtroTabla('#buscarUmedidas', '#tabla_umedidas');

        function getUmedidas() {
            mostrarCargando();
            $.ajax({
                url: '{{ route("getUmedidas") }}',
                type: 'GET',
                dataType : "json",
                success: function (data) {
                    if (data.length !== 0) {
                        $("#tabla_umedidas tbody").empty();
                        let categorias = {};
                        data.forEach((item) => {
                            if (!categorias[item.categoria]) {
                                categorias[item.categoria] = [];
                            }
                            categorias[item.categoria].push(item);
                        });
                        Object.entries(categorias).forEach(([categoria, umedidas]) => {
                            const categoriaRow = `<tr style="background-color: #D3E4F3;"><td colspan="4" class="text-left"><strong>${categoria}</strong></td></tr>`;
                            let cont = 1;
                            $("#tabla_umedidas tbody").append(categoriaRow);
                            umedidas.forEach(umedida => {
                                const umedidaRow = `<tr><td hidden>${umedida.id}</td><td class="text-right"><strong>${cont++}</strong></td><td>${umedida.nombre}</td><td class="text-center"><strong>${umedida.unidad}</strong></td><td class="text-center"><div class="btn-group" role="group" aria-label="Button group">
                                                        <buton data-toggle="modal" data-target="#modal_actualizar_medida" class="btn btn-sm btn-outline-warning btnEditUMedida"><i class="fas fa-edit"></i></buton>
                                                        <button type="button" class="btn btn-sm btn-outline-danger btnDeleteUmedidas"><i class="fas fa-trash-alt"></i></button>
                                                    </div></td></tr>`;
                                $("#tabla_umedidas tbody").append(umedidaRow);
                            });
                        });
                    }else{
                        $("#tabla_umedidas tbody").empty().append('<td colspan="4" class="text-center">No se encontraron datos</td>');
                    }
                    cerrarCargando();
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error('Error en la solicitud: ', textStatus, ', detalles: ', errorThrown);
                    Swal.fire({
                        title: 'Oops...',
                        text: 'Error en la solicitud: ' + textStatus + ', detalles: ' + errorThrown,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        }
        $("#modal_crear_medida").on("shown.bs.modal", function() {
            $("#medida_nombre").trigger('focus');
        });
        $("#modal_actualizar_medida").on("shown.bs.modal", function() {
            $("#medida_nombre_update").trigger('focus');
        });
        $("#btnCloseAddMedida").on('click', function() {
            $("#formulario_crear_medida").trigger('reset');
            $("#medida_categoria").css('border', '');
            $("#medida_nombre").css('border', '');
            $("#medida_unidad").css('border', '');
        });

        getUmedidas();

        $(document).on('keyup', '#medida_nombre', function() {
            let campo = $(this);  
            capitalize(campo);    
        });
        $(document).on('keyup', '#medida_nombre_update', function() {
            let campo = $(this);  
            capitalize(campo);    
        });

        $(document).on('click', '#btnRegisterMed', function(e) {
            e.preventDefault();
            let vacio = "";
            if ($("#medida_categoria").val() == "" || $("#medida_categoria").val() == null) {
                vacio = "CATEGORIA";
                $("#medida_categoria").trigger("focus");
                $("#medida_categoria").css('border', '1px solid #E91C2B');
            }else if ($("#medida_nombre").val() == "") {
                vacio = "NOMBRE";
                $("#medida_nombre").trigger("focus");
                $("#medida_nombre").css('border', '1px solid #E91C2B');
            }else if ($("#medida_unidad").val() == "") {
                vacio = "UNIDAD";
                $("#medida_unidad").trigger("focus");
                $("#medida_unidad").css('border', '1px solid #E91C2B');
            }
            if (vacio != "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'El campo ' + vacio + ' es requerido.',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                let datos = new FormData();
                datos.append('medida_categoria', $("#medida_categoria").val());
                datos.append('medida_nombre', $("#medida_nombre").val());
                datos.append('medida_unidad', $("#medida_unidad").val());
                $.ajax({
                    url: '{{ route("umedida.store") }}',
                    type: 'POST',
                    data: datos,
                    contentType:false,
                    processData:false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        Swal.fire({
                            title: '¡Exito!',
                            text: 'Unidad registrada',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        getUmedidas();
                        $("#formulario_crear_medida").trigger('reset');
                        $('#modal_crear_medida .btn-close').trigger('click');
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
                    }
                });
            }
        });

        $(document).on('click', '.btnEditUMedida', function() {
            let id = $(this).closest('tr').find('td:eq(0)').text();
            $.ajax({
                url: '{{ route("umedida.edit", ":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $(".medida_id_update").val(data.id);
                    $(".medida_categoria_update").val(data.categoria);
                    $(".medida_categoria_update").css('border', data.categoria !== null ? '2px solid #40CC6C' : '');
                    $(".medida_nombre_update").val(data.nombre);
                    $(".medida_nombre_update").css('border', data.nombre !== null ? '2px solid #40CC6C' : '');
                    $(".medida_unidad_update").val(data.unidad);
                    $(".medida_unidad_update").css('border', data.unidad !== null ? '2px solid #40CC6C' : '');
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
                }
            });
        });

        $(document).on('click', '.btnUpdateMedida', function() {
            let id = $(".medida_id_update").val();
            let vacio = "";
            if ($(".medida_categoria_update").val() == "" || $(".medida_categoria_update").val() == null) {
                vacio = "CATEGORIA";
                $("#medida_categoria_update").trigger("focus");
                $("#medida_categoria_update").css('border', '1px solid #E91C2B');
            }else if ($(".medida_nombre_update").val() == "") {
                vacio = "NOMBRE";
                $("#medida_nombre_update").trigger("focus");
                $("#medida_nombre_update").css('border', '1px solid #E91C2B');
            }else if ($(".medida_unidad_update").val() == "") {
                vacio = "UNIDAD";
                $("#medida_unidad_update").trigger("focus");
                $("#medida_unidad_update").css('border', '1px solid #E91C2B');
            }
            if (vacio != "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'El campo ' + vacio + ' es requerido.',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                let datos = new FormData();
                datos.append('medida_categoria_update', $(".medida_categoria_update").val());
                datos.append('medida_nombre_update', $(".medida_nombre_update").val());
                datos.append('medida_unidad_update', $(".medida_unidad_update").val());
    
                $.ajax({
                    url: '{{ route("umedida.update", ":id") }}'.replace(":id", id),
                    type: 'POST',
                    data: datos,
                    contentType:false,
                    processData:false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        Swal.fire({
                            title: '¡Exito!',
                            text: 'Unidad registrada',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        getUmedidas();
                        $('#modal_actualizar_medida .btn-close').trigger('click');
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
                    }
                });
            }
        });
        $(document).on('click', '.btnDeleteUmedidas', function(e) {
            e.preventDefault();
            var id = $(this).closest("tr").find("td:eq(0)").text();
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
                        url: '{{ route("umedida.destroy", ":id") }}'.replace(":id", id),
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Eliminado!',
                                text: 'Unidad eliminada',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            getUmedidas();
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
    });
    
</script>