<script type="text/javascript">
    $(document).ready(function() {
        filtroTabla('#buscarMetodos', '#tabla_metodologias');

        $("#modal_crear_metodologia").on("shown.bs.modal", function() {
            $("#metodo_nombre").trigger('focus');
        });
        $("#btnCloseAddMetodo").on('click', function() {
            $("#formulario_crear_metodo").trigger('reset');
            $("#metodo_nombre").css('border', '');
            $("#metodo_descripcion").css('border', '');
        });
        
        function getMetodologias() {
            $.ajax({
                url: '{{ route("getMetodologias") }}',
                type: 'GET',
                dataType: 'json',
                success: (data) => {
                    if (data.length !== 0) {
                        $(".tabla_metodologias tbody").empty();
                        let cont = 1;
                        data.forEach((metodo) => {
                            const metodoRow = `<tr>
                                                    <td hidden>${metodo.id}</td>
                                                    <td class="text-right"><strong>${cont++}</strong></td>
                                                    <td>${metodo.nombre}</td>
                                                    <td>${metodo.descripcion}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button data-toggle="modal" data-target="#modal_actualizar_metodologia" class="btn btn-sm btn-outline-warning btnEditMetodo"><i class="fas fa-edit"></i></button>
                                                            <button class="btn btn-sm btn-outline-danger btnDeleteMetodo"><i class="fas fa-trash-alt"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>`;
                            $(".tabla_metodologias tbody").append(metodoRow);
                        });
                    }else{
                        $(".tabla_metodologias tbody").empty().append('<td colspan="5" class="text-center">No se encontraron datos</td>')
                    }
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

        getMetodologias();

        $(document).on('click', '#btnRegisterMetodo', (event) => {
            event.preventDefault();
            let vacio = "";
            if ($("#metodo_nombre").val() == "") {
                vacio = "NOMBRE";
                $("#metodo_nombre").trigger("focus");
                $("#metodo_nombre").css('border', '1px solid #E91C2B');
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
                datos.append('metodo_nombre', $("#metodo_nombre").val());
                datos.append('metodo_descripcion', $("#metodo_descripcion").val());

                $.ajax({
                    url: '{{ route("metodologia.store") }}',
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
                            text: 'Metodologia registrada',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        getMetodologias();
                        $("#formulario_crear_metodo").trigger('reset');
                        $('#modal_crear_metodologia .btn-close').trigger('click');
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
        });

        $(document).on('click', '.btnEditMetodo', (event) => {
            let id = $(event.currentTarget).closest("tr").find("td:eq(0)").text();
            $.ajax({
                url: '{{ route("metodologia.edit",":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success: (data) => {
                    $(".metodo_id_update").val(data.id);
                    $(".metodo_nombre_update").val(data.nombre);
                    $(".metodo_nombre_update").css('border', data.nombre !== null ? '2px solid #40CC6C' : '');
                    $(".metodo_descripcion_update").val(data.descripcion);
                    $(".metodo_descripcion_update").css('border', data.descripcion !== null ? '2px solid #40CC6C' : '');
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
        });

        $(document).on('click', '.btnUpdateMetodo', (event) => {
            event.preventDefault();
            let vacio = "";
            if ($("#metodo_nombre_update").val() == "") {
                vacio = "NOMBRE";
                $("#metodo_nombre_update").trigger("focus");
                $("#metodo_nombre_update").css('border', '1px solid #E91C2B');
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
                datos.append('metodo_nombre_update', $("#metodo_nombre_update").val());
                datos.append('metodo_descripcion_update', $("#metodo_descripcion_update").val());

                $.ajax({
                    url: '{{ route("metodologia.update", ":id") }}'.replace(":id", $(".metodo_id_update").val()),
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
                            text: 'Metodologia actualizada',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        getMetodologias();
                        $('#modal_actualizar_metodologia .btn-close').trigger('click');
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
        });

        $(document).on('click', '.btnDeleteMetodo', (event) => {
            let id = $(event.currentTarget).closest("tr").find("td:eq(0)").text();
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
                        url: '{{ route("metodologia.destroy", ":id") }}'.replace(":id", id),
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
                            getMetodologias();
                        },
                        error: function() {
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
            })
        })

    });
</script>