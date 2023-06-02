<script>
    $(document).ready(function() {
        //datatables
        $(".tabla-facturas").dataTable({
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

        $(document).on('click', '.btn-show-factura', function() {
            var fac_id = $(this).closest('tr').find('td:eq(0)').text();
            $(".exampleModalLabel").text('Factura');
            mostrarCargando();
            $.ajax({
                url: '{{ route("getRutaFacturaCliente", ":id") }}'.replace(":id", fac_id),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.fac_ruta_file !== null) {
                        var pdfFrame = document.querySelector('.pdfFrame');
                        $(document).on('shown.bs.modal', '.exampleModal', function (event) {
                            var checkPDFReadyInterval = setInterval(function() {
                                if (data.fac_ruta_file !== null) {
                                    pdfFrame.src = "{{ asset('storage') }}"+"/"+data.fac_ruta_file;
                                    clearInterval(checkPDFReadyInterval);
                                }
                                cerrarCargando();
                            }, 100);
                        });
                    }else{
                        $(document).on('shown.bs.modal', '.exampleModal', function (event) {
                            var pdfFrame = document.querySelector('.pdfFrame');
                            var checkPDFReadyInterval = setInterval(function() {
                                if (data.fac_ruta_file == null) {
                                    pdfFrame.src = "";
                                    clearInterval(checkPDFReadyInterval);
                                    cerrarCargando();
                                }
                            }, 100);
                        });
                        setTimeout(function() {
                            Swal.fire({
                                title: 'Oops...',
                                text: 'No hay documento de factura, por favor comuniquese con la administración de ClinicoLab.',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 5000
                            });
                        }, 500);
                    }
                }
            });
        });

        $(document).on('click', '.btnClosePdfGenerate', function() {
            var pdfFrame = document.querySelector('.pdfFrame');
            pdfFrame.src = "";
        });
    });
</script>