<script>
    $(document).ready(function(){
        if (window.location.href.indexOf("/indications") > -1) {
            filtroTabla('#search_indicaciones', '#tabla_indicaciones');
        }
        $("#modal_crear_indicacion").on('shown.bs.modal', function () {
            $('#indi_descripcion').trigger('focus');
        });
        $("#btnCloseAddIndicacion").on('click', function(){
            $("#formulario_crear_indicaciones").trigger('reset');
            $("#indi_descripcion").css('border', '');
        });

        function getIndicaciones() {
            mostrarCargando();
            $.ajax({
                url: '{{ route("getIndications") }}',
                type: 'GET' ,
                dataType: 'json',
                success: (data) => {
                    if (data.length !== 0) {
                        $("#tabla_indicaciones tbody").empty();
                        let cont = 1;
                        data.forEach((indicacion)=>{
                            const indicacionRow = `<tr><td hidden>${indicacion.id}</td><td><strong>${cont++}</strong></td><td>${indicacion.descripcion}</td><td class="text-center"><div class="btn-group">
                                                    <button data-toggle="modal" data-target="#modal_actualizar_indicacion" class="btn btn-sm btn-outline-warning btnEditIndicacion"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger btnDeleteIndicacion"><i class="fas fa-trash-alt"></i></button>
                                                </div></td></tr>`;
                            $("#tabla_indicaciones tbody").append(indicacionRow);
                        });
                    }else{
                        $("#tabla_indicaciones tbody").empty().append('<td colspan="4" class="text-center">No hay indicaciones registradas</td>');
                    }
                    cerrarCargando();
                }
            });
        }

        getIndicaciones();

        $(document).on('click', '#btnRegisterIndicacion', (e) => {
            e.preventDefault();
            let vacio = "";
            if ($("#indi_descripcion").val() == "") {
                vacio = "DESCRIPCION";
                $("#indi_descripcion").css('border', '1px solid #E91C2B')
                $('#indi_descripcion').trigger('focus');
            }
            if (vacio !== "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'El campo ' + vacio + ' es requerido.',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                let datos = new FormData();
                datos.append('indi_descripcion', $("#indi_descripcion").val());

                $.ajax({
                    url: '{{ route("indication.store") }}',
                    type: 'POST',
                    data: datos,
                    contentType:false,
                    processData:false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        Swal.fire({
                            title: '¡Exito!',
                            text: 'Indicacion registrada',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        if (window.location.href.indexOf("/indications") > -1) {
                            getIndicaciones();
                            $("#formulario_crear_indicaciones").trigger('reset');
                            $("#indi_descripcion").css('border','');
                            $('#modal_crear_indicacion .btn-close').trigger('click');
                        }else{
                            $("#formulario_crear_indicaciones").trigger('reset');
                            $("#indi_descripcion").css('border','');
                            $('#modal_crear_indicacion .btn-close').trigger('click');
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

        $(document).on('click', '.btnEditIndicacion' , (event) => {
            let id = $(event.currentTarget).closest('tr').find('td:eq(0)').text();
            $.ajax({
                url: '{{ route("indication.edit", ":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success: (data) => {
                    $(".indi_id_update").val(data.id);
                    $(".indi_descripcion_update").val(data.descripcion);
                    $(".indi_descripcion_update").css('border', data.descripcion !== null ? '2px solid #40CC6C' : '');
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error('Error en la solicitud: ', textStatus, ', detalles: ', errorThrown);
                    Swal.fire({
                        title: 'Oops...',
                        text: 'Error en la solicitud: ' + textStatus + ', detalles: ' + errorThrown,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        });

        $(document).on('click', '.btnUpdateIndicacion', (event) => {
            event.preventDefault();
            let vacio = "";
            if ($(".indi_descripcion_update").val() == "") {
                vacio = "DESCRIPCION";
                $("#indi_descripcion_update").css('border', '1px solid #E91C2B')
                $('#indi_descripcion_update').trigger('focus');
            }
            if (vacio !== "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'El campo ' + vacio + ' es requerido.',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                let datos = new FormData();
                datos.append('indi_descripcion_update', $("#indi_descripcion_update").val());

                $.ajax({
                    url: '{{ route("indication.update", ":is") }}'.replace(":id", $(".indi_id_update").val()),
                    type: 'POST',
                    data: datos,
                    contentType:false,
                    processData:false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        Swal.fire({
                            title: '¡Exito!',
                            text: 'Indicacion actualizada',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        getIndicaciones();
                        $('#modal_actualizar_indicacion .btn-close').trigger('click');
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
        })

        $(document).on('click', '.btnDeleteIndicacion', (event) => {
            let id = $(event.currentTarget).closest("tr").find("td:eq(0)").text();
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¡No podrás revertir esto!',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, borrarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("indication.destroy", ":id") }}'.replace(":id", id),
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire({
                                title: '¡Exito!',
                                text: 'Indicacion Eliminada',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            getIndicaciones();
                        },
                        error: function (xhr, textStatus, errorThrown) {
                            console.error('Error en la solicitud: ', textStatus, ', detalles: ', errorThrown);
                            Swal.fire({
                                title: 'Oops...',
                                text: 'Error en la solicitud: ' + textStatus + ', detalles: ' + errorThrown,
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    });
                }
            });
        });
    });
</script>