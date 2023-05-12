<script type="text/javascript">
    $(document).ready(function(){
        $("#btnRegisterCaja").on('click', function(){
            event.preventDefault();
            $.ajax({
                url: '{{ route('getCajaStatus') }}',
                type: 'GET',
                success: function(data) {
                    //console.log(data);
                    if (data.caja_estado == 1) {
                        Swal.fire({
                            title: 'Caja Abierta',
                            text: 'Aun tiene caja abierta, debe cerrarla para abrir otra',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 3000
                        })
                    }else{
                        $('#formulario_crear_caja').submit();
                    }
                }
            });
        });
        $('#modal_crear_caja').on('shown.bs.modal', function () {
            $('#caja_monto_apertura').trigger('focus');
        });
        $("#tabla_cajas").dataTable({
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
    })
</script>