<script type="text/javascript">
    //para ESTUDIOS---------------------------------------
    //console.log('estas en estudios.funciones_estudios')
    $(document).ready(function(){
        $('#modal_crear_estudio').on('shown.bs.modal', function () {
            $('#est_nombre').trigger('focus');
        });
        $("#modal_crear_procedimiento").on("shown.bs.modal", function() {
            cargarTablaProcedimiento();
            $("#proc_nombre").trigger('focus');
        });
        $("#btnCloseAddEstudio").on('click', function() {
            $("#formulario_crear_estudio").trigger('reset');
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
                text: 'Configurar Tipo de Estudio',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#4CAF50',
                cancelButtonColor: '#2196F3',
                confirmButtonText: 'Estudio Individual',
                cancelButtonText: 'Estudio por Componente'
            }).then((result) => {
                if (result.isConfirmed) {
                    var tipo = 'INDIVIDUAL';
                    var datos = new FormData();
                    datos.append('tipo', tipo);
                    updateTipoEstudio(det_est_id, datos);
                }else if(result.dismiss === Swal.DismissReason.cancel){
                    var tipo = 'COMPONENTE';
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
                title: est_nombre,
                text: 'Configurar Tipo de Estudio',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#2196F3',
                cancelButtonColor: '#C82333',
                confirmButtonText: 'Estudio por Componente',
                cancelButtonText: 'Borrar tipo'
            }).then((result) => {
                if (result.isConfirmed) {
                    var tipo = 'COMPONENTE';
                    var datos = new FormData();
                    datos.append('tipo', tipo);
                    updateTipoEstudio(det_est_id, datos);
                }else if(result.dismiss === Swal.DismissReason.cancel){
                    var tipo = 'null';
                    var datos = new FormData();
                    datos.append('tipo', tipo);
                    updateTipoEstudio(det_est_id, datos);
                }
            });
        });
        $(document).on('click', '.btn-tipo-componente', function() {
            var det_est_id = $(this).closest('tr').find('td:eq(0)').text();
            var est_nombre = $(this).closest('tr').find('td:eq(2)').text();
            Swal.fire({
                title: est_nombre,
                text: 'Configurar Tipo de Estudio',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#4CAF50',
                cancelButtonColor: '#C82333',
                confirmButtonText: 'Estudio Individual',
                cancelButtonText: 'Borrar tipo'
            }).then((result) => {
                if (result.isConfirmed) {
                    var tipo = 'INDIVIDUAL';
                    var datos = new FormData();
                    datos.append('tipo', tipo);
                    updateTipoEstudio(det_est_id, datos);
                }else if(result.dismiss === Swal.DismissReason.cancel){
                    var tipo = 'null';
                    var datos = new FormData();
                    datos.append('tipo', tipo);
                    updateTipoEstudio(det_est_id, datos);
                }
            });
        });

        function getDetalle(valor, successCallback) {
            var id = valor;
            $.ajax({
                url: '{{ route("getDetalle", ":id") }}'.replace(':id', id),
                type: "GET",
                dataType: "json",
                success: function(data) {
                    successCallback(data.id);
                }
            });
        }

        function mostrarCargando() {
            Swal.fire({
                title: 'Espere...',
                text: 'Cargando datos.',
                icon: 'info',
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                },
                allowOutsideClick: false,
                allowEscapeKey: false
            });
        }
        function cerrarCargando() {
            Swal.close();
        }

        function getProcEstudio(valor, successCallback){
            $.ajax({
                url: '{{ route("getProcedimientoEstudio", ":id") }}'.replace(':id', valor),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length == 0) {
                        successCallback(0);
                    }else{
                        successCallback(data[0].id);
                    }
                }
            });
        }
        
        $(document).on('click', '.btn-detalle-comp-id', function() {
            // var valor = $(this).data('id');
            // $("#proc_est_id").val(valor);
            // cargarTablaDetalleProcedimiento(valor);
            var valor = $(this).closest('tr').find('td:eq(0)').text();
            var nombre = $(this).closest('tr').find('td:eq(2)').text();
            $(".proc_est_id").val(valor);
            $(".proc_est_nombre").val(nombre);
            cargarTablaDetalleProcedimiento(valor);
            mostrarCargando();
            getProcEstudio(valor, function(data) {
                var proc_id = data;
                cargarTablaProcComp(valor, proc_id);
                cerrarCargando();
            });
        });

        $(document).on('click', '.btn-detalle-indi-id', function() {
            var valor = $(this).closest('tr').find('td:eq(0)').text();
            var nombre = $(this).closest('tr').find('td:eq(2)').text();
            $(".proc_est_id").val(valor);
            $(".proc_est_nombre").val(nombre);
            cargarTablaDetalleProcedimiento(valor);
            mostrarCargando();
            getProcEstudio(valor, function(data) {
                var proc_id = data;
                cargarTablaProcComp(valor, proc_id);
                cerrarCargando();
            });
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
                var datos = new FormData();
                datos.append('estado', 1);
                updateEstadoDetProc(det_proc_id, datos);
                $(this).closest('tbody').find('.proc_checked:not(:checked)').prop('disabled', true);
            }else{
                var datos = new FormData();
                datos.append('estado', 0);
                updateEstadoDetProc(det_proc_id, datos);
                $(this).closest('tbody').find('.proc_checked').prop('disabled', false);
            }
        });


        $(document).on('click', '.nombre', function() {
            var det_proc_id = $(this).closest('tr').find('td:eq(0)').text();
            var checkbox = $(this).closest('tr').find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked'));
            if (checkbox.is(':checked')) {
                var datos = new FormData();
                datos.append('estado', 1);
                updateEstadoDetProc(det_proc_id, datos);
            }else{
                var datos = new FormData();
                datos.append('estado', 0);
                updateEstadoDetProc(det_proc_id, datos);
            }
        })

        $(document).on('click', '.btn-config', function() {
            var det_id = $(this).data('id');
            getDetalle(det_id, function(data) {
                $("#det_id_proc").val(data);
            });
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
                                    '<td class="text-center"><a href="javascript:void(0);" data-id="'+ value.id+ '" data-route="{{ route("storeDetalleProc") }} " class="btn btn-sm btn-outline-success btn-add-proc" title="Usar este procedimiento"><i class="fas fa-plus-circle fa-lg"></i></a></td>'+
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
                    //console.log(data);
                    if (data.length != 0) {
                        $('#tabla_detalle_proc tbody').empty();
                        $.each(data, function(index, value) {
                            $(".proc_id").val(value.proc_id);
                            $('#tabla_detalle_proc tbody').append(
                                '<tr class="' + (value.estado == '0' ? '' : 'table-warning') + '"><td hidden>'+ value.id+'</td><td class="nombre" style="cursor: pointer;" title="Predeterminar">' + value.nombre + '</td><td hidden>'+ value.estado +'</td>'+
                                    '<td class="text-center"><a href="javascript:void(0);" data-id="'+ value.id+ '" data-route="{{ route("destroyDetalleProc", ":id") }} " class="btn btn-sm btn-outline-danger btn-delete-detproc" title="Eliminar procedimiento"><i class="fas fa-trash-alt"></i></a></td>'+
                                    '<td class="text-center"><div class="form-check"><input type="checkbox" class="form-check-input proc_checked" ' + (value.estado == '1' ? ' checked' : '') + ' name="proc_checked" id="proc_checked" title="Predeterminar"></div></td>'+
                                '</tr>');
                        });
                        $(".btn-config").css({"pointer-events": "none", "opacity": "0.5"});
                    }else {
                        $(".btn-config").css({"pointer-events": "", "opacity": ""});
                        $(".proc_id").val('0');
                        $('#tabla_detalle_proc tbody').empty().append('<td colspan="2" class="text-center">No hay datos recepcionados</td>');
                    }
                }
            });
        }

        function cargarTablaProcComp(det_id, proc_id) {
            $.ajax({
                url: '/getCompProcedimientoEstudio/?q=' + det_id + '&f=' + proc_id,
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
                    if (data.length != 0) {
                        $('#tabla_proc_comp tbody').empty();
                        $.each(data, function(index, value) {
                            var umedid = value.umed_id;
                            var optionList = '';
                            @foreach ($unidades as $unidad)
                                var isSelected = {{ $unidad->id }} === umedid ? 'selected' : '' ;
                                optionList += '<option value="{{ $unidad->id }}" '+ isSelected + '>{{ $unidad->unidad }}</option>';
                            @endforeach
                            $('#tabla_proc_comp tbody').append(
                                '<tr>'+
                                    '<td hidden>'+ value.id+'</td>'+
                                    '<td hidden>' + value.comp_id + '</td>'+
                                    '<td hidden>' + value.umed_id + '</td>'+
                                    '<td>' + value.nombre + '</td>'+
                                    '<td>'+
                                        '<div class="form-group row">'+
                                            '<div class="col-md-12">'+
                                                '<select class="custom-select custom-select-sm proc_comp_unidad" name="proc_comp_unidad" id="proc_comp_unidad">'+
                                                    '<option value="" >Seleccionar...</option>'+
                                                    optionList +
                                                '</select>'+
                                            '</div>'+
                                        '</div>'+
                                    '</td>'+
                                    '<td><a href="#" class="btn btn-sm btn-outline-warning btn-config-parametro" data-toggle="modal" data-target="#modal_config_parametro" title="Agregar Parámetros"><i class="fas fa-cogs"></i></a></td'+
                                '</tr>'
                            );
                        });
                    }else {
                        $('#tabla_proc_comp tbody').empty().append('<td colspan="2" class="text-center">No hay datos recepcionados</td>');
                    }
                }
            });
        }
        $(document).on('click', '.btn-add-proc', function(e) {
            e.preventDefault();
            var proc_nombre = $(this).closest('tr').find('td:eq(1)').text();
            var est_nombre = $("#proc_est_nombre").val();
            Swal.fire({
                title: '¿Está seguro',
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
                            //console.log('La solicitud ha sido completada con éxito.');
                            Swal.fire({
                                title: 'Registrado',
                                text: 'Registro de Evento Exitoso',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            var valor = $(".proc_est_id").val();
                            cargarTablaDetalleProcedimiento(valor);
                            mostrarCargando();
                            getProcEstudio(valor, function(data) {
                                var proc_id = data;
                                cargarTablaProcComp(valor, proc_id);
                                cerrarCargando();
                            });
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
                        //console.log('La solicitud ha sido completada con éxito.');
                        Swal.fire({
                            title: 'Registrado',
                            text: 'Registro de Evento Exitoso',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        var valor = $(".proc_est_id").val();
                        cargarTablaDetalleProcedimiento(valor);
                        mostrarCargando();
                        getProcEstudio(valor, function(data) {
                            var proc_id = data;
                            cargarTablaProcComp(valor, proc_id);
                            cerrarCargando();
                        });
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
            console.log(dc+" "+comp_id);
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
                            $.ajax({
                                url: '{{ route("destroyDetComp.destroy", ":id") }}'.replace(":id", dc),
                                type: 'DELETE',
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(){
                                    $.ajax({
                                        url: '{{ route("componente.destroy", ":id") }}'.replace(":id", comp_id),
                                        type: 'DELETE',
                                        data: {
                                            "_token": "{{ csrf_token() }}"
                                        },
                                        success: function() {
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
                                            mostrarCargando();
                                            getProcEstudio(valor, function(data) {
                                                var proc_id = data;
                                                cargarTablaProcComp(valor, proc_id);
                                                cerrarCargando();
                                            });
                                        }, 2000);
                                        }
                                    });
                                }
                            });
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

        $(document).on('click', '.btn-config-parametro', function() {
            
        })

        $(document).on('change', '.parametro_proc_est', function() {
            if ($(this).val() == 'tablas') {
                $(".parametro_tabla").css('display', '');
                $(".parametro_sexoedad").css('display', 'none');
                $(".parametro_rango").css('display', 'none');
                $(".parametro_cualitativo").css('display', 'none');
                $(".parametro_texto").css('display', 'none');
            }else if ($(this).val() == 'sexoedades') {
                $(".parametro_tabla").css('display', 'none');
                $(".parametro_sexoedad").css('display', '');
                $(".parametro_rango").css('display', 'none');
                $(".parametro_cualitativo").css('display', 'none');
                $(".parametro_texto").css('display', 'none');
            }else if ($(this).val() == 'rangos') {
                $(".parametro_tabla").css('display', 'none');
                $(".parametro_sexoedad").css('display', 'none');
                $(".parametro_rango").css('display', '');
                $(".parametro_cualitativo").css('display', 'none');
                $(".parametro_texto").css('display', 'none');
            }else if ($(this).val() == 'cualitativos') {
                $(".parametro_tabla").css('display', 'none');
                $(".parametro_sexoedad").css('display', 'none');
                $(".parametro_rango").css('display', 'none');
                $(".parametro_cualitativo").css('display', '');
                $(".parametro_texto").css('display', 'none');
            }else if ($(this).val() == 'textos') {
                $(".parametro_tabla").css('display', 'none');
                $(".parametro_sexoedad").css('display', 'none');
                $(".parametro_rango").css('display', 'none');
                $(".parametro_cualitativo").css('display', 'none');
                $(".parametro_texto").css('display', '');
            }else{
                $(".parametro_tabla").css('display', 'none');
                $(".parametro_sexoedad").css('display', 'none');
                $(".parametro_rango").css('display', 'none');
                $(".parametro_cualitativo").css('display', 'none');
                $(".parametro_texto").css('display', 'none');
            }
        });

        $(document).on('click', '.btnAddValoresSexo', function() {
            $('#table_parametro_sexoedad tbody').append(
                '<tr>'+
                    '<td>'+
                        '<select class="custom-select custom-select-sm parametro_sexo_genero" name="parametro_sexo_genero" id="parametro_sexo_genero">'+
                            '<option value="" >Genero...</option>'+
                            '<option value="MASCULINO">MASCULINO</option>'+
                            '<option value="FENEMINO">FENEMINO</option>'+
                            '<option value="AMBOS">AMBOS</option>'+
                        '</select>'+
                    '</td>'+
                    '<td><input type="number" class="form-control form-control-sm parametro_sexo_edad_inicial"></td>'+
                    '<td><input type="number" class="form-control form-control-sm parametro_sexo_edad_final"></td>'+
                    '<td>'+
                        '<select class="custom-select custom-select-sm parametro_sexo_tiempo" name="parametro_sexo_tiempo" id="parametro_sexo_tiempo">'+
                            '<option value="" >Tiempo...</option>'+
                            '<option value="AÑOS">AÑOS</option>'+
                            '<option value="MESES">MESES</option>'+
                            '<option value="DIAS">DIAS</option>'+
                        '</select>'+
                    '</td>'+
                    '<td><input type="number" class="form-control form-control-sm parametro_sexo_valor_inicial" name="parametro_sexo_valor_inicial" id="parametro_sexo_valor_inicial"></td>'+
                    '<td><input type="number" class="form-control form-control-sm parametro_sexo_valor_final" name="parametro_sexo_valor_final" id="parametro_sexo_valor_final"></td>'+
                    '<td><input type="text" class="form-control form-control-sm parametro_sexo_interpretacion" name="parametro_sexo_interpretacion" id="parametro_sexo_interpretacion"></td>'+
                    '<td><button type="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></button></td>'+
                '</tr>'
            );
        });

        $(document).on('click', '.btnAddValoresRango', function() {
            $('#table_parametro_rango tbody').append(
                '<tr>'+
                    '<td><input type="number" class="form-control form-control-sm parametro_rango_valor_inicial" name="parametro_rango_valor_inicial" id="parametro_rango_valor_inicial"></td>'+
                    '<td><input type="number" class="form-control form-control-sm parametro_rango_valor_final" name="parametro_rango_valor_final" id="parametro_rango_valor_final"></td>'+
                    '<td><input type="text" class="form-control form-control-sm parametro_rango_interpretacion" name="parametro_rango_interpretacion" id="parametro_rango_interpretacion"></td>'+
                    '<td><button type="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></button></td>'+
                '</tr>'
            );
        })
    });
</script>