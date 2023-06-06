<script>
    $(document).ready(function() {
        $("#modal_crear_permiso").on('shown.bs.modal', function() {
            $("#permiso_desc").trigger('focus');
        });

        $("#btnCloseAddPermiso").on('click', function() {
            $("#formulario_crear_permisos").trigger('reset');
        });

        $("#tabla-permisos").dataTable({
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

        $(document).on('click', '.btnRegisterPermiso', function(event) {
            event.preventDefault();
            var descripcion = $(".permiso_desc").val();
            var datos = new FormData()
            datos.append('permiso', descripcion);

            $.ajax({
                url: '{{ route("permiso.store") }}',
                type: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Exito!',
                        text: 'Se guardo el dato correctamente',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000,
                    });
                    setTimeout(function(){
                        window.location.href = '{{ route('permiso') }}';
                    }, 1000);
                }
            });
        });
    });
</script>