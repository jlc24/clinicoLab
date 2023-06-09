<script src="{{ asset('dist/js/libs/wizard/jquery.smartWizard.min.js') }}"></script>
<script src="{{ asset('dist/js/libs/wizard/conf_smart_wizard.js') }}"></script>
<script type="text/javascript">
    //--------------------------MEDICO------------------------------------------------
    $(document).ready(function(){
        $('#smartwizard_crear_medico').smartWizard();
        $('#modal_crear_medico').on('shown.bs.modal', function () {
            $('#med_nombre').trigger('focus');
        });
        $("#btnCloseAddMedic").on('click', function(){
            $("#formulario_crear_medico").trigger('reset');
            $('#smartwizard_crear_medico').smartWizard('reset');
        });

        $('#med_departamento').on('change', function() {
            var id = $(this).val();
            $.ajax({
                url: '{{ route("datos", ":id") }}'.replace(':id', id),
                type: 'GET',
                success: function(data) {
                    $('#med_municipio').empty();
                    $.each(data, function(index, element) {
                        $('#med_municipio').append($('<option>', {
                            value: element.id,
                            text: element.nombre
                        }));
                    });
                }
            });
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

        $(document).on('click', '.btnRegisterMedico', function() {
            event.preventDefault();
            if ($("#med_cod").val() == "" || $("#med_nombre").val() == "" || $("#med_apellido_pat").val() == "" || $("#med_apellido_mat").val() == "" || $("#med_ci_nit").val() == "" || $("#med_ci_nit_exp").val() == "" || $("#med_genero").val() == "" || $("#med_email").val() == "" || $("#med_direccion").val() == "" || $("#med_celular").val() == "" || $("#med_usuario").val() == "" || $("#med_password").val() == "" || $("#med_departamento").val() == "" || $("#med_municipio").val() == "" || $("#med_estado").val() == "" || $("#med_rol").val() == "" ) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Algunos campos son requeridos',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                var datos = new FormData();
                datos.append('med_cod', $("#med_cod").val());
                datos.append('med_nombre', $("#med_nombre").val());
                datos.append('med_apellido_pat', $("#med_apellido_pat").val());
                datos.append('med_apellido_mat', $("#med_apellido_mat").val());
                datos.append('med_ci_nit', $("#med_ci_nit").val());
                datos.append('med_ci_nit_exp', $("#med_ci_nit_exp").val());
                datos.append('med_genero', $("#med_genero").val());
                datos.append('med_especialidad', $("#med_especialidad").val());
                datos.append('med_email', $("#med_email").val());
                datos.append('med_direccion', $("#med_direccion").val());
                datos.append('med_celular', $("#med_celular").val());
                datos.append('med_usuario', $("#med_usuario").val());
                datos.append('med_password', $("#med_password").val());
                datos.append('med_departamento', $("#med_departamento").val());
                datos.append('med_municipio', $("#med_municipio").val());
                datos.append('med_estado', $("#med_estado").val());
                datos.append('med_rol', $("#med_rol").val());

                // for (const [key, value] of datos) {
                //     console.log(key, '- '+value);
                // };
                $.ajax({
                    url:'{{ route("medico.store") }}',
                    type:'POST',
                    data: datos,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        Swal.fire({
                            title: '¡Exito!',
                            text: 'Medico registrado',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        if (window.location.href.indexOf("medicos") > -1) {
                            location.reload();
                            $('#smartwizard_crear_medico').smartWizard("reset");
                        }else{
                            $('#smartwizard_crear_medico').smartWizard("reset");
                        }
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

        $("#tabla_medicos").dataTable({
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

        function getMedico(id) {
            $.ajax({
                url: '{{ route("getMedico", ":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $(".user_id").val(data.user_id);
                }
            });
        }

        function getPermisos(id) {
            $.ajax({
                url: '{{ route("getPermisosUser", ":id") }}'.replace(":id", id),
                type: 'GET',
                success: function(data) {
                    if (data.length != 0) {
                        var size = data.length / 2;
                        var permisos1 = data.slice(0, size);
                        var permisos2 = data.slice(size);
                        $('.tabla-permiso1 tbody').empty()
                        permisos1.forEach(function(permiso) {
                            var row = $("<tr>");
                            row.append($("<td hidden>").text(permiso.id));
                            row.append($("<td>").text(permiso.permiso));
                            var checkbox = $("<input>").attr("type", "checkbox").addClass("checkPermiso");
                            if (permiso.estado === 1) {
                                checkbox.prop("checked", true);
                            }
                            row.append($("<td class='text-center'>").append(checkbox));
                            $(".tabla-permiso1 tbody").append(row);
                        });
                        $('.tabla-permiso2 tbody').empty()
                        permisos2.forEach(function(permiso) {
                            var row = $("<tr>");
                            row.append($("<td hidden>").text(permiso.id));
                            row.append($("<td>").text(permiso.permiso));
                            var checkbox = $("<input>").attr("type", "checkbox").addClass("checkPermiso");
                            if (permiso.estado === 1) {
                                checkbox.prop("checked", true);
                            }
                            row.append($("<td class='text-center'>").append(checkbox));
                            $(".tabla-permiso2 tbody").append(row);
                        });
                    }else {
                        $('.tabla-permiso1 tbody').empty().append('<td colspan="3" class="text-center">No hay datos recepcionados</td>');
                        $('.tabla-permiso2 tbody').empty().append('<td colspan="3" class="text-center">No hay datos recepcionados</td>');
                    }
                }
            });
        }

        $(document).on('click', '.btnPermisoMedico', function() {
            var med_id = $(this).closest('tr').find('td:eq(0)').text();
            getMedico(med_id);
            mostrarCargando();
            setTimeout(function() {
                var user_id = $(".user_id").val();
                getPermisos(user_id);
                cerrarCargando();
            }, 500);
        });

        function updatePermiso(datos, id, user) {
            mostrarCargando();
            $.ajax({
                url: '{{ route("updatePermiso", ":id") }}'.replace(":id", id),
                type: 'POST',
                data: datos,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    getPermisos(user);
                    cerrarCargando();
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

        $(document).on('click', '.checkPermiso', function() {
            var permiso_id = $(this).closest('tr').find('td:eq(0)').text();
            var user_id = $(".user_id").val();
            var datos = new FormData();
            if ($(this).is(':checked')) {
                datos.append('estado', 1);
                updatePermiso(datos, permiso_id, user_id);
            }else{
                datos.append('estado', 0);
                updatePermiso(datos, permiso_id, user_id);
            }
        });
    });

    function UsuarioMed() {
        const nombre = $("#med_nombre").val().substring(0, 1);
        const ap = $("#med_apellido_pat").val().substring(0, 1);
        const am = $("#med_apellido_mat").val().substring(0, 1);
        const randomNum = Math.floor(Math.random() * 8999) + 1000;
        const outputStr = `${ap}${am}${nombre}${randomNum}`;
        $("#med_usuario").val(outputStr);   
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
        const randomNum1 = Math.floor(Math.random() * 899) + 100;
        const outputStr = `${nombre}${ap}${am}.${ci}-${caracter}`;
        $("#med_password").val(outputStr);
    }
</script>