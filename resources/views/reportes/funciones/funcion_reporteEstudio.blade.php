<script>
    $(document).ready(function() {
        const hoy = new Date();
        const mesActual = hoy.getMonth();
        const anioActual = hoy.getFullYear();

        for (let i = 1; i <= 12; i++) {
            $('#filtrar_mes').append($('<option></option>').val(i).text(obtenerNombreDelMes(i - 1)));
        }

        $('#filtrar_mes').val(mesActual + 1);

        for (let i = anioActual; i >= anioActual-5; i--) {
            $('#filtrar_anio').append($('<option></option>').val(i).text(i));
        }

        $('#filtrar_anio').val(anioActual);

        function obtenerNombreDelMes(numeroDeMes) {
            const nombresDeMes = [
                'ENE', 'FEB', 'MAR', 'ABR',
                'MAY', 'JUN', 'JUL', 'AGO',
                'SEP', 'OCT', 'NOV', 'DIC'
            ];
            return nombresDeMes[numeroDeMes];
        }

        $("#filtrar_mes").on('change', function() {
            var mes = $(this).val();
            alert(mes);
        });

        $("#filtrar_anio").on('change', function() {
            var anio = $(this).val();
            alert(anio);    
        })
    });
</script>