
$(document).ready(function() {
    $('#adm_departamento').on('change', function() {
        var id = $(this).val();
        //alert(id);
        $.ajax({
            url: '{{ route("datos", ":id") }}'.replace(':id', id),
            type: 'GET',
            success: function(data) {
                $('#adm_municipio').empty();
                $.each(data, function(index, element) {
                    console.log(data);
                    $('#adm_municipio').append($('<option>', {
                        value: element.id,
                        text: element.nombre
                    }));
                });
            }
        });
    });
});