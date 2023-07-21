<script>
    $(document).ready(function() {
        const hoy = new Date();

        var dd = String(hoy.getDate()).padStart(2, '0');
        var mm = String(hoy.getMonth() + 1).padStart(2, '0');
        var yyyy = hoy.getFullYear();

        $("#fecha").val(dd+'/'+mm+'/'+yyyy+' - '+dd+'/'+mm+'/'+yyyy);
        
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
            console.log(daterange);
            
            let date = daterange.split(" - ");

            let fechaIn = date[0];
            let fechaFin = date[1];

            fechaIn = fechaIn.split("/").reverse().join("-");
            fechaFin = fechaFin.split("/").reverse().join("-");

            getReportEstudio(fechaIn, fechaFin);
        });

        var daterange = $("#fecha").val();
        console.log(daterange);
        var date = daterange.split(" - ");
        var fechaIn = date[0];
        var fechaFin = date[1];

        fechaIn = fechaIn.split("/").reverse().join("-");
        fechaFin = fechaFin.split("/").reverse().join("-");

        getReportEstudio(fechaIn, fechaFin);

        function getReportEstudio(inicio, fin) {
            $.ajax({
                url: '{{ route("getReportEstudio") }}' + '?i=' + inicio + '&f=' + fin,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data.length != 0) {
                        if (data.subgrupo == null) {
                            $("#tabla_grupos").prop('hidden', false);
                            $('#tabla_grupos').empty();
                            $.each(data, function(index, value) {
                                $('#tabla_grupos').append(
                                    '<table class="table table-sm table-bordered table-hover table-responsive-sm">'+
                                        '<thead  style="background-color: #BDD7EE">'+
                                            '<th style="width: 20%">Grupo:</th>'+
                                            '<th style="width: 80%">' + value.grupo + '</th>'+
                                        '</thead>'+
                                        '<tbody>'+
                                            '<tr>'+
                                                '<td colspan="2" style="background-color: #D9D9D9">'+
                                                    '<table class="table table-sm table-bordered table-responsive-sm" style="background-color: #fff">'+
                                                        '<thead>'+
                                                            '<th style="width: 40%"></th>'+
                                                            '<th>Unidad</th>'+
                                                            '<th>Med.</th>'+
                                                            '<th>P. Unitario</th>'+
                                                            '<th>Cantidad</th>'+
                                                            '<th>P. total</th>'+
                                                            '<th></th>'+
                                                        '</thead>'+
                                                        '<tbody  id="tabla_estudios_material">'+
                                                            '<tr>'+
                                                                '<th colspan="7">Ingresos</th>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<th>' + value.est_nombre + '</th>'+
                                                                '<th class="text-right">1</th>'+
                                                                '<th></th>'+
                                                                '<th class="text-right">' + value.est_precio + '</th>'+
                                                                '<th class="text-right">' + value.cantidad + '</th>'+
                                                                '<th class="text-right">' + value.total + '</th>'+
                                                                '<th>' + value.est_moneda + '</th>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<th colspan="7">Egresos</th>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<th class="text-center" colspan="7">Materiales y/o Herramientas</th>'+
                                                            '</tr>'+
                                                                $.ajax({
                                                                    url: '{{ route("getMaterialEstudio", ":id") }}'.replace(":id", value.estudio),
                                                                    type: 'GET',
                                                                    dataType: 'json',
                                                                    success: function(estudios) {
                                                                        if (estudios.length !== 0) {
                                                                            $.each(estudios, function(index, est) {
                                                                                $("#tabla_estudios_material").append(
                                                                                    '<tr>'+
                                                                                        '<td>' + est.mat_nombre + '</td>'+
                                                                                        '<td class="text-right">' + est.cantidad + '</td>'+
                                                                                        '<td>Kg</td>'+
                                                                                        '<td class="text-right">' + est.precio_total +'</td>'+
                                                                                        '<td class="text-right">' + value.cantidad +'</td>'+
                                                                                        '<td class="text-right">' + (est.precio_total * value.cantidad) + '</td>'+
                                                                                        '<td>Bs</td>'+
                                                                                    '</tr>'
                                                                                )
                                                                            })
                                                                        }else {
                                                                            $("#tabla_estudios_material").append('<tr><td colspan="7">Sin datos</td></tr>');
                                                                        }
                                                                    }
                                                                })+
                                                            '<tr>'+
                                                                '<th colspan="5" class="text-center">Total</th>'+
                                                                '<th class="text-right">91,00</th>'+
                                                                '<th>Bs</th>'+
                                                            '</tr>'+
                                                        '</tbody>'+
                                                    '</table>'+
                                                '</td>'+
                                            '</tr>'+
                                        '</tbody>'+
                                    '</table>'
                                );
                            });
                            
                        }
                    }else {
                        $("#tabla_grupos_subgrupos").prop('hidden', true);
                        $('#tabla_grupos_subgrupos').empty();
                        $("#tabla_grupos").prop('hidden', true);
                        $("#tabla_grupos").empty();
                    }
                }
            });
        }
       
    });
</script>