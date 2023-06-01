<script src="{{ asset('dist/js/libs/wizard/jquery.smartWizard.min.js') }}"></script>
<script src="{{ asset('dist/js/libs/wizard/conf_smart_wizard.js') }}"></script>
<script>
    $(document).ready(function() {
        //datatables
        $("#tabla_usuarios").dataTable({
            responsive: true,
            columnDefs: [],
            "lengthMenu": [10, 20, 30, 100],
            /* Disable initial sort */
            "aaSorting": [],
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Registros del _START_ al _END_ de un total de _TOTAL_ ",
                "sInfoEmpty": "Registros del 0 al 0 de un total de 0 ",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });

        $('#smartwizard_crear_usuario').smartWizard();

        $("#btnCloseAddUsuario").on('click', function(){
            $("#formulario_crear_usuario").trigger('reset');
            $('#smartwizard_crear_usuario').smartWizard("reset");
        });

        $('#usuario_departamento').on('change', function() {
            var id = $(this).val();
            $.ajax({
                url: '{{ route("datos", ":id") }}'.replace(':id', id),
                type: 'GET',
                success: function(data) {
                    $('#usuario_municipio').empty();
                    $.each(data, function(index, element) {
                        $('#usuario_municipio').append($('<option>', {
                            value: element.id,
                            text: element.nombre
                        }));
                    });
                }
            });
        });

        function extraercaracteres(length) {
            let result = '';
            const characters = $("#usuario_ci_nit").val();
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        }
        $("#generar_correo_usuario").on('change', function() {
            if ($(this).prop('checked')) {
                $("#usuario_email").prop('readonly', true);
                const nombre = $("#usuario_nombre").val().substring(0, 2).toLowerCase();
                const ap_pat = $("#usuario_apellido_pat").val().substring(0, 2).toLowerCase();
                const ap_mat = $("#usuario_apellido_mat").val().substring(0, 2).toLowerCase();
                const ci = extraercaracteres(4);
                const correo = `${nombre}${ap_pat}${ci}.${ap_mat}@gmail.com`;
                $("#usuario_email").val(correo);
            } else {
                $("#usuario_email").prop('readonly', false);
                $("#usuario_email").val('');
                $("#usuario_email").focus();
            }
        });

        $("#btnRegisterUsuario").on('click', function(event) {
            event.preventDefault();
            if ($("#usuario_nombre").val() == "" || $("#usuario_apellido_pat").val() == "" || $("#usuario_ci_nit").val() == "" || $("#usuario_ci_nit_exp").val() == "" || $("#usuario_genero").val() == "" || $("#usuario_email").val() == "" || $("#usuario_direccion").val() == "" || $("#usuario_celular").val() == "" || $("#usuario_usuario").val() == "" || $("#usuario_password").val() == "" || $("#usuario_departamento").val() == "" || $("#usuario_municipio").val() == "" || $("#usuario_estado").val() == "" || $("#usuario_rol").val() == "" ) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Algunos campos son requeridos',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                var datos = new FormData();
                datos.append('usuario_cod', $("#usuario_cod").val());
                datos.append('usuario_nombre', $("#usuario_nombre").val());
                datos.append('usuario_apellido_pat', $("#usuario_apellido_pat").val());
                datos.append('usuario_apellido_mat', $("#usuario_apellido_mat").val());
                datos.append('usuario_ci_nit', $("#usuario_ci_nit").val());
                datos.append('usuario_ci_nit_exp', $("#usuario_ci_nit_exp").val());
                datos.append('usuario_fec_nac', $("#usuario_fec_nac").val());
                datos.append('usuario_genero', $("#usuario_genero").val());
                datos.append('usuario_email', $("#usuario_email").val());
                datos.append('usuario_direccion', $("#usuario_direccion").val());
                datos.append('usuario_celular', $("#usuario_celular").val());
                datos.append('usuario_usuario', $("#usuario_usuario").val());
                datos.append('usuario_password', $("#usuario_password").val());
                datos.append('usuario_departamento', $("#usuario_departamento option:selected").text());
                datos.append('usuario_municipio', $("#usuario_municipio option:selected").text());
                datos.append('usuario_estado', $("#usuario_estado").val());
                datos.append('usuario_rol', $("#usuario_rol").val());

                // for (const [key, value] of datos) {
                //     console.log(key, '- '+value);
                // };
                $.ajax({
                    url: '{{ route("usuario.store") }}',
                    type: 'POST',
                    data: datos,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            title: '¡Exito!',
                            text: 'Usuario registrado',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                        
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.error('Error en la solicitud: ', textStatus, ', detalles: ', errorThrown);
                        Swal.fire({
                            title: 'Oops...',
                            text: 'Se ha producido un error.',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                });
            }
        });

    });
    function Usuario() {
        const nombre = $("#usuario_nombre").val().substring(0, 1);
        const ap = $("#usuario_apellido_pat").val().substring(0, 1);
        const am = $("#usuario_apellido_mat").val().substring(0, 1);
        const randomNum = Math.floor(Math.random() * 8999) + 1000;
        const outputStr = `${ap}${am}${nombre}${randomNum}`;
        $("#usuario_usuario").val(outputStr);   
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
        const nombre = $("#usuario_nombre").val().substring(0, 1);
        const ap = $("#usuario_apellido_pat").val().substring(0, 1);
        const am = $("#usuario_apellido_mat").val().substring(0, 1);
        const ci = $("#usuario_ci_nit").val();
        const caracter = generateRandomString(3);
        const randomNum1 = Math.floor(Math.random() * 899) + 100;
        const outputStr = `${nombre}${ap}${am}.${ci}-${caracter}`;
        $("#usuario_password").val(outputStr);
    }
</script>