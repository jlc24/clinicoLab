<script>
    $(document).ready(function() {
        const hoy = new Date();

        var dd = String(hoy.getDate()).padStart(2, '0');
        var mm = String(hoy.getMonth() + 1).padStart(2, '0');
        var yyyy = hoy.getFullYear();

        $("#fecha").val(dd+'/'+mm+'/'+yyyy+' - '+dd+'/'+mm+'/'+yyyy);
        //$("#fecha").val('08/05/2023 - ' +dd+'/'+mm+'/'+yyyy);
        
        $('#calendario').daterangepicker({
            ranges   : {
                'Hoy'       : [moment(), moment()],
                'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
                'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
                'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
                'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment(),
            endDate  : moment(),
            alwaysShowCalendars: true,
        }, function(start, end, label) {
            $("#fecha").val(start.format('DD/MM/YYYY')+" - "+end.format('DD/MM/YYYY'));
            let daterange = $("#fecha").val();
            
            let date = daterange.split(" - ");

            let fechaIn = date[0];
            let fechaFin = date[1];

            fechaIn = fechaIn.split("/").reverse().join("-");
            fechaFin = fechaFin.split("/").reverse().join("-");

            getReportEstudio(fechaIn, fechaFin);
        });

        var daterange = $("#fecha").val();
        var date = daterange.split(" - ");
        var fechaIn = date[0];
        var fechaFin = date[1];

        fechaIn = fechaIn.split("/").reverse().join("-");
        fechaFin = fechaFin.split("/").reverse().join("-");

        getReportEstudio(fechaIn, fechaFin);

        function getReportEstudio(inicio, fin) {
            mostrarCargando();
            $.ajax({
                url: '{{ route("getReportEstudio") }}' + '?i=' + inicio + '&f=' + fin,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.length != 0) {
                        let sumaCantidad = 0;
                        let sumaTotal = 0;
                        let sumaCantidadEquipo = 0;
                        let sumaCantidadReactivo = 0;
                        let sumaCantidadOtro = 0;
                        let sumaTotalMaterial = 0;
                        let sumaTotalEstudio = 0;

                        $(".tabla_reporte_estudios tbody").empty();
                        
                        $.each(data, function (index, value) {
                            $(".tabla_reporte_estudios tbody").append(
                                '<tr>' +
                                    '<td>' + value.est_cod + '</td>' +
                                    '<td>' + value.est_nombre + '</td>' +
                                    '<td class="text-right">' + value.cantidad + '</td>' +
                                    '<td class="text-right">' + value.total + ' Bs</td>' +
                                    '<td class="text-right">' + value.total_equipo + '</td>' +
                                    '<td class="text-right">' + value.total_reactivo + '</td>' +
                                    '<td class="text-right">' + value.total_otro + '</td>' +
                                    '<td class="text-right">' + value.total_material + ' Bs</td>' +
                                    '<td class="text-right">' + (parseFloat(value.total) - parseFloat(value.total_material)) + ' Bs</td>' +
                                '</tr>'
                            );
                            sumaCantidad += parseInt(value.cantidad);
                            sumaTotal += parseFloat(value.total);
                            sumaCantidadEquipo += parseFloat(value.total_equipo);
                            sumaCantidadReactivo += parseFloat(value.total_reactivo);
                            sumaCantidadOtro += parseFloat(value.total_otro);
                            sumaTotalMaterial += parseFloat(value.total_material);
                            sumaTotalEstudio += (parseFloat(value.total) - parseFloat(value.total_material))
                        });
                        $(".tabla_reporte_estudios tbody").append(
                            '<tr>' +
                                '<td colspan="2" class="text-center"><strong>TOTAL</strong></td>' +
                                '<td class="text-right"><strong>' + sumaCantidad + '</strong></td>' +
                                '<td class="text-right"><strong>' + sumaTotal.toFixed(2) + ' Bs</strong></td>' +
                                '<td class="text-right"><strong>' + sumaCantidadEquipo + '</strong></td>' +
                                '<td class="text-right"><strong>' + sumaCantidadReactivo + '</strong></td>' +
                                '<td class="text-right"><strong>' + sumaCantidadOtro + '</strong></td>' +
                                '<td class="text-right"><strong>' + sumaTotalMaterial.toFixed(2) + ' Bs</strong></td>' +
                                '<td class="text-right"><strong>' + sumaTotalEstudio.toFixed(2) + ' Bs</strong></td>' +
                            '</tr>'
                        );
                        
                    }else {
                        $(".tabla_reporte_estudios tbody").empty().append("<td class='text-center' colspan='9'>No hay datos</td>");
                    }
                    cerrarCargando();
                }
            });
        }
        
    });
</script>