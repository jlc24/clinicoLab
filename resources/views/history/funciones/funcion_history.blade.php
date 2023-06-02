<script>
    $(document).ready(function() {
        

        function getTablaHistoryRecepcion(ruta) {
            mostrarCargando();
            $.ajax({
                url: ruta,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data.length != 0) {
                        $('.tabla-historial-recepcion tbody').empty();
                        $.each(data, function(index, value) {
                            $('.tabla-historial-recepcion tbody').append(
                                '<tr>'+
                                    '<td style="vertical-align: middle;" hidden>'+ value.rec_id +'</td>'+
                                    '<td style="vertical-align: middle;">'+ value.fecha +'</td>'+
                                    '<td style="vertical-align: middle;">'+ value.nombre +'</td>'+
                                    '<td style="vertical-align: middle;">'+ value.est_nombre +'</td>'+
                                    '<td style="vertical-align: middle;">'+ value.est_cod +'</td>'+
                                    '<td style="vertical-align: middle;"><span class="badge ' + (value.estado == 'PENDIENTE' ? 'badge-danger' : 'badge-success') + '">'+ value.estado +'</span></td>'+
                                    '<td class="text-center" style="vertical-align: middle;">'+
                                        '<button data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-outline-warning btn-notificar-recepcion" title="Notificar" ' + (value.estado == 'PENDIENTE' ? '' : 'hidden') + '><i class="fas fa-message"></i></button>'+
                                    '</td>'+
                                '</tr>'
                            );
                        });
                    }else {
                        $('.tabla-historial-recepcion tbody').empty().append('<td colspan="7" class="text-center fila_vacia">No hay datos recepcionados</td>');
                    }
                    cerrarCargando();
                }
            });
        }
        $("#filtrar_fecha").on('change', function() {
            var fecha = $(this).val();
            var estudio = $("#filtrar_estudio").val();
            var caja = $("#filtrar_caja").val();
            var usuario = $("#filtrar_usuario").val();
            getTablaHistoryRecepcion('/historyRecepcion/?f=' + fecha + '&e=' + estudio + '&c=' + caja + '&u=' + usuario);
        });

        $("#filtrar_estudio").on('change', function() {
            var fecha = $("#filtrar_fecha").val();
            var estudio = $(this).val();
            var caja = $("#filtrar_caja").val();
            var usuario = $("#filtrar_usuario").val();
            getTablaHistoryRecepcion('/historyRecepcion/?f=' + fecha + '&e=' + estudio + '&c=' + caja + '&u=' + usuario);
        });

        $("#filtrar_caja").on('change', function() {
            var fecha = $("#filtrar_fecha").val();
            var estudio = $("#filtrar_estudio").val();
            var caja = $(this).val();
            var usuario = $("#filtrar_usuario").val();
            getTablaHistoryRecepcion('/historyRecepcion/?f=' + fecha + '&e=' + estudio + '&c=' + caja + '&u=' + usuario);
        });

        $("#filtrar_usuario").on('change', function() {
            var fecha = $("#filtrar_fecha").val();
            var estudio = $("#filtrar_estudio").val();
            var caja = $("#filtrar_caja").val();
            var usuario = $(this).val();
            getTablaHistoryRecepcion('/historyRecepcion/?f=' + fecha + '&e=' + estudio + '&c=' + caja + '&u=' + usuario);
        });

        
    });
</script>