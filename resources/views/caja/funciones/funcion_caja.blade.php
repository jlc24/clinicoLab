<script type="text/javascript">
    $(document).ready(function(){
        $("#btnRegisterCaja").on('click', function(){
            event.preventDefault();
            $.ajax({
                url: '{{ route('getCajaStatus') }}',
                type: 'GET',
                success: function(data) {
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
        function getFacturasCaja(id) {
            $.ajax({
                url: '{{ route("getFacturasCaja", ":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data.length != 0) {
                        $('.tabla-facturas tbody').empty();
                        $.each(data, function(index, value) {
                            $('.tabla-facturas tbody').append(
                                '<tr>'+
                                    '<td style="vertical-align: middle;" width="50px">'+ value.id +'</td>'+
                                    '<td style="vertical-align: middle;" width="100px">'+ value.fac_pago +'</td>'+
                                    '<td style="vertical-align: middle;">'+ value.fecha +'</td>'+
                                    '<td style="vertical-align: middle;">'+ value.hora +'</td>'+
                                    '<td style="vertical-align: middle;" class="text-right">'+ value.fac_total +'</td>'+
                                    '<td style="vertical-align: middle;">Bs</td>'+
                                    
                                '</tr>'
                            );
                        });
                    }else {
                        $('.tabla-facturas tbody').empty().append('<td colspan="6" class="text-center fila_vacia">No hay datos recepcionados</td>');
                    }
                }
            });
        }

        $(document).on('click', '.btnUpdateCaja', function() {
            var caja_id = $(this).closest('tr').find('td:eq(0)').text();
            $.ajax({
                url: '{{ route("caja.show", ":id") }}'.replace(":id", caja_id),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $(".caja_administrador").val(data[0].user);
                    $(".caja_fecha_apertura").val(data[0].created_at);
                    $(".caja_cambio").text(data[0].caja_monto_inicial);
                    $(".caja_monto_cierre").text(data[0].total_factura);
                }
            });
            $(".caja_id").val(caja_id);
            getFacturasCaja(caja_id);
        });

        $(document).on('click', '.btnActualizarCaja', function() {
            var datos = new FormData();
            datos.append('caja_monto_cierre', $(".caja_monto_cierre").text());
            datos.append('caja_estado', $(".caja_estado").val());
            datos.append('caja_cambio', $(".caja_cambio").text());

            // for (const [key, value] of datos) {
            //     console.log(key, '- '+value);
            // };
            $.ajax({
                url: '{{ route("caja.update", ":id") }}'.replace(":id", $(".caja_id").val()),
                type: 'POST',
                data: datos,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    Swal.fire({
                        title: '¡Exito!',
                        text: 'Caja cerrada',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
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
    })
</script>