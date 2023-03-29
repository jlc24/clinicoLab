<script type="text/javascript">
    //funciones para Modal Crear usuario
    //---------------------------------------------------------------------------------------
    $(document).ready(function() {
        $('#cli_departamento').on('change', function() {
            var id = $(this).val();
            //alert(id);
            $.ajax({
                url: '{{ route("datos", ":id") }}'.replace(':id', id),
                type: 'GET',
                success: function(data) {
                    $('#cli_municipio').empty();
                    $.each(data, function(index, element) {
                        console.log(data);
                        $('#cli_municipio').append($('<option>', {
                            value: element.id,
                            text: element.nombre
                        }));
                    });
                }
            });
        });
        $('#modal_crear_cliente').on('shown.bs.modal', function () {
            $('#cli_nombre').trigger('focus');
        });
        $("#btnCloseAddClient").on('click', function(){
            $("#formulario_crear_cliente").trigger('reset');
        })
        // $(document).on("click", "#btnRegisterClient", function() {
        //     cadena = $("#formulario_crear_cliente").serialize();
        //     alert(cadena); return false;
        // });


    });

    function Usuario() {
        const nombre = $("#cli_nombre").val().substring(0, 1);
        const ap = $("#cli_apellido_pat").val().substring(0, 1);
        const am = $("#cli_apellido_mat").val().substring(0, 1);

        const randomNum = Math.floor(Math.random() * 899) + 100;

        const outputStr = `${ap}${am}${nombre}${randomNum}`;

        $("#cli_usuario").val(outputStr);   
    }
    function Password() {
        const nombre = $("#cli_nombre").val().substring(0, 1);
        const ap = $("#cli_apellido_pat").val().substring(0, 1);
        const am = $("#cli_apellido_mat").val().substring(0, 1);
        const ci = $("#cli_ci_nit").val();
        const caracter = "{{ $password }}";
        console.log(caracter);

        const randomNum1 = Math.floor(Math.random() * 899) + 100;

        const outputStr = `${nombre}${ap}${am}.${ci}-${caracter}`;

        $("#cli_password").val(outputStr);
    }

    function CalcularEdad() {
        const date1 = new Date("{{ date('Y-m-d') }}");
        const date2 =  new Date(document.getElementById('cli_fec_nac').value);
        const edadInput = document.getElementById('cli_edad').value;

        // Dias:
        const dayDefinition = 1000 * 60 * 60 * 24 // Este número es: Milisegundos * segundos * minutos * horas
        const daysDiff = Math.ceil((Math.abs(date1 - date2)) / dayDefinition);
        const years = Math.floor(daysDiff / 365.25);
        const remainingDays = Math.floor(daysDiff - (years * 365.25));
        const months = Math.floor((remainingDays / 365.25) * 12);
        const days = Math.ceil(daysDiff - (years * 365.25 + (months / 12 * 365.25)));
        

        $("#cli_edad").val(`${years} año${years == 1 ? '' : 's'}, ${months} mes${months == 1 ? '' : 'es'}, ${days} dia${days == 1 ? '' : 's'}`);
    }

    

    //----------------------------------------------------------------------------------------
</script>