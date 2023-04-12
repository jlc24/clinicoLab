<script>
    $(document).ready(function(){
        $("#modal_crear_recipiente").on('shown.bs.modal', function () {
            $('#reci_nombre').trigger('focus');
        });
        $("#btnCloseAddRecipiente").on('click', function(){
            $("#formulario_crear_recipiente").trigger('reset');
        })
    });
</script>