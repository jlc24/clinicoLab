<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script>
    $('.daterange').daterangepicker({
        ranges: {
        Hoy: [moment(), moment()],
        Ayer: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Ultimos 7 dias': [moment().subtract(6, 'days'), moment()],
        'Ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
        'Este Mes': [moment().startOf('month'), moment().endOf('month')],
        'Anterior Mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
    }, function (start, end) {
        // eslint-disable-next-line no-alert
        alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    })
    // jvectormap data
    var visitorsData = {
        US: 398, // USA
        SA: 400, // Saudi Arabia
        CA: 1000, // Canada
        DE: 500, // Germany
        FR: 760, // France
        CN: 300, // China
        AU: 700, // Australia
        BR: 600, // Brazil
        IN: 800, // India
        GB: 320, // Great Britain
        RU: 3000 // Russia
    }
    // World map by jvectormap
    $('#world-map').vectorMap({
        map: 'south-america_en',
        backgroundColor: 'transparent',
        regionStyle: {
            initial: {
                fill: 'rgba(255, 255, 255, 0.7)',
                'fill-opacity': 1,
                stroke: 'rgba(0,0,0,.2)',
                'stroke-width': 1,
                'stroke-opacity': 1
            }
        },
        onRegionClick: function(element, code, region) {
            console.log(region);
        },
        onRegionLabelShow: function (e, el, code) {
            if (typeof visitorsData[code] !== 'undefined') {
                el.html(el.html() + ': ' + visitorsData[code] + ' new visitors')
            }
        }
    });
    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    $.ajax({
        url: '{{ route("estudiosRecepcionados") }}',
        type:'GET',
        dataType: 'json',
        success :function(data){
            // console.log(data);
            var estCodArray = []; //crear arreglo vacio para almacenar est_cod
            var cantidadArray = []; //crear arreglo vacio para almacenar cantidad
            data.forEach(function(item) {
                estCodArray.push(item.est_cod); //agregar est_cod al arreglo estCodArray
                cantidadArray.push(item.cantidad); //agregar cantidad al arreglo cantidadArray
            });
            // console.log(estCodArray);
            // console.log(cantidadArray);

            var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
        
            var areaChartData = {
                labels  : estCodArray,
                datasets: [
                    {
                        label               : 'Estudios Recepcionados',
                        backgroundColor     : 'rgba(60,141,18,0.9)',
                        borderColor         : 'rgba(60,141,188,0.8)',
                        pointRadius          : true,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : cantidadArray
                    },
                ]
            }
            var areaChartOptions = {
                maintainAspectRatio : false,
                responsive : true,
                legend: {
                    display: true,
                },
                scales: {
                    xAxes: [{
                        gridLines : {
                            display : false,
                        }
                    }],
                    yAxes: [{
                        gridLines : {
                            display : false,
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            new Chart(areaChartCanvas, {
                type: 'line',
                data: areaChartData,
                options: areaChartOptions
            })
        }
    });

    var areaChartData1 = {
        labels  : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio'],
        datasets: [
            {
            label               : 'Clientes',
            backgroundColor     : 'rgba(60,141,50,0.9)',
            borderColor         : 'rgba(60,14,50,0.8)',
            pointRadius          : true,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : [5, 108, 40, 50, 0, 68, 90]
            },
        ]
    }

    var areaChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
            display: true,
        },
        scales: {
            xAxes: [{
                gridLines : {
                    display : false,
                }
            }],
            yAxes: [{
                gridLines : {
                    display : false,
                }
            }]
        }
    }

    // This will get the first returned node in the jQuery collection.
    // new Chart(areaChartCanvas, {
    //     type: 'line',
    //     data: areaChartData,
    //     options: areaChartOptions
    // })
    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData1)
    lineChartData.datasets[0].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
    })
</script>