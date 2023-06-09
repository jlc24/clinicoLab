<script>
    $(document).ready(function() {
        $("#tabla_proveedores").dataTable({
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

        $("#modal_crear_proveedor").on('shown.bs.modal', function() {
            $("#prov_nombre").trigger('focus');
        });
        $("#btnCloseAddProveedor").on('click', function() {
            $("#formulario_crear_proveedores").trigger('reset');
        });

        $("#prov_empresa").change(function() {
            var emp_id = $(this).val();
            $.ajax({
                url: '{{ route("getNITEmpresa", ":id") }}'.replace(":id", emp_id),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $("#prov_nit").val(data.emp_nit);
                    $("#prov_direccion").val(data.emp_direccion)
                }
            });
        })

        $(document).on('click', '.btnRegistrarProveedor', function() {
            var patron = /^[a-zA-Z\s]+$/;
            if (patron.test($("#prov_nombre").val())) {
                var emp_id = ($("#prov_empresa").val() === null ? "" :  $("#prov_empresa").val());
                var datos = new FormData();
                datos.append('nombre', $("#prov_nombre").val());
                datos.append('emp_id', emp_id);
                datos.append('nit', $("#prov_nit").val());
                datos.append('direccion', $("#prov_direccion").val());
                datos.append('telefono', $("#prov_telefono").val());
                datos.append('email', $("#prov_email").val());
                datos.append('web', $("#prov_web").val());
                datos.append('descripcion', $("#prov_descripcion").val());
                datos.append('notas', $("#prov_notas").val());

                $.ajax({
                    url: '{{ route("provider.store") }}',
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
                            window.location.href = '{{ route('provider') }}';
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
                    text: 'Caracteres no permitidos, revise por favor',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
                $("#prov_nombre").focus();
            }
        })
    })
</script>