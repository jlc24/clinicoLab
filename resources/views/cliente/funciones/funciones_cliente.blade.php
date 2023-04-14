<script type="text/javascript">
    //funciones para Modal Crear usuario
    //---------------------------------------------------------------------------------------
    //--------------------CLIENTE--------------------------------------------------------
    $(document).ready(function() {
        $('#cli_departamento').on('change', function() {
            var id = $(this).val();
            //alert(id);
            $.ajax({
                url: '{{ route("datos", ":id") }}'.replace(':id', id),
                type: 'GET',
                success: function(data) {
                    $('#cli_municipio').empty();
                    console.log(data);
                    $.each(data, function(index, element) {
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

        $("#cli_celular").on('keyup', function(){
            let input = $(this).val();
            let longitudRequerida = 8;
            let mensaje = $("#error_cli_celular");

            if (input.length === longitudRequerida) {
                mensaje.css("display", "none");
            } else {
                mensaje.css("display", "");
            }
        });
        $("#cli_celular_update").on('keyup', function(){
            let input = $(this).val();
            let longitudRequerida = 8;
            let mensaje = $("#error_cli_celular_update");

            if (input.length === longitudRequerida) {
                mensaje.css("display", "none");
            } else {
                mensaje.css("display", "");
            }
        });

        function extraercaracteres(length) {
            let result = '';
            const characters = $("#cli_ci_nit").val();
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        }
        $("#generar_correo_cli").on('change', function() {
            if ($(this).prop('checked')) {
                $("#cli_email").prop('readonly', true);
                const nombre = $("#cli_nombre").val().substring(0, 2).toLowerCase();
                const ap_pat = $("#cli_apellido_pat").val().substring(0, 2).toLowerCase();
                const ap_mat = $("#cli_apellido_mat").val().substring(0, 2).toLowerCase();
                const ci = extraercaracteres(4);
                const correo = `${nombre}${ap_pat}${ci}.${ap_mat}@gmail.com`;
                $("#cli_email").val(correo);
            } else {
                $("#cli_email").prop('readonly', false);
                $("#cli_email").val('');
                $("#cli_email").focus();
            }
        });

        //para modal de modificar
        
    });
    
    function Usuario() {
        const nombre = $("#cli_nombre").val().substring(0, 1);
        const ap = $("#cli_apellido_pat").val().substring(0, 1);
        const am = $("#cli_apellido_mat").val().substring(0, 1);
        const randomNum = Math.floor(Math.random() * 8999) + 1000;
        const outputStr = `${ap}${am}${nombre}${randomNum}`;
        $("#cli_usuario").val(outputStr);   
    }
    function generateRandomString(length) {
        let result = '';
        const characters = 'abcdefghijklmnopqrstuvwxyz';
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return result;
    }

    function Password() {
        const nombre = $("#cli_nombre").val().substring(0, 1);
        const ap = $("#cli_apellido_pat").val().substring(0, 1);
        const am = $("#cli_apellido_mat").val().substring(0, 1);
        const ci = $("#cli_ci_nit").val();
        const caracter = generateRandomString(3);
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

    //---para modal modificar
    function extraercaracteresUp(length) {
        let result = '';
        const characters = $("#cli_ci_nit_update").val();
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return result;
    }
    function generarCorreoUp() {
        const nombre = $("#cli_nombre_update").val().substring(0, 2).toLowerCase();
        const ap_pat = $("#cli_apellido_pat_update").val().substring(0, 2).toLowerCase();
        const ap_mat = $("#cli_apellido_mat_update").val().substring(0, 2).toLowerCase();
        const ci = extraercaracteresUp(4);
        const correo = `${nombre}${ap_pat}${ci}.${ap_mat}@gmail.com`;
        $("#cli_email_update").val(`${correo}`);
    }
    function UsuarioUp() {
        const nombre = $("#cli_nombre_update").val().substring(0, 1);
        const ap = $("#cli_apellido_pat_update").val().substring(0, 1);
        const am = $("#cli_apellido_mat_update").val().substring(0, 1);
        const randomNum = Math.floor(Math.random() * 8999) + 1000;
        const newusuario = `${ap}${am}${nombre}${randomNum}`;
        $("#cli_usuario_update").val(`${newusuario}`);   
    }

    function PasswordUp() {
        const nombre = $("#cli_nombre_update").val().substring(0, 1);
        const ap = $("#cli_apellido_pat_update").val().substring(0, 1);
        const am = $("#cli_apellido_mat_update").val().substring(0, 1);
        const ci = $("#cli_ci_nit_update").val();
        const caracter = generateRandomString(3);
        const randomNum1 = Math.floor(Math.random() * 899) + 100;
        const newpass = `${nombre}${ap}${am}.${ci}-${caracter}`;
        $("#cli_password_update").val(`${newpass}`);
    }
</script>