<script type="text/javascript">
    $(document).ready(function(){

        $("#modal_crear_categoria").on('shown.bs.modal', function() {
            $("#cat_nombre").trigger('focus');
        });
        $("#modal_actualizar_categoria").on('shown.bs.modal', function() {
            $("#cat_nombre_update").trigger('focus');
        });
        $("#btnCloseAddCategoria").on('click', function() {
            $("#formulario_crear_categorias").trigger('reset');
        });

        $("#tabla_categorias").dataTable({
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

        $("#btnRegisterCat").on('click', function() {
            var nombre = $(".cat_nombre").val();
            var patron = /^[a-zA-Z0-9\s]+$/;
            if (patron.test(nombre)) {
                var datos = new FormData();
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
                        //setTimeout(function(){
                            window.location.href = '{{ route('categoria') }}';
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
        })

        function getCategoria(id) {
            $.ajax({
                url: '{{ route("categoria.edit", ":id") }}'.replace(":id", id),
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data.nombre);
                    $(".cat_id").val(data.id);
                    $(".cat_nombre_update").val(data.nombre);
                }
            });
        }

        $(document).on('click', '.btnEditarCategoria', function() {
            var id = $(this).closest('tr').find('td:eq(0)').text();
            getCategoria(id);
        });

        $("#btnUpdateCat").on('click', function() {
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
                        setTimeout(function(){
                            window.location.href = '{{ route('categoria') }}';
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

        $(document).on('click', '.btn-delete-categoria', function() {
            var id = $(this).closest('tr').find('td:eq(0)').text();
            $.ajax({
                url: '{{ route("categoria.destroy", ":id") }}'.replace(":id", id),
                type: "DELETE",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function (response) {
                    Swal.fire({
                        title: 'Hecho',
                        text: 'Dato eliminado',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    setTimeout(function(){
                        window.location.href = '{{ route('categoria') }}';
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
        });
        
    });
</script>