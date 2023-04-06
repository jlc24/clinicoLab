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
        // $(document).on("click", "#btnRegisterClient", function() {
        //     cadena = $("#formulario_crear_cliente").serialize();
        //     alert(cadena); return false;
        // });

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
        
        
        // function generateRandomString(length) {
        //     let result = '';
        //     const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        //     for (let i = 0; i < length; i++) {
        //         result += characters.charAt(Math.floor(Math.random() * characters.length));
        //     }
        //     return result;
        // }

        // function Password() {
        //     const nombre = $("#med_nombre").val().substring(0, 1);
        //     const ap = $("#med_apellido_pat").val().substring(0, 1);
        //     const am = $("#med_apellido_mat").val().substring(0, 1);
        //     const ci = $("#med_ci_nit").val();
        //     const caracter = generateRandomString(3);
        //     console.log(caracter);

        //     const randomNum1 = Math.floor(Math.random() * 899) + 100;

        //     const outputStr = `${nombre}${ap}${am}.${ci}-${caracter}`;

        //     $("#med_password").val(outputStr);
        // }
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
    }
    function PasswordMed() {
        const nombre = $("#med_nombre").val().substring(0, 1);
        const ap = $("#med_apellido_pat").val().substring(0, 1);
        const am = $("#med_apellido_mat").val().substring(0, 1);
        const ci = $("#med_ci_nit").val();
        const caracter = generateRandomString(3);
        console.log(caracter);

        const randomNum1 = Math.floor(Math.random() * 899) + 100;

        const outputStr = `${nombre}${ap}${am}.${ci}-${caracter}`;

        $("#med_password").val(outputStr);
    }
        //--------------------------MEDICO------------------------------------------------
        // $('#modal_crear_medico').on('shown.bs.modal', function () {
        //     $('#cli_nombre').trigger('focus');
        // });
        // $("#btnCloseAddClient").on('click', function(){
        //     $("#formulario_crear_medico").trigger('reset');
        // })
        // $("#med_celular").on('keyup', function(){
        //     let input = $(this).val();
        //     let longitudRequerida = 8;
        //     let mensaje = $("#error_med_celular");

        //     if (input.length === longitudRequerida) {
        //         mensaje.css("display", "none");
        //     } else {
        //         mensaje.css("display", "");
        //     }
        // });
        // function extraercaracteres(length) {
        //     let result = '';
        //     const characters = $("#med_ci_nit").val();
        //     for (let i = 0; i < length; i++) {
        //         result += characters.charAt(Math.floor(Math.random() * characters.length));
        //     }
        //     return result;
        // }
        // $("#generar_correo").on('change', function() {
        //     if ($(this).prop('checked')) {
        //         $("#med_email").prop('readonly', true);
        //         const nombre = $("#med_nombre").val().substring(0, 2).toLowerCase();
        //         const ap_pat = $("#med_apellido_pat").val().substring(0, 2).toLowerCase();
        //         const ap_mat = $("#med_apellido_mat").val().substring(0, 2).toLowerCase();
        //         const ci = extraercaracteres(4);
        //         const correo = `${nombre}${ap_pat}${ci}.${ap_mat}@gmail.com`;
        //         $("#med_email").val(correo);
        //     } else {
        //         $("#med_email").prop('readonly', false);
        //         $("#med_email").val('');
        //         $("#med_email").focus();
        //     }
        // });

    //para eliminar datos solo colocar el nombre de la ruta correspondiente   
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var route = $(this).data('route');
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¡No podrás revertir esto!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, borrarlo!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: route.replace(':id', id),
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire({
                            title: '¡Eliminado!',
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then((result)=>{
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                });
            }
        })
    });

    //para buscar y autocompletar para empresa, medico y paciente---------------------------------------------
    $(document).ready(function() {
        $('#rec_medico_clave').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '/buscar_medico_id/?q=' + request.term,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        response(data);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                event.preventDefault();
                $('#rec_medico_id').val(ui.item.id);
                $('#rec_medico_clave').val(ui.item.med_cod);
                $('#rec_medico_nombre').val(ui.item.med_nombre+' '+ui.item.med_apellido_pat+' '+ui.item.med_apellido_mat);
                $('#rec_especialidad').val(ui.item.med_especialidad);
                return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li class='each'></li>" )
            .data( "item.autocomplete", item )
            .append("<div class='acItem'><span class='name'>"+item.med_cod+"</span>"+"&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.med_nombre+"</span><span class='name'>"+"&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.med_apellido_pat+"</span><span class='name'>"+ "&nbsp;&nbsp;&nbsp;&nbsp;" + item.med_apellido_mat+"</span></div>")
            .appendTo( ul );
        };
        $('#rec_medico_nombre').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '/buscar_medico_nombre/?q=' + request.term,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        response(data);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                event.preventDefault();
                $('#rec_medico_id').val(ui.item.id);
                $('#rec_medico_clave').val(ui.item.med_cod);
                $('#rec_medico_nombre').val(ui.item.med_nombre+' '+ui.item.med_apellido_pat+' '+ui.item.med_apellido_mat);
                $('#rec_especialidad').val(ui.item.med_especialidad);
                return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li class='each'></li>" )
            .data( "item.autocomplete", item )
            .append("<div class='acItem'><span class='name'>"+item.med_cod+"</span>"+" "+"<span class='name'>"+item.med_nombre+"</span><span class='name'>"+"&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.med_apellido_pat+"</span><span class='name'>"+ "&nbsp;&nbsp;&nbsp;&nbsp;" + item.med_apellido_mat+"</span></div>")
            .appendTo( ul );
        };

        $('#rec_paciente_clave').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '/buscar_paciente_id/?q=' + request.term,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        response(data);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                event.preventDefault();
                $('#rec_paciente_id').val(ui.item.id);
                $('#rec_paciente_clave').val(ui.item.cli_cod);
                $('#rec_paciente_nombre').val(ui.item.cli_nombre+' '+ui.item.cli_apellido_pat+' '+ui.item.cli_apellido_mat);
                $('#rec_genero').val(ui.item.cli_genero);
                $('#rec_edad').val(ui.item.edad+' años');
                return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li class='each'></li>" )
            .data( "item.autocomplete", item )
            .append("<div class='acItem'><span class='name'>"+item.cli_cod+"</span>"+"&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.cli_nombre+"</span><span class='name'>"+"&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.cli_apellido_pat+"</span><span class='name'>"+ "&nbsp;&nbsp;&nbsp;&nbsp;" + item.cli_apellido_mat+"</span></div>")
            .appendTo( ul );
        };
        $('#rec_paciente_nombre').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '/buscar_paciente_nombre/?q=' + request.term,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        response(data);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                event.preventDefault();
                $('#rec_paciente_id').val(ui.item.id);
                $('#rec_paciente_clave').val(ui.item.cli_cod);
                $('#rec_paciente_nombre').val(ui.item.cli_nombre+' '+ui.item.cli_apellido_pat+' '+ui.item.cli_apellido_mat);
                $('#rec_genero').val(ui.item.cli_genero);
                $('#rec_edad').val(ui.item.edad+' años');
                return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li class='each'></li>" )
            .data( "item.autocomplete", item )
            .append("<div class='acItem'><span class='name'>"+item.cli_cod+"</span>"+"&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.cli_nombre+"</span><span class='name'>"+"&nbsp;&nbsp;&nbsp;&nbsp;"+"<span class='name'>"+item.cli_apellido_pat+"</span><span class='name'>"+ "&nbsp;&nbsp;&nbsp;&nbsp;" + item.cli_apellido_mat+"</span></div>")
            .appendTo( ul );
        };
    });
    
    //Funciones para Resultados
    $(document).ready(function(){
    });
    const select = document.getElementById('buscar_resultado');
    const form1 = document.getElementById('form_buscar_paciente');
    const form2 = document.getElementById('form_buscar_estudio');
    const form3 = document.getElementById('form_buscar_fechas');
    function buscarPor() {
        // Ocultamos todos los formularios
        form1.style.display = 'none';
        form2.style.display = 'none';
        form3.style.display = 'none';

        // Mostramos el formulario correspondiente a la opción seleccionada
        const opcionSeleccionada = select.value;
        if (opcionSeleccionada === 'paciente') {
            form1.style.display = 'block';
        } else if (opcionSeleccionada === 'estudio') {
            form2.style.display = 'block';
        } else if (opcionSeleccionada === 'fecha') {
            form3.style.display = 'block';
        }
    }
    @if(session('success'))
        Swal.fire({
            title: 'Registrado',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    @endif

    //----------------------------------------------------------------------------------------
</script>