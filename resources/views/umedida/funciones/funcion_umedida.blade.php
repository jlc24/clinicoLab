<script>
    $(document).ready(function() {
        $("#modal_crear_medida").on("shown.bs.modal", function() {
            $("#medida_unidad").trigger('focus');
        });
        $("#btnCloseAddMedida").on('click', function() {
            $("#formulario_crear_medida").trigger('reset');
        })
    })
</script>