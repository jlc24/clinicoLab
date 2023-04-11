<script type="text/javascript">
    //--------------------------MEDICO------------------------------------------------
    $(document).ready(function(){
        $('#modal_crear_medico').on('shown.bs.modal', function () {
            $('#med_nombre').trigger('focus');
        });
        $("#btnCloseAddMedic").on('click', function(){
            $("#formulario_crear_medico").trigger('reset');
        });
        $("#med_celular").on('keyup', function(){
            let input = $(this).val();
            let longitudRequerida = 8;
            let mensaje = $("#error_med_celular");

            if (input.length === longitudRequerida) {
                mensaje.css("display", "none");
            } else {
                mensaje.css("display", "");
            }
        });
        function extraercaracteres(length) {
            let result = '';
            const characters = $("#med_ci_nit").val();
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        }
        $("#generar_correo_med").on('change', function() {
            if ($(this).prop('checked')) {
                $("#med_email").prop('readonly', true);
                const nombre = $("#med_nombre").val().substring(0, 2).toLowerCase();
                const ap_pat = $("#med_apellido_pat").val().substring(0, 2).toLowerCase();
                const ap_mat = $("#med_apellido_mat").val().substring(0, 2).toLowerCase();
                const ci = extraercaracteres(4);
                const correo = `${nombre}${ap_pat}${ci}.${ap_mat}@gmail.com`;
                $("#med_email").val(correo);
            } else {
                $("#med_email").prop('readonly', false);
                $("#med_email").val('');
                $("#med_email").focus();
            }
        });
    });

    $(document).ready(function(){
        $('#modal_crear_empresa').on('shown.bs.modal', function () {
            $('#emp_nit').trigger('focus');
        });
        $("#btnCloseAddEmp").on('click', function(){
            $("#formulario_crear_empresa").trigger('reset');
        });
    });

    function UsuarioMed() {
        const nombre = $("#med_nombre").val().substring(0, 1);
        const ap = $("#med_apellido_pat").val().substring(0, 1);
        const am = $("#med_apellido_mat").val().substring(0, 1);

        const randomNum = Math.floor(Math.random() * 8999) + 1000;

        const outputStr = `${ap}${am}${nombre}${randomNum}`;

        $("#med_usuario").val(outputStr);   
        console.log(outputStr);
    }
    function generateRandomStringMed(length) {
        let result = '';
        const characters = 'abcdefghijklmnopqrstuvwxyz';
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return result;
    }
    function PasswordMed() {
        const nombre = $("#med_nombre").val().substring(0, 1);
        const ap = $("#med_apellido_pat").val().substring(0, 1);
        const am = $("#med_apellido_mat").val().substring(0, 1);
        const ci = $("#med_ci_nit").val();
        const caracter = generateRandomStringMed(3);
        console.log(caracter);

        const randomNum1 = Math.floor(Math.random() * 899) + 100;

        const outputStr = `${nombre}${ap}${am}.${ci}-${caracter}`;

        $("#med_password").val(outputStr);
    }
</script>