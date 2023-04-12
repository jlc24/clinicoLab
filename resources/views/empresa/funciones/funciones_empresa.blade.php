<script type="text/javascript">
    $(document).ready(function(){
        $('#modal_crear_empresa').on('shown.bs.modal', function () {
            $('#emp_nit').trigger('focus');
        });
        $("#btnCloseAddEmp").on('click', function(){
            $("#formulario_crear_empresa").trigger('reset');
        });
        $('#emp_departamento').on('change', function() {
            var id = $(this).val();
            //alert(id);
            $.ajax({
                url: '{{ route("datos", ":id") }}'.replace(':id', id),
                type: 'GET',
                success: function(data) {
                    $('#emp_municipio').empty();
                    console.log(data);
                    $.each(data, function(index, element) {
                        $('#emp_municipio').append($('<option>', {
                            value: element.id,
                            text: element.nombre
                        }));
                    });
                }
            });
        });
    });
</script>