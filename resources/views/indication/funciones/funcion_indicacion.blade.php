<script>
    $(document).ready(function(){
        $("#modal_crear_indicacion").on('shown.bs.modal', function () {
            $('#indi_nombre').trigger('focus');
        });
        $("#btnCloseAddIndicacion").on('click', function(){
            $("#formulario_crear_indicaciones").trigger('reset');
        })
    });
</script>