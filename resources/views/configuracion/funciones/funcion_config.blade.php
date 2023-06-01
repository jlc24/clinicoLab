<script>
    $(document).ready(function() {
        $(document).on('click', '.btn-config-edit', function() {
            $("#chk-edit").prop('checked', true);
            if ($("#chk-edit").is(':checked')) {
                $('.btn-config-edit').removeClass('btn-outline-warning').addClass('btn-warning btn-config-edit-q');
                $("#config_nombre").prop('disabled', false);
                $("#config_nombre").focus();
                $("#config_nit").prop('disabled', false);
                $("#config_direccion").prop('disabled', false);
                $("#config_pais").prop('disabled', false);
                $("#cli_departamento").prop('disabled', false);
                $("#cli_municipio").prop('disabled', false);
                $("#config_telefono").prop('disabled', false);
                $("#config_email").prop('disabled', false);
                $("#config_web").prop('disabled', false);
                $(".btn-config-save").prop('hidden', false);
            }
        });
        $(document).on('click', '.btn-config-edit-q', function() {
            $("#chk-edit").prop('checked', false);
            if ($("#chk-edit").prop('checked', false)) {
                $('.btn-config-edit').removeClass('btn-warning btn-config-edit-q').addClass('btn-outline-warning btn-config-edit');
                $("#config_nombre").prop('disabled', true);
                $("#config_nit").prop('disabled', true);
                $("#config_direccion").prop('disabled', true);
                $("#config_pais").prop('disabled', true);
                $("#cli_departamento").prop('disabled', true);
                $("#cli_municipio").prop('disabled', true);
                $("#config_telefono").prop('disabled', true);
                $("#config_email").prop('disabled', true);
                $("#config_web").prop('disabled', true);
                $(".btn-config-save").prop('hidden', true);
            }
        });

        $(document).on('click','.btn-config-save', function() {
            if ($("#config_id").val() == "") {
                var datos = new FormData();
                datos.append('nombre', $("#config_nombre").val());
                datos.append('nit', $("#config_nit").val());
                datos.append('direccion', $("#config_direccion").val());
                datos.append('pais', $("#config_pais").val());
                datos.append('departamento', $("#cli_departamento").val());
                datos.append('municipio', $("#cli_municipio").val());
                datos.append('telefono', $("#config_telefono").val());
                datos.append('email', $("#config_email").val());
                datos.append('web', $("#config_web").val());
                $.ajax({
                    url: '{{ route("config.store") }}',
                    type: 'POST',
                    data: datos,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Registrado',
                            text: 'Registro de datos exitoso',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.error('Error en la solicitud: ', textStatus, ', detalles: ', errorThrown);
                        Swal.fire({
                            title: 'Oops...',
                            text: 'Error en la solicitud: '+ textStatus+ ', detalles: '+ errorThrown,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                });
            }else{
                var datos = new FormData();
                datos.append('nombre', $("#config_nombre").val());
                datos.append('nit', $("#config_nit").val());
                datos.append('direccion', $("#config_direccion").val());
                datos.append('pais', $("#config_pais").val());
                datos.append('departamento', $("#cli_departamento").val());
                datos.append('municipio', $("#cli_municipio").val());
                datos.append('telefono', $("#config_telefono").val());
                datos.append('email', $("#config_email").val());
                datos.append('web', $("#config_web").val());
                $.ajax({
                    url: '{{ route("config.update", ":id") }}'.replace(":id", $("#config_id").val()),
                    type: 'POST',
                    data: datos,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Actualizado!!!',
                            text: 'Datos actualizados correctamente',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        setTimeout(function(){
                            window.location.href = '{{ route('configuration') }}';
                        }, 1000);
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.error('Error en la solicitud: ', textStatus, ', detalles: ', errorThrown);
                        Swal.fire({
                            title: 'Oops...',
                            text: 'Error en la solicitud: '+ textStatus+ ', detalles: '+ errorThrown,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                });
            }
        });

        const logoActual = $('.img_logo').attr('src');
        $(document).on('change', '.photo_logo', function() {
            if ($(this).val() !== "") {
                $(".btn-save-logo").prop('hidden', false);
                $(".div-clear-file").prop('hidden', false);
            }else{
                $(".btn-save-logo").prop('hidden', true);
                $(".img_logo").attr("src", logoActual);
                $(".div-clear-file").prop('hidden', true);
            }
        });

        $(document).on('click', '.btn-clear-file', function() {
            $(".img_logo").attr("src", logoActual);
            $("#photo_logo").val("");
            $(".div-clear-file").prop('hidden', true);
            $(".btn-save-logo").prop('hidden', true);
        });

        $(document).on('click', '.btn-save-logo', function() {
            if ($("#config_id").val() !== "") {
                var fileData = $("#photo_logo").prop("files")[0];
                var datos = new FormData();
                datos.append('file', fileData);
                $.ajax({
                    url: '{{ route("config.imagen", ":id") }}'.replace(":id", $("#config_id").val()),
                    type: 'POST',
                    data: datos,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Actualizado!!!',
                            text: 'Logo actualizado correctamente',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        setTimeout(function(){
                            window.location.href = '{{ route('configuration') }}';
                        }, 1000);
                    },
                });
            }
        });
    });
</script>