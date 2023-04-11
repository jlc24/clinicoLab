<script type="text/javascript">
    function buscarPor() {
        const select = document.getElementById('buscar_resultado');
        const form1 = document.getElementById('form_buscar_paciente');
        const form2 = document.getElementById('form_buscar_estudio');
        const form3 = document.getElementById('form_buscar_fechas');
        // Ocultamos todos los formularios
        form1.style.display = 'none';
        form2.style.display = 'none';
        form3.style.display = 'none';

        // Mostramos el formulario correspondiente a la opción seleccionada
        const opcionSeleccionada = select.value;
        if (opcionSeleccionada === 'paciente') {
            form1.style.display = 'block';
        } else if (opcionSeleccionada === 'estudio') {
            form2.style.display = 'block';
        } else if (opcionSeleccionada === 'fecha') {
            form3.style.display = 'block';
        }
    }
</script>