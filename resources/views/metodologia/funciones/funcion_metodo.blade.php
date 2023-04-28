<script type="text/javascript">
    $(document).ready(function() {
        $("#modal_crear_metodologia").on("shown.bs.modal", function() {
            $("#metodo_nombre").trigger('focus');
        });
        $("#btnCloseAddMetodo").on('click', function() {
            $("#formulario_crear_metodo").trigger('reset');
        })
    })
</script>