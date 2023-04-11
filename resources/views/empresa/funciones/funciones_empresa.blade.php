<script type="text/javascript">
    $(document).ready(function(){
        $('#modal_crear_empresa').on('shown.bs.modal', function () {
            $('#emp_nit').trigger('focus');
        });
        $("#btnCloseAddEmp").on('click', function(){
            $("#formulario_crear_empresa").trigger('reset');
        });
    });
</script>