//para ESTUDIOS---------------------------------------
$(document).ready(function(){
    $('#modal_crear_estudio').on('shown.bs.modal', function () {
        $('#est_nombre').trigger('focus');
    });
    $("#generar_clave_est").on('change', function() {
        if ($(this).prop('checked')) {
            let cadena = document.getElementById("est_nombre").value;
            let palabras = cadena.split(" ");
            let clave = "";
            for (let i = 0; i < palabras.length; i++) {
                if (palabras[i].length > 3) {
                    clave += palabras[i].charAt(0);
                }
            }
            document.getElementById('est_clave').value = clave;
        } else {
            document.getElementById('est_clave').value = '';
        }
    });
});