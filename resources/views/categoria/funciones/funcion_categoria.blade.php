<script type="text/javascript">
    $(document).ready(function(){
        filtroTabla('#search_categorias', '#tabla_categorias');

        $("#modal_crear_categoria").on('shown.bs.modal', function() {
            $("#cat_nombre").trigger('focus');
        });
        $("#modal_actualizar_categoria").on('shown.bs.modal', function() {
            $("#cat_nombre_update").trigger('focus');
        });
        $("#btnCloseAddCategoria").on('click', function() {
            $("#formulario_crear_categorias").trigger('reset');
        });
        function getCategorias() {
            $.ajax({
                url: '{{ route("getCategorias") }}',
                type: 'GET',
                dataType: 'json',
                success: (data) => {
                    if (data.length != 0) {
                        $("#tabla_categorias tbody").empty();
                        let cont = 1;
                        data.forEach((categoria) => {
                            const categoriaRow = `<tr>
                                                    <td hidden>${categoria.id}</td>
                                                    <td class="text-right"><strong>${cont++}</strong></td>
                                                    <td>${categoria.nombre}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button data-toggle="modal" data-target="#modal_actualizar_categoria" class="btn btn-sm btn-outline-warning btnEditCategoria" id="btnEditarCategoria" title="Editar Categoria"><i class="fas fa-user-edit"></i></button>
                                                            <button type="button" class="btn btn-sm btn-outline-danger btnDeleteCategoria" title="Eliminar Categoria"><i class="fas fa-trash-alt"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>`;
                            $("#tabla_categorias tbody").append(categoriaRow);
                        });
                    }else{
                        $("#tabla_categorias tbody").empty().append('<td colspan="4" class="text-center">No se encontraron datos</td>')
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
        }

        getCategorias();

        $(document).on('click', "#btnRegisterCat", (event) => {
            event.preventDefault();
            let nombre = $(".cat_nombre").val();
            let patron = /^[a-zA-Z0-9\s]+$/;
            if (patron.test(nombre)) {
                let datos = new FormData();
                datos.append('nombre', nombre);
                $.ajax({
                    url: '{{ route("categoria.store") }}',
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
                            text: 'Dato registrado correctamente',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        getCategorias();
                        $("#formulario_crear_categorias").trigger('reset');
                        $('#modal_crear_categoria .btn-close').trigger('click');
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
                    text: 'El texto contiene caracteres no válidos, ingrese solo letras y números',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
                $(".cat_nombre").val("");
                $(".cat_nombre").trigger('focus');
                $(".cat_nombre").css('border', '');
            }
        })

        $(document).on('click', '.btnEditCategoria', function() {
            var id = $(this).closest('tr').find('td:eq(0)').text();
            $.ajax({
                url: '{{ route("categoria.edit", ":id") }}'.replace(":id", id),
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data.nombre);
                    $(".cat_id").val(data.id);
                    $(".cat_nombre_update").val(data.nombre);
                    $(".cat_nombre_update").css('border', data.nombre != null ? '2px solid #40CC6C' : '');
                }
            });
        });

        $(document).on('click', '.btnUpdateCategoria', (event) => {
            event.preventDefault();
            var id = $(".cat_id").val();
            var nombre = $(".cat_nombre_update").val();
            var patron = /^[a-zA-Z0-9\s]+$/;
            if (patron.test(nombre)) {
                var datos = new FormData();
                datos.append('nombre', nombre);
                $.ajax({
                    url: '{{ route("categoria.update", ":id") }}'.replace(":id", id),
                    type: "POST",
                    data: datos,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            title: '¡Éxito!',
                            text: 'Dato modificado correctamente',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        getCategorias();
                        $('#modal_actualizar_categoria .btn-close').trigger('click');
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
                    text: 'El texto contiene caracteres no válidos, ingrese solo letras y números',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
                $(".cat_nombre").focus();
            }
        });

        $(document).on('click', '.btnDeleteCategoria', function() {
            let id = $(this).closest('tr').find('td:eq(0)').text();
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
                        url: '{{ route("categoria.destroy", ":id") }}'.replace(":id", id),
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire({
                                title: '¡Exito!',
                                text: 'Categoria Eliminada',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            getCategorias();
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
        });
    });
</script>