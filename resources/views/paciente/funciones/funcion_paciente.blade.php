<script>
    $(document).ready(function() {
        $(document).on('click', '.btn-ver-resultados', function() {
            var rec_id = $(this).closest('tr').find('td:eq(1)').text();
            $(".exampleModalLabel").text('Resultados')
            mostrarCargando();
            $.ajax({
                url: '{{ route("getRutaRecepcionCliente", ":id") }}'.replace(":id", rec_id),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $(document).on('shown.bs.modal', '.exampleModal', function (event) {
                        var pdfFrame = document.querySelector('.pdfFrame');
                        var checkPDFReadyInterval = setInterval(function() {
                            if (data.rec_ruta_file !== null) {
                                pdfFrame.src = "{{ asset('storage') }}"+"/"+data.rec_ruta_file;
                                clearInterval(checkPDFReadyInterval);
                            }
                            cerrarCargando();
                        }, 100);
                    });
                }
            });
        });

        $(document).on('click', '.btn-ver-factura', function() {
            var fac_id = $(this).closest('tr').find('td:eq(0)').text();
            $(".exampleModalLabel").text('Factura');
            mostrarCargando();
            $.ajax({
                url: '{{ route("getRutaFacturaCliente", ":id") }}'.replace(":id", fac_id),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $(document).on('shown.bs.modal', '.exampleModal', function (event) {
                        var pdfFrame = document.querySelector('.pdfFrame');
                        var checkPDFReadyInterval = setInterval(function() {
                            if (data.fac_ruta_file !== null) {
                                pdfFrame.src = "{{ asset('storage') }}"+"/"+data.fac_ruta_file;
                                clearInterval(checkPDFReadyInterval);
                            }
                            cerrarCargando();
                        }, 100);
                    });
                }
            });
        });

        $(document).on('click', '.btnClosePdfGenerate', function() {
            var pdfFrame = document.querySelector('.pdfFrame');
            pdfFrame.src = "";
        });
    });
</script>