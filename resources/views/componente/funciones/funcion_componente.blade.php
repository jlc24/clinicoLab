<script>
    $(document).ready(function() {
        $("#modal_crear_componente").on('shown.bs.modal', function() {
            $("#comp_nombre").trigger('focus');
        });
        $("#btnCloseAddComponente").on('click', function() {
            $("#formulario_crear_componentes").trigger('reset');
        })
    })
</script>