<script>
    $(document).ready(function(){
        if (window.location.href.indexOf("/muestras") > -1) {
            filtroTabla('#search_muestras', '#tabla_muestras');
        }
        
        $("#modal_crear_muestra").on('shown.bs.modal', function () {
            $('#muestra_nombre').trigger('focus');
        });
        $("#btnCloseAddMuestra").on('click', function(){
            $("#formulario_crear_muestra").trigger('reset');
            $("#muestra_nombre").css('border', '');
            $("#muestra_descripcion").css('border','');
        });

        function getMuestras() {
            $.ajax({
                url: '{{ route("getMuestras") }}',
                type: 'GET',
                dataType: 'json',
                success : (data) => {
                    console.log(data);
                    if (data.length !== null) {
                        $(".tabla_muestras tbody").empty();
                        let cont = 1
                        data.forEach((muestra)=>{
                            const muestraRow = `<tr><td hidden>${muestra.id}</td><td class="text-right"><strong>${cont++}</strong></td><td>${muestra.nombre}</td><td>${muestra.descripcion}</td><td class="text-center"><div class="btn-group">
                                                    <button data-toggle="modal" data-target="#modal_actualizar_muestra" class="btn btn-sm btn-outline-warning btnEditarMuestra"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger btnDeleteMuestra"><i class="fas fa-trash-alt"></i></button>
                                                </div></td></tr>`;
                            $(".tabla_muestras tbody").append(muestraRow);
                        });
                    }
                }
            });
        }
        
        getMuestras();

        $(document).on('click', '#btnRegisterMuestra', (e) => {
            e.preventDefault();
            let vacio = "";
            if ($("#muestra_nombre").val() == "") {
                vacio = "NOMBRE";
                $("#muestra_nombre").css('border', '1px solid #E91C2B')
                $('#muestra_nombre').trigger('focus');
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
                datos.append('muestra_nombre', $("#muestra_nombre").val());
                datos.append('muestra_descripcion', $("#muestra_descripcion").val());

                $.ajax({
                    url: '{{ route("muestra.store") }}',
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
                            text: 'Muestra registrada',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        if (window.location.href.indexOf("/muestras") > -1) {
                            getMuestras();
                            $("#formulario_crear_muestra").trigger('reset');
                            $("#muestra_nombre").css('border', '');
                            $("#muestra_descripcion").css('border','');
                            //document.querySelector('#modal_crear_muestra .btn-close').click();
                            $('#modal_crear_muestra .btn-close').trigger('click');
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
        })

        $(document).on('click', '.btnEditarMuestra', (event) => {
            let id = $(event.currentTarget).closest('tr').find('td:eq(0)').text();
            $.ajax({
                url: '{{ route("muestra.edit", ":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success: (data) => {
                    console.log(data);
                    $(".muestra_id_update").val(data.id);
                    $(".muestra_nombre_update").val(data.nombre);
                    $(".muestra_nombre_update").css('border', data.nombre !== null ? '2px solid #40CC6C' : '');
                    $(".muestra_descripcion_update").val(data.descripcion);
                    $(".muestra_descripcion_update").css('border', data.descripcion !== null ? '2px solid #40CC6C' : '');
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
        });

        $(document).on('click', '.btnUpdateMuestra', (event) => {
            event.preventDefault();
            let vacio = "";
            if ($("#muestra_nombre_update").val() == "") {
                vacio = "NOMBRE";
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
                datos.append('muestra_nombre_update', $(".muestra_nombre_update").val());
                datos.append('muestra_descripcion_update', $(".muestra_descripcion_update").val());

                $.ajax({
                    url: '{{ route("muestra.update", ":id") }}'.replace(":id", $(".muestra_id_update").val()),
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
                            text: 'Muestra Actualizada',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        getMuestras();
                        $('#modal_actualizar_muestra .btn-close').trigger('click');
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

        $(document).on('click', '.btnDeleteMuestra', (event) => {
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
                        url: '{{ route("muestra.destroy", ":id") }}'.replace(":id", id),
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire({
                                title: '¡Exito!',
                                text: 'Muestra Eliminada',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            getMuestras();
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
        
    });
</script>