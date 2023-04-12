<script>
    $(document).ready(function(){
        $("#modal_crear_muestra").on('shown.bs.modal', function () {
            $('#muestra_nombre').trigger('focus');
        });
        $("#btnCloseAddMuestra").on('click', function(){
            $("#formulario_crear_muestra").trigger('reset');
        })
    });
</script>