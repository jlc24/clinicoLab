<script>
    $(document).ready(function() {

        $('#confirmPassword').on('shown.bs.modal', function () {
            $('#password').trigger('focus');
        });

        $("#btnCloseConfirmPass").on('click', function() {
            $("#form_comfirmar_pass").trigger("reset");
        });
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

        $(document).on('click', '.btn-generate-factura', function() {
            var fac_id = $(this).closest('tr').find('td:eq(0)').text();
            $(".rec_id").val(fac_id);
        });

        $(document).on('click', '.btnClosePdfGenerate', function() {
            var pdfFrame = document.querySelector('.pdfFrame');
            pdfFrame.src = "";
        });

        $('#form_comfirmar_pass').on('submit', function(e) {
            e.preventDefault(); // evita el comportamiento predeterminado del formulario
            if ($("#password").val().length >= 8) {
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Contraseña verificada!!!',
                                text: 'La contraseña coincide con la registrada',
                                icon: 'success',
                                showConfirmButton: false,
                                //allowOutsideClick: false,
                                timer: 2000
                            });
                            setTimeout(function() {
                                mostrarCargando();
                                $.ajax({
                                    url: '{{ route("getRutaFacturaCliente", ":id") }}'.replace(":id", $(".rec_id").val()),
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(data) {
                                        if (data.rec_ruta_file !== null) {
                                            cerrarCargando();
                                            Swal.fire({
                                                title: 'Documento generado',
                                                text: 'El archivo digital ya se encuentra generado.',
                                                icon: 'info',
                                                showConfirmButton: false,
                                                timer: 2000
                                            });
                                            setTimeout(() => {
                                                window.location.href = '{{ route('factura') }}';
                                            }, 2000);
                                        }else{
                                            $.ajax({
                                                url: '{{ route("factura.pdf", ":id") }}'.replace(":id", $(".rec_id").val()),
                                                type: 'GET',
                                                success: function(response) {
                                                    cerrarCargando();
                                                    Swal.fire({
                                                        title: 'Documento generado',
                                                        text: 'El archivo digital se generó con éxito, ya puede ver e imprimir.',
                                                        icon: 'success',
                                                        showConfirmButton: false,
                                                        timer: 2000
                                                    });
                                                    setTimeout(() => {
                                                        window.location.href = '{{ route('resultado') }}';
                                                    }, 2000);
                                                },
                                                error: function(response) {
                                                    cerrarCargando();
                                                    Swal.fire({
                                                        title: 'Oops...',
                                                        text: 'No se pudo generar el archivo digital, por favor comuníquese con la administración de ClinicoLab.',
                                                        icon: 'error',
                                                        showConfirmButton: false,
                                                        timer: 5000
                                                    });
                                                }
                                            });
                                        }
                                    }
                                });
                            }, 2000);
                        } else {
                            const maxIntentos = parseInt(response.maxIntentos);
                            let errorMessage = response.message;
                            if (maxIntentos < 3) {
                                errorMessage += ` Te quedan ${3 - maxIntentos} intentos.`;
                                Swal.fire({
                                    title: 'Oops...!!!',
                                    html: `${errorMessage}`,
                                    icon: 'error',
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    timer: 2000
                                });
                                $("#password").focus();
                                $("#password").val("");
                            } else {
                                errorMessage += ` Espere 60 segundos antes de volver a intentarlo.`
                                let countdown = 60;
                                const intervalId  = setInterval(() => {
                                    countdown--;
                                    const timerEl = Swal.getHtmlContainer().querySelector('#timer');
                                    if (timerEl) {
                                        timerEl.textContent = countdown;
                                    }
                                    if (countdown <= 0) {
                                        clearInterval(intervalId);
                                        Swal.close();
                                        $("#password").focus();
                                        $("#password").val("");
                                    }
                                }, 1000); 
                                // Desactivar los botones de confirmación para prevenir intentos adicionales durante el tiempo de espera
                                Swal.fire({
                                    title: 'Oops...!!!',
                                    html: `${errorMessage}<br/><span id="timer">60</span> segundos restantes.`,
                                    icon: 'error',
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
                                Swal.disableButtons();
                            }
                            
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
            }else{
                Swal.fire({
                    title: 'Oops...',
                    text: 'La longitud de la contraseña debe ser mínimo de 8 dígitos.',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
                $("#password").focus();
                $("#password").val("");
            }
        });
    });
</script>