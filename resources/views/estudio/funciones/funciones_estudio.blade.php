<script type="text/javascript">
    //para ESTUDIOS---------------------------------------
    //console.log('estas en estudios.funciones_estudios')
    $(document).ready(function(){
        //filtroTabla('#search_estudio', '#tabla_estudios');
        filtroTabla('#comp_nombre', '#tabla_componentes');
        filtroTabla('#proc_nombre', '#tabla_procedimiento');
        filtroTabla('#asp_nombre', '#tabla_aspectos');
        filtroTabla('#search_material', '#tabla_lista_materiales');

        $("#tabla_estudios").dataTable({
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

        $('#modal_crear_estudio').on('shown.bs.modal', function () {
            $('#est_nombre').trigger('focus');
        });
        $('#modal_crear_componente').on('shown.bs.modal', function () {
            $('#comp_nombre').trigger('focus');
        });
        $("#modal_crear_procedimiento").on("shown.bs.modal", function() {
            cargarTablaProcedimiento();
            $("#proc_nombre").trigger('focus');
        });
        $("#btnCloseAddEstudio").on('click', function() {
            $("#formulario_crear_estudio").trigger('reset');
        });
        $("#btnCloseAddProc").on('click', function() {
            $("#formulario_crear_procedimiento").trigger('reset');
        });
        $("#btnCloseAddComponente").on('click', function() {
            $("#formulario_crear_componentes").trigger('reset');
        });
        $('#modal_crear_grupo').on('shown.bs.modal', function () {
            $('#grupos_nombre').trigger('focus');
        });
        $("#btnCloseAddGrupo").on('click', function() {
            $("#grupos_nombre").val('');
        });
        $('#modal_crear_subgrupo').on('shown.bs.modal', function () {
            $('#subgrupos_nombre').trigger('focus');
        });
        $("#btnCloseAddSubGrupo").on('click', function() {
            $("#subgrupos_nombre").val('');
        });

        function getGrupo() {
            mostrarCargando()
            $.ajax({
                url: '{{ route("getGrupos") }}',
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    if (data.length !== 0) {
                        $("#est_grupo").empty();
                        $.each(data, function(index, grupo) {
                            var option = $("<option>").val(grupo.id).text(grupo.nombre);
                            $("#est_grupo").append(option);
                        });
                    }
                    cerrarCargando();
                }
            });
        }

        function getSubgrupo() {
            mostrarCargando();
            $.ajax({
                url: '{{ route("getSubgrupos") }}',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data.length !== 0) {
                        $("#est_subgrupo").empty();
                        $.each(data, function(indez, subgrupo) {
                            var option = $("<option>").val(subgrupo.id).text(subgrupo.nombre);
                            $("#est_subgrupo").append(option);
                        })
                    }
                    cerrarCargando();
                }
            });
        }

        $(document).on('click', '.btnAddEstudio', function() {
            getGrupo();
            getSubgrupo();
        });

        $(document).on('click', '#btnRegisterGrupo', function() {
            var datos = new FormData();
            datos.append('grupos_nombre', $("#grupos_nombre").val());
            $.ajax({
                url: '{{ route("grupo.store") }}',
                method: "POST",
                data: datos,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    Swal.fire({
                        title: '¡Exito!',
                        text: 'Grupo registrado',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $("#grupos_nombre").val('');
                    getGrupo();
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

        $(document).on('click', '#btnRegisterSubGrupo', function() {
            var datos = new FormData();
            datos.append('subgrupos_nombre', $("#subgrupos_nombre").val());
            $.ajax({
                url: '{{ route("subgrupo.store") }}',
                method: "POST",
                data: datos,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    Swal.fire({
                        title: '¡Exito!',
                        text: 'Sub Grupo registrado',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $("#subgrupos_nombre").val('');
                    getSubgrupo();
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
                document.getElementById('est_cod').value = clave;
            } else {
                document.getElementById('est_cod').value = '';
            }
        });

        $('#btnRegisterEst').on('click', function(event) {
            event.preventDefault();
            if ($("#est_cod").val() == "" || $("#est_nombre").val() == "" || $("#est_precio").val() == "" || $("#est_moneda").val() == "" || $("#est_muestra").val() == "" || $("#est_indicaciones").val() == "" ) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Algunos campos son requeridos',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                $subgrupo = $("#est_subgrupo").val() == null ? '' : $("#est_subgrupo").val();
                var datos = new FormData();
                datos.append('est_cod', $("#est_cod").val());
                datos.append('est_nombre', $("#est_nombre").val());
                datos.append('est_descripcion', $("#est_descripcion").val());
                datos.append('est_grupo', $("#est_grupo").val());
                datos.append('est_subgrupo', $subgrupo);
                datos.append('est_precio', $("#est_precio").val());
                datos.append('est_moneda', $("#est_moneda").val());
                datos.append('est_muestra', $("#est_muestra").val());
                datos.append('est_recipiente', $("#est_recipiente").val());
                datos.append('est_indicaciones', $("#est_indicaciones").val());
    
                $.ajax({
                    url: '{{ route("estudio") }}',
                    type: 'POST',
                    data: datos,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        Swal.fire({
                            title: '¡Exito!',
                            text: 'Estudio registrado',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        location.reload();
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

        $(document).on('click', '.btn-delete-estudio', function() {
            Swal.fire({
                title: 'Oops... No tienes permiso de eliminar',
                text: 'Contacta con el administrador.',
                icon: 'error',
                showConfirmButton: false,
                timer: 2000
            });
        });

        function updateTipoEstudio(det_id, datos) {
            $.ajax({
                url:"{{ route('detalle.update', ':id') }}".replace(':id', det_id),
                type: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-HTTP-Method-Override': 'PUT'
                },
                success: function (response) {
                    Swal.fire({
                        title: '¡Exito!',
                        text: 'Tipo de estudio registrado',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    location.reload();
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

        $(document).on('click', '.btn-tipo-estudio', function() {
            var det_est_id = $(this).closest('tr').find('td:eq(0)').text();
            var est_nombre = $(this).closest('tr').find('td:eq(2)').text();
            Swal.fire({
                title: est_nombre,
                text: '¿Habilitar estudio?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4CAF50',
                cancelButtonColor: '#D33',
                confirmButtonText: 'Si, Habilitar',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    var tipo = 'HABILITADO';
                    var datos = new FormData();
                    datos.append('tipo', tipo);
                    updateTipoEstudio(det_est_id, datos);
                }
            });
        });

        $(document).on('click', '.btn-tipo-individual', function() {
            var det_est_id = $(this).closest('tr').find('td:eq(0)').text();
            var est_nombre = $(this).closest('tr').find('td:eq(2)').text();
            Swal.fire({
                title: '¿Esta seguro?',
                text: 'Si lo deshabilita no podrá usar el estudio para configura ni recepcionar.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2196F3',
                cancelButtonColor: '#D33',
                confirmButtonText: 'Si, Deshabilitar',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    var tipo = 'DESHABILITADO';
                    var datos = new FormData();
                    datos.append('tipo', tipo);
                    updateTipoEstudio(det_est_id, datos);
                }
            });
        });

        function getDetalle(valor, tipo_est) {
            var id = valor;
            $.ajax({
                url: '{{ route("getDetalle", ":id") }}'.replace(':id', id),
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $("#det_id_proc").val(data.id);
                    $("#proc_tipo_estudio").val(tipo_est);
                }
            });
        }
               
        function getComponenteDp(valor) {
            $.ajax({
                url: '{{ route("getComponenteDp", ":id") }}'.replace(":id", valor),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length != 0) {
                        $('.tabla_proc_comp tbody').empty();
                        $.each(data, function(index, value) {
                            $('.tabla_proc_comp tbody').append(
                                '<tr><td hidden>' + value.id + '</td>'+
                                    '<td>' + value.nombre + '</td>'+
                                    '<td class="text-center">'+
                                        '<a href="javascript:void(0);" data-toggle="modal" data-target="#modal_crear_aspecto" class="btn btn-sm btn-outline-info btn-add-asp" title="Agregar Prueba"><i class="fas fa-cogs"></i></a>'+
                                        '<a href="javascript:void(0);"  class="btn btn-sm btn-outline-danger btn-del-comp" title="Eliminar Componente"><i class="fas fa-trash-alt"></i></a>'+
                                    '</td>'+
                                '</tr>');
                        });
                    }else {
                        $('.tabla_proc_comp tbody').empty().append('<td colspan="3" class="text-center">No hay datos recepcionados</td>');
                    }
                }
            });
        }

        function getComponenteEstudio(det_id) {
            $.ajax({
                url: '{{ route("getComponenteEstudio", ":id") }}'.replace(":id", det_id),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length != 0) {
                        var dp_id = data[0].id;
                        $(".dp_id").val(dp_id);
                        $(".datos_componentes").css('display', '');
                        getComponenteDp(dp_id);
                    }else{
                        $(".dp_id").val("");
                        $(".datos_componentes").css('display', 'none');
                    }
                }
            });
        }

        $(document).on('click', '.btn-detalle-indi-id', function() {
            var valor = $(this).closest('tr').find('td:eq(0)').text();
            var nombre = $(this).closest('tr').find('td:eq(2)').text();
            $(".proc_est_id").val(valor);
            $(".proc_est_nombre").val(nombre);
            $(".proc_est_tipo_estudio").val('individual');
            cargarTablaDetalleProcedimiento(valor);
            getComponenteEstudio(valor);
        });

        function updateEstadoDetProc(dato_id, datos) {
            $.ajax({
                url:"{{ route('detalleprocedimiento.update', ':id') }}".replace(':id', dato_id),
                type: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-HTTP-Method-Override': 'PUT'
                },
                success: function (response) {
                    var valor = $("#proc_est_id").val();
                    cargarTablaDetalleProcedimiento(valor);
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error('Error en la solicitud: ', textStatus, ', detalles: ', errorThrown);
                }
            });
        }

        $(document).on('change', '.proc_checked', function() {
            var det_proc_id = $(this).closest('tr').find('td:eq(0)').text();
            if ($(this).is(':checked')) {
                mostrarCargando();
                var datos = new FormData();
                datos.append('estado', 1);
                updateEstadoDetProc(det_proc_id, datos);
                dp_id = $(this).closest('tr').find('td:eq(0)').text();
                $(".dp_id").val(dp_id);
                $(".datos_componentes").css('display', '');
                getComponenteDp(dp_id);
                cerrarCargando();
            }else{
                mostrarCargando();
                var datos = new FormData();
                datos.append('estado', 0);
                updateEstadoDetProc(det_proc_id, datos);
                $(".dp_id").val("");
                $(".datos_componentes").css('display', 'none');
                $('#tabla_proc_comp tbody').empty().append('<td colspan="3" class="text-center">No hay datos recepcionados</td>');
                cerrarCargando();
            }
        });


        $(document).on('click', '.nombre', function() {
            var det_proc_id = $(this).closest('tr').find('td:eq(0)').text();
            var checkbox = $(this).closest('tr').find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked'));
            if (checkbox.is(':checked')) {
                mostrarCargando();
                var datos = new FormData();
                datos.append('estado', 1);
                updateEstadoDetProc(det_proc_id, datos);
                dp_id = $(this).closest('tr').find('td:eq(0)').text();
                $(".dp_id").val(dp_id);
                $(".datos_componentes").css('display', '');
                getComponenteDp(dp_id);
                cerrarCargando();
            }else{
                mostrarCargando()
                var datos = new FormData();
                datos.append('estado', 0);
                updateEstadoDetProc(det_proc_id, datos);
                $(".dp_id").val("");
                $(".datos_componentes").css('display', 'none');
                $('#tabla_proc_comp tbody').empty().append('<td colspan="3" class="text-center">No hay datos recepcionados</td>');
                cerrarCargando();
            }
        });

        $(document).on('click', '.btn-config', function() {
            var det_id = $(this).data('id');
            getDetalle(det_id, 'individual');
        });

        function cargarTablaProcedimiento() {
            $.ajax({
                url: '{{ route("getAllProcedimiento") }}',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length != 0) {
                        $('#tabla_procedimiento tbody').empty();
                        $.each(data, function(index, value) {
                            $('#tabla_procedimiento tbody').append(
                                '<tr><td hidden>' + value.id + '</td>'+
                                    '<td>' + value.nombre + '</td>'+
                                    '<td class="text-center"><a href="javascript:void(0);" class="btn btn-sm btn-outline-success btn-add-proc" title="Usar este procedimiento"><i class="fas fa-plus-circle fa-lg"></i></a></td>'+
                                '</tr>');
                        });
                    }else {
                        $('#tabla_procedimiento tbody').empty().append('<td colspan="3" class="text-center">No hay datos recepcionados</td>');
                    }
                }
            });
        }

        function cargarTablaDetalleProcedimiento(valor) {
            $.ajax({
                url: "{{ route('tabla_procedimiento', ':id') }}".replace(':id', valor),
                type: "GET",
                dataType: "json",
                success: function(data) {
                    if (data.length != 0) {
                        $('#tabla_detalle_proc tbody').empty();
                        $.each(data, function(index, value) {
                            $(".proc_id").val(value.proc_id);
                            $('#tabla_detalle_proc tbody').append(
                                '<tr><td hidden>'+ value.id+'</td>'+
                                    '<td class="nombre text-right" title="Predeterminar"><a class="btn btn-sm ' + (value.estado == '1' ? 'btn-warning btn-deshabilitado' : 'btn-outline-warning btn-habilitado') + ' ">' + value.nombre + '</a></td>'+
                                    '<td hidden>'+ value.estado +'</td>'+
                                    '<td class="text-center"><a href="javascript:void(0);" data-id="'+ value.id+ '" data-route="{{ route("destroyDetalleProc", ":id") }} " class="btn btn-sm btn-outline-danger btn-delete-detproc" title="Eliminar procedimiento"><i class="fas fa-trash-alt"></i></a></td>'+
                                    '<td class="text-center"><div class="form-check"><input type="checkbox" class="form-check-input proc_checked" ' + (value.estado == '1' ? ' checked' : '') + ' name="proc_checked" id="proc_checked" title="Predeterminar"></div></td>'+
                                '</tr>');
                        });
                        
                    }else {
                        $(".dp_id").val("");
                        $(".datos_componentes").css('display', 'none');
                        $(".proc_id").val('0');
                        $('#tabla_detalle_proc tbody').empty().append('<td colspan="2" class="text-center">No hay datos recepcionados</td>');
                    }
                }
            });
        }

        $(document).on('click', '.btn-add-proc', function(e) {
            e.preventDefault();
            var proc_nombre = $(this).closest('tr').find('td:eq(1)').text();

            var filaTabla2 = $('#tabla_detalle_proc tbody tr').filter(function() {
                return $(this).find('td:eq(1)').text() == proc_nombre;
            });
            if (filaTabla2.length > 0) {
                Swal.fire({
                    title: 'Oops...',
                    text: 'Ya se encuentra agregado',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1000
                });
            } else {
                Swal.fire({
                    title: '¿Está seguro?',
                    text: '¿Desea utilizar el procedimiento '+ proc_nombre+ '?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#40CC6C',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, continuar',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).attr('data-dismiss', 'modal');
                        var proc_id = $(this).closest('tr').find('td:eq(0)').text();
                        var det_id = $("#det_id_proc").val();
                        var est_nombre = $("#proc_est_nombre").val();
                        var datos = new FormData();
                        datos.append('det_id', det_id);
                        datos.append('proc_id', proc_id);
                        datos.append('nombre', est_nombre);
                        $.ajax({
                            url:"{{ route('storeDetalleProc') }}",
                            method:"POST",
                            data: datos,
                            contentType: false,
                            processData: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                Swal.fire({
                                    title: 'Registrado',
                                    text: 'Registro de Evento Exitoso',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                var valor = $(".proc_est_id").val();
                                cargarTablaDetalleProcedimiento(valor);
                                cargarTablaProcedimiento();
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
                    }else{
                        $("#proc_nombre").focus();
                    }
                });
            }
        });
        
        $("#btnRegisterProc").on('click', function() {
            event.preventDefault();
            $(this).attr('data-dismiss', '');
            if ($("#proc_nombre").val() != "" && $("#proc_metodo").val() !== null) {
                $(this).attr('data-dismiss', 'modal');
                var datos = new FormData();
                datos.append('proc_nombre', $("#proc_nombre").val());
                datos.append('proc_metodo', $("#proc_metodo").val());
                datos.append('det_id', $("#det_id_proc").val());
                datos.append('nombre', $("#proc_est_nombre").val());
                $.ajax({
                    url:"{{ route('procedimiento') }}",
                    method:"POST",
                    data: datos,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        Swal.fire({
                            title: 'Registrado',
                            text: 'Registro de Evento Exitoso',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        var valor = $(".proc_est_id").val();
                        cargarTablaDetalleProcedimiento(valor);
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
            }else{
                Swal.fire({
                    title: 'Oops...',
                    text: 'Faltan datos, revise por favor',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
                $("#proc_nombre").focus();
            }
        })

        $(document).on('click', '.btn-delete-detproc', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var route = $(this).data('route');
            var dc = $("#tabla_proc_comp tr:first td:eq(0)").text();
            var comp_id = $("#tabla_proc_comp tr:first td:eq(1)").text();
            var tipo_estutio = $("#proc_est_tipo_estudio").val();
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
                        url: route.replace(":id", id),
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            // if (tipo_estutio == 'individual') {
                            //     $.ajax({
                            //         url: '{{ route("destroyDetComp.destroy", ":id") }}'.replace(":id", dc),
                            //         type: 'DELETE',
                            //         data: {
                            //             "_token": "{{ csrf_token() }}"
                            //         },
                            //         success: function(){
                            //             $.ajax({
                            //                 url: '{{ route("componente.destroy", ":id") }}'.replace(":id", comp_id),
                            //                 type: 'DELETE',
                            //                 data: {
                            //                     "_token": "{{ csrf_token() }}"
                            //                 },
                            //                 success: function() {
                            //                         Swal.fire({
                            //                         title: '¡Eliminado!',
                            //                         text: response.success,
                            //                         icon: 'success',
                            //                         showConfirmButton: false,
                            //                         timer: 2000
                            //                     });
                            //                     setTimeout(function(){
                            //                         var valor = $(".proc_est_id").val();
                            //                         cargarTablaDetalleProcedimiento(valor);
                            //                     }, 2000);
                            //                 }
                            //             });
                            //         }
                            //     });
                            // }else{
                                Swal.fire({
                                    title: '¡Eliminado!',
                                    text: response.success,
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                setTimeout(function(){
                                    var valor = $(".proc_est_id").val();
                                    cargarTablaDetalleProcedimiento(valor);
                                }, 2000);
                            //}
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Error',
                                text: 'No se pudo realizar la operación.',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    });
                }
            });
        });

        function getTablaComponente() {
            $.ajax({
                url: '{{ route("getAllComponente") }}',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length != 0) {
                        $('.tabla_componentes tbody').empty();
                        $.each(data, function(index, value) {
                            $('.tabla_componentes tbody').append(
                                '<tr><td hidden>' + value.id + '</td>'+
                                    '<td>' + value.nombre + '</td>'+
                                    '<td class="text-center"><a href="javascript:void(0);" class="btn btn-sm btn-outline-success btn-use-comp" title="Usar Componente"><i class="fas fa-plus-circle fa-lg"></i></a></td>'+
                                '</tr>');
                        });
                    }else {
                        $('.tabla_componentes tbody').empty().append('<td colspan="3" class="text-center">No hay datos recepcionados</td>');
                    }
                }
            });
        }

        $(document).on('click', '.btn-add-comp', function() {
            $(".det_proc_id").val($(".dp_id").val());
            $(".nombre_estudio").val($(".proc_est_nombre").val());
            getTablaComponente();
        })

        function addComponenteDP(det_id, comp_nombre, comp_id) {
            var datos = new FormData();
            datos.append('det_id', det_id);
            datos.append('comp_nombre', comp_nombre);
            datos.append('comp_id', comp_id);
            $.ajax({
                url: "{{ route('updateDetalleComponente') }}",
                method: "POST",
                data: datos,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire({
                        title: 'Registrado',
                        text: 'Registro de Evento Exitoso',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    var dp_id = $(".dp_id").val();
                    getComponenteDp(dp_id);
                    getTablaComponente()
                    $("#formulario_crear_componentes").trigger('reset');
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

        $("#btnRegisterComp").on('click', function() {
            event.preventDefault();
            var dp_id = $("#det_proc_id").val();
            var com_nombre = $("#comp_nombre").val();
            var com_id = '0';
            addComponenteDP(dp_id, com_nombre, com_id);
        });

        $(document).on('click', '.btn-use-comp', function() {
            event.preventDefault();
            var dp_id = $("#det_proc_id").val();
            var com_nombre = $(this).closest('tr').find('td:eq(1)').text();
            var com_id = $(this).closest('tr').find('td:eq(0)').text();

            var valorNombre = $(this).closest('tr').find('td:eq(1)').text();
            var filaTabla2 = $('#tabla_proc_comp tbody tr').filter(function() {
                return $(this).find('td:eq(1)').text() == valorNombre;
            });
            if (filaTabla2.length > 0) {
                Swal.fire({
                    title: 'Oops...',
                    text: 'Ya se encuentra agregado',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1000
                });
            } else {
                Swal.fire({
                    title: '¿Está seguro?',
                    text: '¿Desea utilizar el componente '+ com_nombre+ '?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#40CC6C',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, continuar',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        addComponenteDP(dp_id, 'asdq', com_id);
                    }
                });
            }
        });

        function tablaAspectos() {
            $.ajax({
                url: '{{ route("getAspectos") }}',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length != 0) {
                        $('.tabla_aspectos tbody').empty();
                        $.each(data, function(index, value) {
                            $('.tabla_aspectos tbody').append(
                                '<tr><td hidden>' + value.id + '</td>'+
                                    '<td>' + value.nombre + '</td>'+
                                    '<td class="text-center"><a href="javascript:void(0);" class="btn btn-sm btn-outline-info btn-use-asp" title="Usar Prueba"><i class="fas fa-greater-than fa-sm"></i></a></td>'+
                                '</tr>');
                        });
                    }else {
                        $('.tabla_aspectos tbody').empty().append('<td colspan="3" class="text-center">No hay datos recepcionados</td>');
                    }
                }
            });
        }

        function tablaAspectoParametro(valor) {
            $.ajax({
                url: '{{ route("getDPCAspecto",":id") }}'.replace(":id", valor),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length != 0) {
                        $('.tabla_dpc_parametro tbody').empty();
                        $.each(data, function(index, value) {
                            var umedid = value.umed_id;
                            var optionList = '';
                            @foreach ($unidades as $unidad)
                                var isSelected = {{ $unidad->id }} === umedid ? 'selected' : '' ;
                                optionList += '<option value="{{ $unidad->id }}" '+ isSelected + '>{{ $unidad->unidad }}</option>';
                            @endforeach
                            $('.tabla_dpc_parametro tbody').append(
                                '<tr><td hidden>' + value.id + '</td>'+
                                    '<td width="50px"><a class="btn btn-sm btn-outline-danger btn-delete-asp" title="Quitar"><i class="fas fa-minus-circle"></i></a></td>'+
                                    '<td width="180px">' + value.nombre + '</td>'+
                                    '<td width="100px">'+
                                        '<select class="custom-select custom-select-sm aspecto_unidad" name="aspecto_unidad" id="aspecto_unidad">'+
                                            '<option value="" >Seleccionar...</option>'+
                                            optionList +
                                        '</select>'+
                                    '</td>'+
                                    '<td class="text-center"><a data-toggle="modal" data-target="#modal_config_parametro" class="btn btn-sm ' + (value.cant_parametros == 0 ? 'btn-outline-warning' : 'btn-outline-success') + '  btn-conf-parametro" title="Agregar Parametro"><i class="fas fa-star-of-life"></i></a></td>'+
                                '</tr>');
                        });
                    }else {
                        $('.tabla_dpc_parametro tbody').empty().append('<td colspan="4" class="text-center">No hay datos recepcionados</td>');
                    }
                }
            });
        }

        $(document).on('click', '.btn-add-asp', function() {
            var dp_comp_id = $(this).closest('tr').find('td:eq(0)').text();
            var comp_nombre = $(this).closest('tr').find('td:eq(1)').text();
            $('.dp_comp_id').val(dp_comp_id);
            $('.lblComponente').text('Componente: ' + comp_nombre);
            tablaAspectos();
            tablaAspectoParametro(dp_comp_id);
        });

        function addAspecto(dp_comp_id, asp_nombre, asp_id) {
            mostrarCargando();
            var datos = new FormData();
            datos.append('dp_comp_id', dp_comp_id);
            datos.append('asp_nombre', asp_nombre);
            datos.append('asp_id', asp_id);
            $.ajax({
                url: '{{ route("aspecto") }}',
                type: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    tablaAspectos();
                    tablaAspectoParametro(dp_comp_id);
                    cerrarCargando();
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

        $("#btnRegisterAsp").on('click', function() {
            event.preventDefault();
            var dp_comp_id = $('.dp_comp_id').val();
            var asp_nombre = $(".asp_nombre").val();
            var asp_id = '0';
            addAspecto(dp_comp_id, asp_nombre, asp_id);
            $("#formulario_crear_aspectos").trigger('reset');
            $("#asp_nombre").focus();
        });

        $(document).on('click', '.btn-use-asp', function() {
            event.preventDefault();
            var dp_comp_id = $('.dp_comp_id').val();
            var asp_nombre = $(this).closest('tr').find('td:eq(1)').text();
            var asp_id = $(this).closest('tr').find('td:eq(0)').text();

            var valorNombre = $(this).closest('tr').find('td:eq(1)').text();
            var filaTabla2 = $('#tabla_dpc_parametro tbody tr').filter(function() {
                return $(this).find('td:eq(2)').text() == valorNombre;
            });
            if (filaTabla2.length > 0) {
                Swal.fire({
                    title: 'Oops...',
                    text: 'Ya se encuentra agregado',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1000
                });
            } else {
                addAspecto(dp_comp_id, 'aspqd', asp_id);
            }
        });

        $(document).on('click', '.btn-delete-asp', function() {
            var id = $(this).closest('tr').find('td:eq(0)').text();
            mostrarCargando();
            $.ajax({
                url: '{{ route("componente_aspectos.destroy", ":id") }}'.replace(":id", id),
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function (data) {
                    var dp_comp_id = $('.dp_comp_id').val();
                    tablaAspectoParametro(dp_comp_id);
                    cerrarCargando();
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
        });

        $(document).on('change', '.aspecto_unidad', function() {
            var id = $(this).closest('tr').find('td:eq(0)').text();
            var umed_id = $(this).val();
            var datos = new FormData();
            datos.append('umed_id', umed_id);
            $.ajax({
                url: '{{ route("componente_aspectos.update", ":id") }}'.replace(":id", id),
                type: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Hecho',
                        text: 'Dato registrado',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    var dp_comp_id = $('.dp_comp_id').val();
                    tablaAspectoParametro(dp_comp_id);
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
        });

        function getParametro(id) {
            $.ajax({
                url: '{{ route("getParametro", ":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length != 0) {
                        $('.table_parametro tbody').empty();
                        $.each(data, function(index, value) {
                            $('.table_parametro tbody').append(
                                '<tr>'+
                                    '<td hidden>'+value.id+'</td>'+
                                    '<td>'+
                                        '<select class="custom-select custom-select-sm parametro_genero" name="parametro_genero" id="parametro_genero">'+
                                            '<option value="" >Genero...</option>'+
                                            '<option value="MASCULINO" ' + (value.genero === 'MASCULINO' ? 'selected' : '') + '>MASCULINO</option>'+
                                            '<option value="FENEMINO" ' + (value.genero === 'FENEMINO' ? 'selected' : '') + '>FENEMINO</option>'+
                                            '<option value="AMBOS" ' + (value.genero === 'AMBOS' ? 'selected' : '') + '>AMBOS</option>'+
                                        '</select>'+
                                    '</td>'+
                                    '<td width="50px"><input type="number" value="' + (value.edad_inicial === null ? '0' : value.edad_inicial ) + '" class="form-control form-control-sm parametro_edad_inicial"></td>'+
                                    '<td width="50px"><input type="number" value="' + (value.edad_final === null ? '0' : value.edad_final ) + '" class="form-control form-control-sm parametro_edad_final"></td>'+
                                    '<td>'+
                                        '<select class="custom-select custom-select-sm parametro_tiempo" name="parametro_tiempo" id="parametro_tiempo">'+
                                            '<option value="" >Tiempo...</option>'+
                                            '<option value="AÑOS" ' + (value.genero === 'AÑOS' ? 'selected' : '') + '>AÑOS</option>'+
                                            '<option value="MESES" ' + (value.genero === 'MESES' ? 'selected' : '') + '>MESES</option>'+
                                            '<option value="DIAS" ' + (value.genero === 'DIAS' ? 'selected' : '') + '>DIAS</option>'+
                                        '</select>'+
                                    '</td>'+
                                    '<td width="50px"><input type="number" value="' + (value.valor_inicial === null ? '0' : value.valor_inicial ) + '" class="form-control form-control-sm parametro_valor_inicial" name="parametro_valor_inicial" id="parametro_valor_inicial"></td>'+
                                    '<td width="50px"><input type="number" value="' + (value.valor_final === null ? '0' : value.valor_final ) + '"" class="form-control form-control-sm parametro_valor_final" name="parametro_valor_final" id="parametro_valor_final"></td>'+
                                    '<td><input type="text" value="' + value.referencia + '"" class="form-control form-control-sm parametro_interpretacion" name="parametro_interpretacion" id="parametro_interpretacion"></td>'+
                                    '<td>'+
                                        '<div class="btn-group">'+
                                            '<button type="button" class="btn btn-sm btn-outline-warning btn-edit-parametro"><i class="fas fa-edit"></i></button>'+
                                            '<button type="button" class="btn btn-sm btn-outline-danger btn-delete-parametro-id"><i class="fas fa-trash-alt"></i></button>'+
                                        '</div>'+
                                    '</td>'+
                                '</tr>'
                            );
                        });
                    }else {
                        $('.table_parametro tbody').empty().append('<td colspan="9" class="text-center fila_vacia">No hay datos recepcionados</td>');
                    }
                }
            });
        }

        $(document).on('click', '.btn-conf-parametro', function() {
            var id = $(this).closest('tr').find('td:eq(0)').text();
            var aspecto_nombre = $(this).closest('tr').find('td:eq(2)').text();
            var medida = $(this).closest('tr').find('td:eq(3) select option:selected').text();
            if (medida == 'Seleccionar...') {
                unidad =  "";
            }else{
                unidad = " - " + medida;
            }
            $('.aspecto_nombre_parametro').text('Configurar Prueba: ' + aspecto_nombre + ' ' + unidad);
            $('.aspecto_id_parametro').val(id);
            getParametro(id);
        });

        $(document).on('click', '.btnAddValores', function() {
            $('.fila_vacia').remove();
            $('#table_parametro tbody').append(
                '<tr>'+
                    '<td hidden></td>'+
                    '<td>'+
                        '<select class="custom-select custom-select-sm parametro_genero" name="parametro_genero" id="parametro_genero">'+
                            '<option value="" >Genero...</option>'+
                            '<option value="MASCULINO">MASCULINO</option>'+
                            '<option value="FENEMINO">FENEMINO</option>'+
                            '<option value="AMBOS">AMBOS</option>'+
                        '</select>'+
                    '</td>'+
                    '<td width="50px"><input type="number" class="form-control form-control-sm parametro_edad_inicial"></td>'+
                    '<td width="50px"><input type="number" class="form-control form-control-sm parametro_edad_final"></td>'+
                    '<td>'+
                        '<select class="custom-select custom-select-sm parametro_tiempo" name="parametro_tiempo" id="parametro_tiempo">'+
                            '<option value="" >Tiempo...</option>'+
                            '<option value="AÑOS">AÑOS</option>'+
                            '<option value="MESES">MESES</option>'+
                            '<option value="DIAS">DIAS</option>'+
                        '</select>'+
                    '</td>'+
                    '<td width="50px"><input type="number" class="form-control form-control-sm parametro_valor_inicial" name="parametro_valor_inicial" id="parametro_valor_inicial"></td>'+
                    '<td width="50px"><input type="number" class="form-control form-control-sm parametro_valor_final" name="parametro_valor_final" id="parametro_valor_final"></td>'+
                    '<td><input type="text" class="form-control form-control-sm parametro_interpretacion" name="parametro_interpretacion" id="parametro_interpretacion"></td>'+
                    '<td>'+
                        '<div class="btn-group">'+
                            '<button type="button" class="btn btn-sm btn-outline-success btn-save-parametro"><i class="fas fa-save"></i></button>'+
                            '<button type="button" class="btn btn-sm btn-outline-danger btn-delete-parametro"><i class="fas fa-trash-alt"></i></button>'+
                        '</div>'+
                    '</td>'+
                '</tr>'
            );
        });

        $(document).on('click', '.btn-delete-parametro', function() {
            $(this).closest('tr').remove();
        });

        $(document).on('click', '.btn-save-parametro', function() {
            var ca_id = $(".aspecto_id_parametro").val();
            var genero = $(this).closest('tr').find('td:eq(1) select').val();
            var edad_inicial = $(this).closest('tr').find('td:eq(2) input').val();
            var edad_final = $(this).closest('tr').find('td:eq(3) input').val();
            var tiempo = $(this).closest('tr').find('td:eq(4) select').val();
            var valor_inicial = $(this).closest('tr').find('td:eq(5) input').val();
            var valor_final = $(this).closest('tr').find('td:eq(6) input').val();
            var interpretacion = $(this).closest('tr').find('td:eq(7) input').val();

            var datos = new FormData();
            datos.append('ca_id', ca_id);
            datos.append('genero', genero);
            datos.append('edad_inicial', edad_inicial);
            datos.append('edad_final', edad_final);
            datos.append('tiempo', tiempo);
            datos.append('valor_inicial', valor_inicial);
            datos.append('valor_final', valor_final);
            datos.append('referencia', interpretacion);

            $.ajax({
                url: '{{ route("parametros") }}',
                type: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire({
                        title: 'Hecho',
                        text: 'Parámetro registrado',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    var id = $('.aspecto_id_parametro').val();
                    getParametro(id);
                    var dp_comp_id = $('.dp_comp_id').val();
                    tablaAspectoParametro(dp_comp_id);
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
        });

        $(document).on('click', '.btn-edit-parametro', function() {
            var ca_id = $(".aspecto_id_parametro").val();
            var id = $(this).closest('tr').find('td:eq(0)').text();
            var genero = $(this).closest('tr').find('td:eq(1) select').val();
            var edad_inicial = $(this).closest('tr').find('td:eq(2) input').val();
            var edad_final = $(this).closest('tr').find('td:eq(3) input').val();
            var tiempo = $(this).closest('tr').find('td:eq(4) select').val();
            var valor_inicial = $(this).closest('tr').find('td:eq(5) input').val();
            var valor_final = $(this).closest('tr').find('td:eq(6) input').val();
            var interpretacion = $(this).closest('tr').find('td:eq(7) input').val();

            var datos = new FormData();
            datos.append('ca_id', ca_id);
            datos.append('genero', genero);
            datos.append('edad_inicial', edad_inicial);
            datos.append('edad_final', edad_final);
            datos.append('tiempo', tiempo);
            datos.append('valor_inicial', valor_inicial);
            datos.append('valor_final', valor_final);
            datos.append('referencia', interpretacion);

            $.ajax({
                url: '{{ route("parametros.update", ":id") }}'.replace(":id", id),
                type: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire({
                        title: 'Hecho',
                        text: 'Parámetros modificados',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    var id = $('.aspecto_id_parametro').val();
                    getParametro(id);
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
        });

        $(document).on('click', '.btn-delete-parametro-id', function() {
            var id= $(this).closest('tr').find('td:eq(0)').text();
            $.ajax({
                url: '{{ route("parametros.destroy", ":id") }}'.replace(":id", id),
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function (response) {
                    Swal.fire({
                        title: 'Hecho',
                        text: 'Parámetro eliminado',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    var id = $('.aspecto_id_parametro').val();
                    getParametro(id);
                    var dp_comp_id = $('.dp_comp_id').val();
                    tablaAspectoParametro(dp_comp_id);
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
        });

        function deldpcomponente(id, dp_id) {
            mostrarCargando();
            $.ajax({
                url: '{{ route("dpcomponente.destroy", ":id") }}'.replace(":id", id),
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    getComponenteDp(dp_id);
                    cerrarCargando();
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

        $(document).on('click', '.btn-del-comp', function() {
            var comp_id = $(this).closest('tr').find('td:eq(0)').text();
            var dp_id = $('.dp_id').val();
            deldpcomponente(comp_id, dp_id);
        });

        function getAllMaterial() {
            $.ajax({
                url: '{{ route("getAllMaterials") }}',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.length != 0) {
                        $('.tabla_lista_materiales tbody').empty();
                        $.each(data, function(index, value) {
                            $('.tabla_lista_materiales tbody').append(
                                '<tr>'+
                                    '<td hidden>'+value.id+'</td>'+
                                    '<td hidden>'+value.mat_id+'</td>'+
                                    '<td width="100px">'+ value.mat_nombre +'</td>'+
                                    '<td>'+ value.unidad +'</td>'+
                                    '<td hidden>'+ value.umed_id +'</td>'+
                                    '<td class="text-center" width="50px" style="vertical-align: middle;">'+
                                        '<button type="button" class="btn btn-sm btn-outline-info btn-use-material" title="Usar Material"><i class="fas fa-greater-than fa-sm"></i></button>'+
                                    '</td>'+
                                '</tr>'
                            );
                        });
                    }else {
                        $('.tabla_lista_materiales tbody').empty().append('<td colspan="3" class="text-center fila_vacia">No hay datos recepcionados</td>');
                    }
                }
            });
        }

        function getMaterialEstudio(id) {
            $.ajax({
                url: '{{ route("getMaterialEstudio",":id") }}'.replace(":id", id),
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data.length != 0) {
                        $('.tabla_material_estudio tbody').empty();
                        $.each(data, function(index, value) {
                            var umedid = value.umed_id;
                            var optionList = '';
                            @foreach ($unidades as $unidad)
                                var isSelected = {{ $unidad->id }} === umedid ? 'selected' : '' ;
                                optionList += '<option value="{{ $unidad->id }}" '+ isSelected + '>{{ $unidad->unidad }}</option>';
                            @endforeach
                            $('.tabla_material_estudio tbody').append(
                                '<tr>'+
                                    '<td hidden>'+value.id+'</td>'+
                                    '<td hidden>'+value.mat_id+'</td>'+
                                    '<td style="vertical-align: middle;">'+ value.mat_nombre +'</td>'+
                                    '<td hidden>'+ value.mat_cantidad +'</td>'+
                                    '<td hidden>'+ value.mat_precio_compra +'</td>'+
                                    '<td width="80px">'+
                                        '<select class="custom-select custom-select-sm detmat_unidad" name="detmat_unidad" id="detmat_unidad">'+
                                            '<option value="" >Seleccionar...</option>'+
                                            optionList +
                                        '</select>'+
                                    '</td>'+
                                    '<td width="80px"><input type="number" min="0" step="0.01" class="form-control form-control-sm detmat_cantidad" value="'+ (value.cantidad == null ? '': value.cantidad) +'""></td>'+
                                    '<td width="100px" class="text-right detmat_precio_total" style="vertical-align: middle;">'+ (value.precio_total == null ? '' : value.precio_total) +'</td>'+
                                    '<td width="40px"><a class="btn btn-sm btn-outline-danger btn-delete-det-mat" title="Quitar"><i class="fas fa-minus-circle"></i></a></td>'+
                                '</tr>'
                            );
                        });
                        $("#form_search_material").trigger("reset");
                        $("#search_material").focus();
                        getAllMaterial();
                    }else {
                        $('.tabla_material_estudio tbody').empty().append('<td colspan="7" class="text-center fila_vacia">No hay datos recepcionados</td>');
                    }
                }
            });
        }

        $(".btn-add-material-estudio").on('click', function() {
            var id_det_est = $(this).closest('tr').find('td:eq(0)').text();
            var est_nombre = $(this).closest('tr').find('td:eq(2)').text();
            var precio_est = $(this).closest('tr').find('td:eq(3)').text();
            $(".modal_agregar_materialLabel").text('Agregar Materiales: ' + est_nombre);
            $(".detmat_det_id").val(id_det_est);
            $(".cld-precio-estudio").text(precio_est);
            mostrarCargando();
            getAllMaterial();
            getMaterialEstudio(id_det_est);
            setTimeout(function(){
                sumPrecioMaterials();
                cerrarCargando();
            }, 500);
        });

        function addDetMat(det_id, datos) {
            mostrarCargando();
            $.ajax({
                url: '{{ route("detmaterial.store") }}',
                type: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    getMaterialEstudio(det_id);
                    cerrarCargando();
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

        $(document).on('click', '.btn-use-material', function() {
            var mat_id = $(this).closest('tr').find('td:eq(0)').text();
            var det_id = $(".detmat_det_id").val();
            var umed_id = $(this).closest('tr').find('td:eq(4)').text();

            var valorNombre = $(this).closest('tr').find('td:eq(2)').text();
            var filaTabla2 = $('#tabla_material_estudio tbody tr').filter(function() {
                return $(this).find('td:eq(2)').text() == valorNombre;
            });
            if (filaTabla2.length > 0) {
                Swal.fire({
                    title: 'Oops...',
                    text: 'El material ya se encuentra agregado',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1000
                });
            } else {
                var datos = new FormData();
                datos.append('det_id', det_id);
                datos.append('mat_id', mat_id);
                datos.append('umed_id', umed_id);
                addDetMat(det_id, datos);
            }
        });

        function delDetMat(id, det_id) {
            mostrarCargando()
            $.ajax({
                url: '{{ route("detmaterial.destroy", ":id") }}'.replace(":id", id),
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function() {
                    getMaterialEstudio(det_id);
                    setTimeout(function(){
                        sumPrecioMaterials();
                        cerrarCargando();
                    }, 500);
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

        $(document).on('click', '.btn-delete-det-mat', function() {
            var det_mat_id = $(this).closest('tr').find('td:eq(0)').text();
            var det_id = $(".detmat_det_id").val();
            delDetMat(det_mat_id, det_id);
            
        });

        function upDetMat(id, datos, det_id) {
            mostrarCargando();
            $.ajax({
                url: '{{ route("detmaterial.update", ":id") }}'.replace(":id", id),
                type: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    getMaterialEstudio(det_id);
                    cerrarCargando();
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

        $(document).on('change', '.detmat_unidad', function() {
            var det_id = $(".detmat_det_id").val();
            var det_mat_id = $(this).closest('tr').find('td:eq(0)').text();
            var mat_id = $(this).closest('tr').find('td:eq(1)').text();
            var unidad_id = $(this).val();
            var cantidad = $(this).closest('tr').find('td:eq(6) input').val();
            var precio_total = $(this).closest('tr').find('td:eq(7)').text();

            // var valorNombre = $(this).closest('tr').find('td:eq(2)').text();
            // var valorBuscado = $(this).closest('tr').find('td:eq(5) select option:selected').text();
            // const result = convertUnits(1, 'Km', 'Kg');
            // console.log(result); // Imprimirá "0.1"

            // var filaTabla2 = $('#tabla_lista_materiales tbody tr').filter(function() {
            //     return $(this).find('td:eq(2)').text() == valorNombre && $(this).find('td:eq(3)').text() == valorBuscado;
            // });

            // if (filaTabla2.length > 0) {
                // console.log('la unidad es la misma');
                var datos = new FormData();
                datos.append('det_id', det_id);
                datos.append('mat_id', mat_id);
                datos.append('cantidad', cantidad);
                datos.append('umed_id', unidad_id);
                datos.append('precio_total', precio_total);
                upDetMat(det_mat_id, datos, det_id);
            // } else {
            //     console.log('la unidad no es la misma');
            // }
        });

        $(document).on('change', '.detmat_cantidad', function() {
            var det_id = $(".detmat_det_id").val();
            var det_mat_id = $(this).closest('tr').find('td:eq(0)').text();
            var mat_id = $(this).closest('tr').find('td:eq(1)').text();
            var unidad_id = $(this).closest('tr').find('td:eq(5) select').val();
            var cantidad = $(this).closest('tr').find('td:eq(6) input').val();;
            var precio_total = $(this).closest('tr').find('td:eq(7)').text();

            var datos = new FormData();
            datos.append('det_id', det_id);
            datos.append('mat_id', mat_id);
            datos.append('cantidad', cantidad);
            datos.append('umed_id', unidad_id);
            datos.append('precio_total', precio_total);
            upDetMat(det_mat_id, datos, det_id);
            
        });

        $(document).on('keyup', '.detmat_cantidad', function() {
            var cantidad_total = $(this).closest('tr').find('td:eq(3)').text();
            var precio_compra = $(this).closest('tr').find('td:eq(4)').text();
            var cantidad = $(this).val();
            var precio_total = ((cantidad * precio_compra)/cantidad_total);
            $(this).closest('tr').find('td:eq(7)').text(precio_total);
            sumPrecioMaterials();
        });

        function sumPrecioMaterials() {
            const tabla = document.querySelector('.tabla_material_estudio');
            const filas = tabla.querySelectorAll('tbody tr');

            let suma = 0;

            filas.forEach((fila) => {
                const precio = parseFloat(fila.children[7].textContent);
                if (!isNaN(precio)) {
                    suma += precio;
                }
            });
            //console.log(suma.toFixed(4));
            $(".cld-precio").text(suma.toFixed(4));
            $(".cld-precio-literal").text('Son '+convertirNumeroALetras(suma.toFixed(2)));
            var id = $(".detmat_det_id").val();
            var datos = new FormData();
            datos.append('precio_est', suma.toFixed(2));
            $.ajax({
                url: '{{ route("updatePrecioEstudio", ":id") }}'.replace(':id', id),
                type: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log('hecho');
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

        function convertirNumeroALetras(numero) {
            const [parteEnteraStr, parteDecimalStr] = String(numero).split('.');
            const parteEntera = parseInt(parteEnteraStr, 10);
            const parteDecimal = parseInt(parteDecimalStr || '0', 10);

            let resultado = '';

            if (parteEntera > 0) {
                if (parteEntera === 1) {
                    resultado = 'un boliviano';
                } else {
                    resultado = `${numeroALetras(parteEntera)} bolivianos`;
                }
            }

            if (parteDecimal > 0) {
                const centavosEnLetras = (parteDecimal < 10 ? '0' : '') + parteDecimalStr;
                resultado += ` con ${centavosEnLetras}/100 centavos`;
            }

            return resultado;
        }

        function numeroALetras(numero) {
            const unidades = ['', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve'];
            const decenas = ['diez', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve'];
            const decenas2 = ['', '', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'];
            const centenas = ['', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos'];

            let resultado = '';

            if (numero < 0 || numero > 9999) {
                throw new Error('El número debe estar entre 0 y 9999');
            }

            if (numero === 0) {
                return 'cero';
            }

            if (numero >= 1000) {
                const millares = Math.floor(numero / 1000);
                resultado += `${numeroALetras(millares)} mil `;
                numero %= 1000;
            }

            if (numero >= 100) {
                resultado += `${centenas[Math.floor(numero / 100)]} `;
                numero %= 100;
            }

            if (numero >= 10 && numero < 20) {
                resultado += `${decenas[numero - 10]} `;
                numero = 0;
            }

            if (numero >= 20 || numero === 10) {
                resultado += `${decenas2[Math.floor(numero / 10)]} `;
                numero %= 10;
            }

            if (numero > 0) {
                resultado += `${unidades[numero]} `;
            }

            return resultado.trim();
        }


    });
</script>