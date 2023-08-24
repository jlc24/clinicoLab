<script>
    $(document).ready(function(){
        if (window.location.href.indexOf("/recipientes") > -1) {
            filtroTabla('#search_recipientes', '#tabla_recipientes');
        }
        $("#modal_crear_recipiente").on('shown.bs.modal', function () {
            $('#reci_descripcion').trigger('focus');
        });
        $("#btnCloseAddRecipiente").on('click', function(){
            $("#formulario_crear_recipiente").trigger('reset');
            $("#reci_descripcion").css('border', '');
        });

        function getRecipientes() {
            $.ajax({
                url: '{{ route("getRecipientes") }}',
                type: 'GET' ,
                dataType: 'json',
                success : (data) => {
                    if (data.length !== 0) {
                        $("#tabla_recipientes tbody").empty();
                        let cont = 1;
                        data.forEach((recipiente) => {
                            const recipienteRow = `<tr><td hidden>${recipiente.id}</td><td class="text-right"><strong>${cont++}</strong></td><td>${recipiente.descripcion}</td><td class="text-center"><div class="btn-group">
                                                    <button data-toggle="modal" data-target="#modal_actualizar_recipiente" class="btn btn-sm btn-outline-warning btnEditRecipiente"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger btnDeleteRecipiente"><i class="fas fa-trash-alt"></i></button>
                                                </div></td></tr>`;
                            $("#tabla_recipientes tbody").append(recipienteRow);
                        });
                    }else{
                        $("#tabla_recipientes tbody").empty().append('<td colspan="4" class="text-center">No hay recipientes registrados</td>');
                    }
                }
            });
        }

        getRecipientes();

        $(document).on('click', '#btnRegisterMed', (event) => {
            event.preventDefault();
            let vacio = "";
            if ($("#reci_descripcion").val() == "") {
                vacio = "DESCRIPCION";
                $("#reci_descripcion").css('border', '1px solid #E91C2B')
                $('#reci_descripcion').trigger('focus');
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
                datos.append('reci_descripcion',$('#reci_descripcion').val());

                $.ajax({
                    url: '{{ route("recipiente.store") }}',
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
                            text: 'Recipiente registrado',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        if (window.location.href.indexOf("/recipientes") > -1) {
                            getRecipientes();
                            $("#formulario_crear_recipientes").trigger('reset');
                            $("#reci_descripcion").css('border','');
                            $('#modal_crear_recipiente .btn-close').trigger('click');
                        }else{
                            $("#formulario_crear_recipientes").trigger('reset');
                            $("#reci_descripcion").css('border','');
                            $('#modal_crear_recipiente .btn-close').trigger('click');
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

        $(document).on('click', '.btnEditRecipiente', (event) => {
            let id = $(event.currentTarget).closest("tr").find("td:eq(0)").text();

            $.ajax({
                url: '{{ route("recipiente.edit",":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success: (data) => {
                    $(".reci_id_update").val(data.id);
                    $(".reci_descripcion_update").val(data.descripcion);
                    $(".reci_descripcion_update").css('border', data.descripcion != null ? '2px solid #40CC6C' : '');
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
        })

        $(document).on('click', '.btnUpdateRecipiente', (event) => {
            event.preventDefault();
            let vacio = "";
            if ($(".reci_descripcion_update").val() == "") {
                vacio = "DESCRIPCION";
                $("#reci_descripcion").css('border', '1px solid #E91C2B');
                $('#reci_descripcion').trigger('focus');
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
                datos.append('reci_descripcion_update', $(".reci_descripcion_update").val());

                $.ajax({
                    url: '{{ route("recipiente.update", ":id") }}'.replace(":id", $(".reci_id_update").val()),
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
                            text: 'Recipiente actualizado',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        getRecipientes();
                        $('#modal_actualizar_recipiente .btn-close').trigger('click');
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

        $(document).on('click', '.btnDeleteRecipiente', (event) => {
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
                        url: '{{ route("recipiente.destroy", ":id") }}'.replace(":id", id),
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire({
                                title: '¡Exito!',
                                text: 'Recipiente Eliminado',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            getRecipientes();
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