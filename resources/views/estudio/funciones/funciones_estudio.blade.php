@include('muestra.funciones.funcion_muestra')
@include('indication.funciones.funcion_indicacion')
@include('recipiente.funciones.funcion_recipiente')

<script type="text/javascript">
    //para ESTUDIOS---------------------------------------
    //console.log('estas en estudios.funciones_estudios')
    $(document).ready(function(){
        filtroTabla('#search_estudio', '#tabla_estudios');
        filtroTabla('#comp_nombre', '#tabla_componentes');
        filtroTabla('#proc_nombre', '#tabla_procedimiento');
        filtroTabla('#asp_nombre', '#tabla_aspectos');
        filtroTabla('#search_material', '#tabla_lista_materiales');

        function getEstudios() {
            mostrarCargando();
            $.ajax({
                url: '{{ route("getEstudios") }}',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.length != 0) {
                        $("#tabla_estudios tbody").empty();
                        const grupos = {};
                        data.forEach((estudio) => {
                            if (!grupos[estudio.grupo]) {
                                grupos[estudio.grupo] = {};
                            }
                            if (estudio.subgrupo !== null) {
                                if (!grupos[estudio.grupo][estudio.subgrupo]) {
                                    grupos[estudio.grupo][estudio.subgrupo] = [];
                                }
                                grupos[estudio.grupo][estudio.subgrupo].push(estudio);
                            }else{
                                if (!grupos[estudio.grupo][""]) {
                                    grupos[estudio.grupo][""] = [];
                                }
                                grupos[estudio.grupo][""].push(estudio);
                            }
                        });
    
                        Object.entries(grupos).forEach(([grupo, subgrupos]) => {
                            const grupoRow = `<tr style="background-color: #8CB8DC;"><td colspan="5"><strong>${grupo}</strong></td>`;
                            $("#tabla_estudios tbody").append(grupoRow);
                            Object.entries(subgrupos).forEach(([subgrupo, estudios]) => {
                                if (subgrupo !== "") {
                                    const subgrupoRow = `<tr style="background-color: #D3E4F3;"><td colspan="5"><strong>${subgrupo}</strong></td></tr>`;
                                    $("#tabla_estudios tbody").append(subgrupoRow);
                                }
                                
                                let cont = 1;
                                estudios.forEach((estudio) => {
                                    const tipo = estudio.tipo === 'HABILITADO' ? '<a href="javascript:void(0);" class="badge badge-success btn-tipo-individual" title="Tipo Estudio" style="font-size: 15px">Habilitado</a>' : '<a href="javascript:void(0);" class="badge badge-danger btn-tipo-estudio" title="Tipo Estudio" style="font-size: 15px">Deshabilitado</a>';
                                    const botonTipo = estudio.tipo === 'HABILITADO' ? '<button data-toggle="modal" data-target="#modal_configurar_estudio_individual" class="btn btn-sm btn-outline-info btn-detalle-indi-id" title="Configurar Estudio Individual"><i class="fas fa-cog"></i></button>' : '';
                                    const estudioRow = `<tr><td hidden>${estudio.id}</td><td class="text-right"><strong>${cont++}</strong></td><td>${estudio.est_cod}</td><td>${estudio.est_nombre}</td><td class="text-center">${tipo}</td><td><div class="btn-group">
                                                                        <button data-toggle="modal" data-target="#modal_editar_estudio" class="btn btn-sm btn-outline-warning btnEditEstudio" title="Editar Estudio"><i class="fas fa-user-edit"></i></button>
                                                                        ${botonTipo}</div></td></tr>`;
                                    $("#tabla_estudios tbody").append(estudioRow);
                                });
                            });
                            $("#tabla_estudios tbody").append('<br>');
                        });
                    }else{
                        $("#tabla_estudios tbody").empty().append('<td colspan="5" class="text-center">No hay datos recepcionados</td>')
                    }
                    cerrarCargando();
                }
            });
        }

        getEstudios();

        $('#modal_crear_estudio').on('shown.bs.modal', function () {
            $('#est_nombre').trigger("focus");
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
            limpiarEstudio();
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
            $("#grupos_nombre").css('border', '');
        });
        $('#modal_crear_subgrupo').on('shown.bs.modal', function () {
            $('#subgrupos_nombre').trigger('focus');
        });
        $("#btnCloseAddSubGrupo").on('click', function() {
            $("#subgrupos_nombre").val('');
            $("#subgrupos_nombre").css('border', '');
        });

        $("#btnCloseAddMuestra").on('click', function(){
            getMuestrasEstudio();
        });
        $("#btnCloseAddIndicacion").on('click', function(){
            getIndicacionesEstudio();
        });
        $("#btnCloseAddRecipiente").on('click', function(){
            getRecipientesEstudio();
        });

        function limpiarEstudio() {
            $("#est_cod").val("");
            $("#est_cod").css('border', '');
            $("#est_nombre").val("");
            $("#est_nombre").css('border', '');
            $("#est_descripcion").val("");
            $("#est_descripcion").css('border', '');
            $("#est_grupo").val("");
            $("#est_grupo").css('border', '');
            $("#est_subgrupo").val("");
            $("#est_subgrupo").css('border', '');
            $("#est_muestra").val("");
            $("#est_muestra").css('border', '');
            $("#est_recipiente").val("");
            $("#est_recipiente").css('border', '');
            $("#est_indicaciones").val();
            $("#est_indicaciones").css('border', '');
            $("#est_precio").val("0.00");
            $("#est_precio").css('border', '');
            
        }

        function getGrupo() {
            mostrarCargando()
            $.ajax({
                url: '{{ route("getGrupos") }}',
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    if (data.length !== 0) {
                        $("#est_grupo").empty();
                        const emptyOption = `<option value="" disabled selected>Seleccionar...</option>`;
                        $("#est_grupo").append(emptyOption);
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
                    if (data.length !== 0) {
                        $("#est_subgrupo").empty();
                        const emptyOption = `<option value="" >Seleccionar...</option>`;
                        $("#est_subgrupo").append(emptyOption);
                        $.each(data, function(indez, subgrupo) {
                            var option = $("<option>").val(subgrupo.id).text(subgrupo.nombre);
                            $("#est_subgrupo").append(option);
                        })
                    }
                    cerrarCargando();
                }
            });
        }

        function getMuestrasEstudio() {
            mostrarCargando();
            $.ajax({
                url: '{{ route("getMuestras") }}',
                type: 'GET',
                dataType: 'json',
                success: (data) => {
                    if (data.length !== 0) {
                        $("#est_muestra").empty();
                        const emptyOption = `<option value="" disabled selected>Seleccionar...</option>`;
                        $('#est_muestra').append(emptyOption);
                        data.forEach((muestra) => {
                            const option = `<option value="${muestra.id}">${muestra.nombre}</option>`;
                            $("#est_muestra").append(option);
                        });
                    }
                    cerrarCargando();
                }
            });
        }

        function getIndicacionesEstudio() {
            $.ajax({
                url: '{{ route("getIndications") }}',
                type: 'GET',
                dataType: 'json',
                success: (data) => {
                    if (data.length !== 0) {
                        $("#est_indicaciones").empty();
                        const emptyOption = `<option value="" disabled selected>Seleccionar...</option>`;
                        $("#est_indicaciones").append(emptyOption);
                        data.forEach((indicacion) => {
                            const option = `<option value="${indicacion.id}">${indicacion.descripcion}</option>`;
                            $("#est_indicaciones").append(option);
                        });
                    }
                    cerrarCargando();
                }
            });
        }

        function getRecipientesEstudio() {
            mostrarCargando();
            $.ajax({
                url: '{{ route("getRecipientes") }}',
                type: 'GET',
                dataType: 'json',
                success: (data) => {
                    if (data.length !== 0) {
                        $("#est_recipiente").empty();
                        const emptyOption = `<option value="">Seleccionar...</option>`;
                        $("#est_recipiente").append(emptyOption);
                        data.forEach((recipiente) => {
                            const option = `<option value="${recipiente.id}">${recipiente.descripcion}</option>`;
                            $("#est_recipiente").append(option);
                        });
                    }
                    cerrarCargando();
                }
            });
        }

        $(document).on('click', '.btnAddEstudio', function() {
            getGrupo();
            getSubgrupo();
            getMuestrasEstudio();
            getIndicacionesEstudio();
            getRecipientesEstudio();
            $("#est_moneda").val("Bs");
            $("#est_moneda").css('border', '2px solid #40CC6C');
        });

        $(document).on('click', '#btnRegisterGrupo', function() {
            let vacio = "";
            if ($("#grupos_nombre").val() == "") {
                vacio = 'NOMBRE';
                $("#grupos_nombre").css('border', '1px solid #E91C2B');
                $('#grupos_nombre').trigger('focus');
            }
            if (vacio != "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'El campo ' + vacio + ' es requerido.',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                let datos = new FormData();
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
                        $('#modal_crear_grupo .btn-close').trigger('click');
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

        $(document).on('click', '#btnRegisterSubGrupo', function() {
            let vacio = "";
            if ($("#subgrupos_nombre").val() == "") {
                vacio = 'NOMBRE';
                $("#subgrupos_nombre").css('border', '1px solid #E91C2B');
                $('#subgrupos_nombre').trigger('focus');
            }
            if (vacio != "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'El campo ' + vacio + ' es requerido.',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                let datos = new FormData();
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
                        $('#modal_crear_subgrupo .btn-close').trigger('click');
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
                
                function extraerCaracteres(valor) {
                    let words = valor.split(" ");
                    let result = "";
                    
                    if (words.length === 1) {
                        result = valor.substring(0, 2);
                    } else if (words.length >= 2) {
                        result = words[0].charAt(0) + words[1].charAt(0);
                    }
                    
                    return result;
                }
                
                let grupo = document.getElementById("est_grupo");
                let subgrupo = document.getElementById("est_subgrupo");
                let grupocod = "";
                let subgrupocod = "";

                if (subgrupo.value != "") {
                    grupocod = extraerCaracteres(grupo.options[grupo.selectedIndex].text);
                    subgrupocod = extraerCaracteres(subgrupo.options[subgrupo.selectedIndex].text);
                }else{
                    grupocod = extraerCaracteres(grupo.options[grupo.selectedIndex].text);
                    subgrupocod = "";
                }

                clave = grupocod + subgrupocod + clave;
                document.getElementById('est_cod').value = clave;
                $("#est_cod").css('border', '2px solid #40CC6C');
            } else {
                document.getElementById('est_cod').value = '';
                $("#est_cod").css('border', '1px solid #E91C2B');
            }
        }); 

        $(document).on('click', '#btnRegisterEst', function(event) {
            event.preventDefault();
            let vacio = "";
            if ($("#est_nombre").val() == "") {
                vacio = "NOMBRE ESTUDIO";
                $("#est_nombre").trigger("focus");
                $("#est_nombre").css('border', '1px solid #E91C2B');
            }else if ($("#est_grupo").val() == "" || $("#est_grupo").val() == null) {
                vacio = "GRUPO";
                $("#est_grupo").trigger("focus");
                $("#est_grupo").css('border', '1px solid #E91C2B');
            }else if ($("#est_muestra").val() == "" || $("#est_muestra").val() == null) {
                vacio = "MUESTRA";
                $("#est_muestra").trigger("focus");
                $("#est_muestra").css('border', '1px solid #E91C2B');
            }else if ($("#est_indicaciones").val() == "" || $("#est_indicaciones").val() == null) {
                vacio = "INDICACIONES";
                $("#est_indicaciones").trigger("focus");
                $("#est_indicaciones").css('border', '1px solid #E91C2B');
            }else if ($("#est_precio").val() == "" || $("#est_precio").val() == "0.00") {
                vacio = "PRECIO";
                $("#est_precio").trigger("focus");
                $("#est_precio").css('border', '1px solid #E91C2B');
            }else if ($("#est_moneda").val() == "") {
                vacio = "MONEDA";
                $("#est_moneda").trigger("focus");
                $("#est_moneda").css('border', '1px solid #E91C2B');
            }else if ($("#est_cod").val() == "") {
                vacio = "CODIGO";
                $("#est_cod").trigger("focus");
                $("#est_cod").css('border', '1px solid #E91C2B');
            }

            if (vacio != "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'El campo ' + vacio + ' es requerido.',
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
                    url: '{{ route("estudio.store") }}',
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
                        $("#formulario_crear_estudio").trigger('reset');
                        getEstudios();
                        $('#modal_crear_estudio .btn-close').trigger('click');
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
                    getEstudios();
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
            var est_nombre = $(this).closest('tr').find('td:eq(3)').text();
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
            var est_nombre = $(this).closest('tr').find('td:eq(3)').text();
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

        $(document).on('click', '.btnEditEstudio', function() {
            let det_id = $(this).closest("tr").find("td:eq(0)").text();
            mostrarCargando();
            $.ajax({
                url: '{{ route("estudio.edit", ":id") }}'.replace(":id", det_id),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $(".est_id_update").val(data[0].id);
                    $(".est_cod_update").val(data[0].est_cod);
                    $(".est_cod_update").css('border', data[0].id != null ? '2px solid #40CC6C' : '');
                    $(".est_nombre_update").val(data[0].est_nombre);
                    $(".est_nombre_update").css('border', data[0].est_nombre != null ? '2px solid #40CC6C' : '');
                    $(".est_descripcion_update").val(data[0].est_descripcion);
                    $(".est_descripcion_update").css('border', data[0].est_descripcion != null ? '2px solid #40CC6C' : '');
                    $(".est_grupos_update").val(data[0].grupo_id);
                    $(".est_grupos_update").css('border', data[0].grupo_id != null ? '2px solid #40CC6C' : '');
                    $(".est_subgrupos_update").val(data[0].subgrupo_id);
                    $(".est_subgrupos_update").css('border', data[0].subgrupo_id != null ? '2px solid #40CC6C' : '');
                    $(".est_muestra_update").val(data[0].muestra_id);
                    $(".est_muestra_update").css('border', data[0].muestra_id != null ? '2px solid #40CC6C' : '');
                    $(".est_recipiente_update").val(data[0].recipiente_id);
                    $(".est_recipiente_update").css('border', data[0].recipiente_id != null ? '2px solid #40CC6C' : '');
                    $(".est_indicaciones_update").val(data[0].indicacion_id);
                    $(".est_indicaciones_update").css('border', data[0].indicacion_id != null ? '2px solid #40CC6C' : '');
                    $(".est_precio_update").val(data[0].est_precio);
                    $(".est_precio_update").css('border', data[0].est_precio != null ? '2px solid #40CC6C' : '');
                    $(".est_moneda_update").val(data[0].est_moneda);
                    $(".est_moneda_update").css('border', data[0].est_moneda != null ? '2px solid #40CC6C' : '');

                    cerrarCargando();
                }
            });
        });

        $(document).on('click', '.btnUpdateEstudio', function() {
            let det_id = $(".est_id_update").val();
            let vacio = "";
            if ($("#est_nombre_update").val() == "") {
                vacio = "NOMBRE ESTUDIO";
                $("#est_nombre_update").trigger("focus");
                $("#est_nombre_update").css('border', '1px solid #E91C2B');
            }else if ($("#est_grupos_update").val() == "" || $("#est_grupos_update").val() == null) {
                vacio = "GRUPO";
                $("#est_grupos_update").trigger("focus");
                $("#est_grupos_update").css('border', '1px solid #E91C2B');
            }else if ($("#est_muestra_update").val() == "" || $("#est_muestra_update").val() == null) {
                vacio = "MUESTRA";
                $("#est_muestra_update").trigger("focus");
                $("#est_muestra_update").css('border', '1px solid #E91C2B');
            }else if ($("#est_indicaciones_update").val() == "" || $("#est_indicaciones_update").val() == null) {
                vacio = "INDICACIONES";
                $("#est_indicaciones_update").trigger("focus");
                $("#est_indicaciones_update").css('border', '1px solid #E91C2B');
            }else if ($("#est_precio_update").val() == "" || $("#est_precio_update").val() == "0.00") {
                vacio = "PRECIO";
                $("#est_precio_update").trigger("focus");
                $("#est_precio_update").css('border', '1px solid #E91C2B');
            }else if ($("#est_moneda_update").val() == "") {
                vacio = "MONEDA";
                $("#est_moneda_update").trigger("focus");
                $("#est_moneda_update").css('border', '1px solid #E91C2B');
            }else if ($("#est_cod_update").val() == "") {
                vacio = "CODIGO";
                $("#est_cod_update").trigger("focus");
                $("#est_cod_update").css('border', '1px solid #E91C2B');
            }
            if  (vacio != "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'El campo ' + vacio + ' es requerido.',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                $subgrupo = $("#est_subgrupos_update").val() == null ? '' : $("#est_subgrupos_update").val();
                let datos = new FormData();
                datos.append('est_cod_update', $("#est_cod_update").val());
                datos.append('est_nombre_update', $("#est_nombre_update").val());
                datos.append('est_descripcion_update', $("#est_descripcion_update").val());
                datos.append('est_grupos_update', $("#est_grupos_update").val());
                datos.append('est_subgrupos_update', $subgrupo);
                datos.append('est_precio_update', $("#est_precio_update").val());
                datos.append('est_moneda_update', $("#est_moneda_update").val());
                datos.append('est_muestra_update', $("#est_muestra_update").val());
                datos.append('est_recipiente_update', $("#est_recipiente_update").val());
                datos.append('est_indicaciones_update', $("#est_indicaciones_update").val());

                $.ajax({
                    url: '{{ route("estudio.update", ":id") }}'.replace(":id", det_id),
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
                            text: 'Estudio actualizado',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        getEstudios();
                        $('#modal_editar_estudio .btn-close').trigger('click');
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
            var nombre = $(this).closest('tr').find('td:eq(3)').text();
            mostrarCargando();
            $(".proc_est_id").val(valor);
            $(".proc_est_nombre").val(nombre);
            $(".proc_est_tipo_estudio").val('individual');
            $(".estudioTitulo").text("Configuracion: " + nombre);
            cargarTablaDetalleProcedimiento(valor);
            getComponenteEstudio(valor);
            setTimeout(() => {
                cerrarCargando();
            }, 500);
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
            var det_id = $('.proc_est_id').val();
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
                                    '<td class="text-center"><button data-toggle="modal" data-target="#modal_agregar_material" class="btn btn-sm ' + (value.cant_materials == 0 ? 'btn-outline-secondary' : 'btn-outline-primary') + ' btn-add-material-prueba" title="Agregar Material"><i class="fas fa-book"></i></button></td>'+
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
                $(".asp_nombre").val("");
                tablaAspectos();
                $(".asp_nombre").trigger("focus");
            } else {
                addAspecto(dp_comp_id, 'aspqd', asp_id);
                $(".asp_nombre").val("");
                tablaAspectos();
                $(".asp_nombre").trigger("focus");
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
                    // if (data.length != 0) {
                    //     $('.table_parametro tbody').empty();
                    //     $.each(data, function(index, value) {
                    //         $('.table_parametro tbody').append(
                    //             '<tr>'+
                    //                 '<td hidden>'+value.id+'</td>'+
                    //                 '<td>'+
                    //                     '<select class="custom-select custom-select-sm parametro_genero" name="parametro_genero" id="parametro_genero">'+
                    //                         '<option value="" >Genero...</option>'+
                    //                         '<option value="MASCULINO" ' + (value.genero === 'MASCULINO' ? 'selected' : '') + '>MASCULINO</option>'+
                    //                         '<option value="FEMENINO" ' + (value.genero === 'FEMENINO' ? 'selected' : '') + '>FEMENINO</option>'+
                    //                         '<option value="AMBOS" ' + (value.genero === 'AMBOS' ? 'selected' : '') + '>AMBOS</option>'+
                    //                     '</select>'+
                    //                 '</td>'+
                    //                 '<td width="50px"><input type="number" value="' + (value.edad_inicial === null ? '0' : value.edad_inicial ) + '" class="form-control form-control-sm parametro_edad_inicial"></td>'+
                    //                 '<td width="50px"><input type="number" value="' + (value.edad_final === null ? '0' : value.edad_final ) + '" class="form-control form-control-sm parametro_edad_final"></td>'+
                    //                 '<td>'+
                    //                     '<select class="custom-select custom-select-sm parametro_tiempo" name="parametro_tiempo" id="parametro_tiempo">'+
                    //                         '<option value="" >Tiempo...</option>'+
                    //                         '<option value="AÑOS" ' + (value.tiempo === 'AÑOS' ? 'selected' : '') + '>AÑOS</option>'+
                    //                         '<option value="MESES" ' + (value.tiempo === 'MESES' ? 'selected' : '') + '>MESES</option>'+
                    //                         '<option value="DIAS" ' + (value.tiempo === 'DIAS' ? 'selected' : '') + '>DIAS</option>'+
                    //                     '</select>'+
                    //                 '</td>'+
                    //                 '<td width="50px"><input type="number" value="' + (value.valor_inicial === null ? '0' : value.valor_inicial ) + '" class="form-control form-control-sm parametro_valor_inicial" name="parametro_valor_inicial" id="parametro_valor_inicial"></td>'+
                    //                 '<td width="50px"><input type="number" value="' + (value.valor_final === null ? '0' : value.valor_final ) + '"" class="form-control form-control-sm parametro_valor_final" name="parametro_valor_final" id="parametro_valor_final"></td>'+
                    //                 '<td><input type="text" value="' + value.referencia + '"" class="form-control form-control-sm parametro_interpretacion" name="parametro_interpretacion" id="parametro_interpretacion"></td>'+
                    //                 '<td>'+
                    //                     '<div class="btn-group">'+
                    //                         '<button type="button" class="btn btn-sm btn-outline-warning btn-edit-parametro"><i class="fas fa-edit"></i></button>'+
                    //                         '<button type="button" class="btn btn-sm btn-outline-danger btn-delete-parametro-id"><i class="fas fa-trash-alt"></i></button>'+
                    //                     '</div>'+
                    //                 '</td>'+
                    //             '</tr>'
                    //         );
                    //     });
                    // }else {
                    //     $('.table_parametro tbody').empty().append('<td colspan="9" class="text-center fila_vacia">No hay datos recepcionados</td>');
                    // }
                    if (data.length !== 0) {
                        $(".tabla_parametros tbody").empty();
                        const tabla = $("#tabla_parametros");

                        data.forEach(item => {
                            const newRow = $("<tr>");
                            const idCell = $("<td>").attr('hidden', 'true').text(item.id);
                            const caidCell = $("<td>").attr('hidden', 'true').text(item.ca_id);
                            const generoCell = $("<td>").attr('width', '100px').text(item.genero !== null ? item.genero : '');
                            const edadCell = $("<td>").addClass('text-center').attr('width', '100px').text(item.genero !== null ? item.edad_inicial+'-'+item.edad_final : '');
                            const tiempoCell = $("<td>").addClass('text-center').attr('width', '80px').text(item.genero !== null ? item.tiempo : '');
                            const valoresCell = $("<td>").addClass('text-center').attr('width', '100px').text(item.valor_inicial !== null ? item.valor_inicial+'-'+item.valor_final : '');
                            const referenciaCell = $("<td>").text(item.referencia);
                            const editarBtn = $("<button>").addClass("btn btn-warning btn-sm btn-edit-parametro");
                            const editarIcon = $("<i>").addClass("fas fa-edit");
                            editarBtn.append(editarIcon);
                            const eliminarBtn = $("<button>").addClass("btn btn-danger btn-sm btn-delete-parametro-id");
                            const eliminarIcon = $('<i>').addClass('fas fa-trash-alt');
                            eliminarBtn.append(eliminarIcon);
                            const divGroup = $('<div>').addClass('btn-group');
                            divGroup.append(editarBtn, eliminarBtn);
                            const opCell = $("<td>").addClass('text-center').attr('width', '100px').append(divGroup);

                            newRow.append(idCell, caidCell, generoCell, edadCell, tiempoCell, valoresCell, referenciaCell, opCell);
                            tabla.append(newRow);
                        });
                    }else{
                        $(".tabla_parametros tbody").empty().append('<td colspan="7" class="text-center">No hay datos recepcionados</td>')
                    }
                }
            });
        }

        $(document).on('click', '.btn-conf-parametro', function() {
            let id = $(this).closest('tr').find('td:eq(0)').text();
            let aspecto_nombre = $(this).closest('tr').find('td:eq(2)').text();
            let medida = $(this).closest('tr').find('td:eq(3) select option:selected').text();
            let umed_id = $(this).closest('tr').find('td:eq(3) select option:selected').val();
            let comp_id = $(".dp_comp_id").val(); 
            $(".est_ca_id").val(comp_id);
            if (medida == 'Seleccionar...') {
                unidad =  "";
            }else{
                unidad = " - " + medida;
            }
            $('.aspecto_nombre_parametro').text('Configurar Prueba: ' + aspecto_nombre + ' ' + unidad);
            $('.aspecto_id_parametro').val(id);
            $('.parametro_unidad').val(umed_id);
            if (umed_id != "") {
                $('.parametro_unidad').css('border', '2px solid #40CC6C');
                $(".parametro_unidad").attr('disabled', 'true');
            }else{
                $('.parametro_unidad').css('border', '');
                $(".parametro_unidad").removeAttr('disabled');
            }
            $(".btn-save-parametro").prop('hidden', false);
            camposVacios();
            estadoGenero('readonly', true, 'disabled');
            getParametro(id);
            pruebas('{{ route("getDPCAspecto",":id") }}', $(".est_ca_id").val(), '.aspecto_id_parametro', '.btnSiguientePrueba', '.btnAnteriorPrueba', 'parametro');
            //pruebas('{{ route("getDPCAspecto",":id") }}', $(".est_detmat_ca_id").val(), ".detmat_ca_id", '.btnPruebaSiguiente', '.btnPruebaAnterior', 'material');
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
                            '<option value="FEMENINO">FEMENINO</option>'+
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

        function clearParametros() {
            $(".parametro_genero").val("");
            $(".parametro_edad_inicial").val("");
            $(".parametro_edad_final").val("");
            $(".parametro_tiempo").val("");
            $(".parametro_valor_inicial").val("");
            $(".parametro_valor_final").val("");
            $(".parametro_referencia").val("");
        }

        function estadoGenero(propiedad, estado, select) {
            $("#parametro_edad_inicial").prop(propiedad, estado);
            $("#parametro_edad_final").prop(propiedad, estado);
            $("#parametro_tiempo").prop(select, estado);
            $("#parametro_edad_inicial").css('border', '');
            $("#parametro_edad_final").css('border', '');
            $("#parametro_tiempo").css('border', '');
            $("#parametro_edad_inicial").val('');
            $("#parametro_edad_final").val('');
            $("#parametro_tiempo").val('');
        }

        $(document).on('change', '.parametro_genero', function() {
            if ($(this).val() !== "") {
                estadoGenero('readonly', false, 'disabled');
            }else{
                estadoGenero('readonly', true, 'disabled');
            }
        });

        $(document).on('click', '.btn-save-parametro', function(e) {
            // var ca_id = $(".aspecto_id_parametro").val();
            // var genero = $(this).closest('tr').find('td:eq(1) select').val();
            // var edad_inicial = $(this).closest('tr').find('td:eq(2) input').val();
            // var edad_final = $(this).closest('tr').find('td:eq(3) input').val();
            // var tiempo = $(this).closest('tr').find('td:eq(4) select').val();
            // var valor_inicial = $(this).closest('tr').find('td:eq(5) input').val();
            // var valor_final = $(this).closest('tr').find('td:eq(6) input').val();
            // var interpretacion = $(this).closest('tr').find('td:eq(7) input').val();
            e.preventDefault();
            let vacio = "";
            if ($(".parametro_genero").val() !== "") {
                if ($(".parametro_edad_inicial").val() === "") {
                    vacio = 'EDAD INICIAL';
                    $(".parametro_edad_inicial").css('border', '1px solid #E91C2B');
                }else if ($(".parametro_edad_final").val() === "") {
                    vacio = 'EDAD FINAL';
                    $(".parametro_edad_final").css('border', '1px solid #E91C2B');
                }else if ($(".parametro_tiempo").val() === "") {
                    vacio = 'TIEMPO';
                    $(".parametro_tiempo").css('border', '1px solid #E91C2B');
                }else if ($('.parametro_valor_inicial').val() !== "") {
                    if ($(".parametro_valor_final").val() === "") {
                        vacio = 'VALOR FINAL';
                        $(".parametro_valor_final").css('border', '1px solid #E91C2B');
                    }else if ($(".parametro_referencia").val() === "") {
                        vacio = 'REFERENCIA';
                        $(".parametro_referencia").css('border', '1px solid #E91C2B');
                    }
                }else if ($(".parametro_referencia").val() === "") {
                    vacio = 'REFERENCIA';
                    $(".parametro_referencia").css('border', '1px solid #E91C2B');
                }
            }else if ($('.parametro_valor_inicial').val() !== "") {
                if ($(".parametro_valor_final").val() === "") {
                    vacio = 'VALOR FINAL';
                    $(".parametro_valor_final").css('border', '1px solid #E91C2B');
                }else if ($(".parametro_referencia").val() === "") {
                    vacio = 'REFERENCIA';
                    $(".parametro_referencia").css('border', '1px solid #E91C2B');
                }
            }else if ($(".parametro_referencia").val() === "") {
                vacio = 'REFERENCIA';
                $(".parametro_referencia").css('border', '1px solid #E91C2B');
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
                let ca_id = $(".aspecto_id_parametro").val();
                let genero = $(".parametro_genero").val();
                let edad_inicial = $(".parametro_edad_inicial").val();
                let edad_final = $(".parametro_edad_final").val();
                let tiempo = $(".parametro_tiempo").val();
                let valor_inicial = $(".parametro_valor_inicial").val();
                let valor_final = $(".parametro_valor_final").val();
                let unidad = $(".parametro_unidad").val();
                let referencia = $(".parametro_referencia").val();
    
                var datos = new FormData();
                datos.append('ca_id', ca_id);
                datos.append('genero', genero);
                datos.append('edad_inicial', edad_inicial);
                datos.append('edad_final', edad_final);
                datos.append('tiempo', tiempo);
                datos.append('valor_inicial', valor_inicial);
                datos.append('valor_final', valor_final);
                datos.append('unidad', unidad);
                datos.append('referencia', referencia);
    
                $.ajax({
                    url: '{{ route("parametro.store") }}',
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
                        camposVacios();
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
            }
        });

        $(document).on('click', '.btn-edit-parametro', function() {
            let param_id = $(this).closest("tr").find("td:eq(0)").text();
            mostrarCargando();
            $.ajax({
                url: '{{ route("parametro.edit",":id") }}'.replace(":id", param_id),
                type: 'GET',
                dataType: "json",
                success: function(data) {
                    $(".parametro_id").val(data.id)
                    $(".parametro_genero").val(data.genero);
                    $(".parametro_genero").css('border', data.genero != null ? '2px solid #40CC6C' : '');
                    $(".parametro_edad_inicial").val(data.edad_inicial);
                    $(".parametro_edad_inicial").css('border', data.edad_inicial != null ? '2px solid #40CC6C' : '');
                    $(".parametro_edad_final").val(data.edad_final);
                    $(".parametro_edad_final").css('border', data.edad_final != null ? '2px solid #40CC6C' : '');
                    $(".parametro_tiempo").val(data.tiempo);
                    $(".parametro_tiempo").css('border', data.tiempo != null ? '2px solid #40CC6C' : '');
                    $(".parametro_valor_inicial").val(data.valor_inicial);
                    $(".parametro_valor_inicial").css('border', data.valor_inicial != null ? '2px solid #40CC6C' : '');
                    $(".parametro_valor_final").val(data.valor_final);
                    $(".parametro_valor_final").css('border', data.valor_final != null ? '2px solid #40CC6C' : '');
                    $(".parametro_referencia").val(data.referencia);
                    $(".parametro_referencia").css('border', data.referencia != null ? '2px solid #40CC6C' : '');
                    $(".btn-edit-parametro-id").prop('hidden', false);
                    $(".btn-clear-parametro").prop('hidden', false);
                    $(".btn-save-parametro").prop('hidden', true);
                    $(".btn-edit-parametro").attr('disabled', 'true');
                    $(".btn-delete-parametro-id").attr('disabled', 'true');
                    cerrarCargando();
                }
            });
        });
        function camposVacios() {
            $(".parametro_id").val("")
            $(".parametro_genero").val("");
            $(".parametro_genero").css('border', '');
            $(".parametro_edad_inicial").val("");
            $(".parametro_edad_inicial").css('border', '');
            $(".parametro_edad_final").val("");
            $(".parametro_edad_final").css('border', '');
            $(".parametro_tiempo").val("");
            $(".parametro_tiempo").css('border', '');
            $(".parametro_valor_inicial").val("");
            $(".parametro_valor_inicial").css('border', '');
            $(".parametro_valor_final").val("");
            $(".parametro_valor_final").css('border', '');
            $(".parametro_referencia").val("");
            $(".parametro_referencia").css('border', '');
            $(".btn-edit-parametro-id").prop('hidden', true);
            $(".btn-clear-parametro").prop('hidden', true);
            $(".btn-save-parametro").prop('hidden', false);
        }

        function limpiarParametros() {
            camposVacios();
            let ca_id = $(".aspecto_id_parametro").val();
            getParametro(ca_id);
        }

        $(document).on('click', '.btn-clear-parametro', function() {
            limpiarParametros();
        });

        $(document).on('click', '.btn-edit-parametro-id', function() {
            // var ca_id = $(".aspecto_id_parametro").val();
            // var id = $(this).closest('tr').find('td:eq(0)').text();
            // var genero = $(this).closest('tr').find('td:eq(1) select').val();
            // var edad_inicial = $(this).closest('tr').find('td:eq(2) input').val();
            // var edad_final = $(this).closest('tr').find('td:eq(3) input').val();
            // var tiempo = $(this).closest('tr').find('td:eq(4) select').val();
            // var valor_inicial = $(this).closest('tr').find('td:eq(5) input').val();
            // var valor_final = $(this).closest('tr').find('td:eq(6) input').val();
            // var interpretacion = $(this).closest('tr').find('td:eq(7) input').val();

            let ca_id = $(".aspecto_id_parametro").val();
            let id = $(".parametro_id").val();
            let genero = $(".parametro_genero").val();
            let edad_inicial = $(".parametro_edad_inicial").val();
            let edad_final = $(".parametro_edad_final").val();
            let tiempo = $(".parametro_tiempo").val();
            let valor_inicial = $(".parametro_valor_inicial").val();
            let valor_final = $(".parametro_valor_final").val();
            let unidad = $(".parametro_unidad").val();
            let referencia = $(".parametro_referencia").val();

            var datos = new FormData();
            datos.append('ca_id', ca_id);
            datos.append('genero', genero);
            datos.append('edad_inicial', edad_inicial);
            datos.append('edad_final', edad_final);
            datos.append('tiempo', tiempo);
            datos.append('valor_inicial', valor_inicial);
            datos.append('valor_final', valor_final);
            datos.append('unidad', unidad);
            datos.append('referencia', referencia);

            $.ajax({
                url: '{{ route("parametro.update", ":id") }}'.replace(":id", id),
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
                    limpiarParametros();
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
                url: '{{ route("parametro.destroy", ":id") }}'.replace(":id", id),
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
                    limpiarParametros();
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
                                        '<select class="custom-select custom-select-sm detmat_unidad" name="detmat_unidad" id="detmat_unidad" disabled>'+
                                            '<option value="" >Seleccionar...</option>'+
                                            optionList +
                                        '</select>'+
                                    '</td>'+
                                    '<td width="80px"><input type="number" min="0" step="0.01" class="form-control form-control-sm detmat_cantidad" value="'+ (value.cantidad == null ? '': value.cantidad) +'" ></td>'+
                                    '<td width="100px"><input type="number" min="0" step="0.01" class="form-control form-control-sm detmat_precio_total" value="'+ (value.precio_total == null ? '' : value.precio_total) +'"></td>'+
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
        let pruebasData = [];
        let currentPruebaIndex = 0;

        $(document).on('click', '.btn-add-material-prueba', function() {
            var id_det_est = $(this).closest('tr').find('td:eq(0)').text();
            var comp_id = $(".dp_comp_id").val();
            $(".detmat_ca_id").val(id_det_est);
            $(".est_detmat_ca_id").val(comp_id);
            
            getAllMaterial();
            getMaterialEstudio(id_det_est);
            pruebas('{{ route("getDPCAspecto",":id") }}', $(".est_detmat_ca_id").val(), ".detmat_ca_id", '.btnPruebaSiguiente', '.btnPruebaAnterior', 'material');
            setTimeout(function(){
                sumPrecioMaterials();
            }, 500);
        });

        //---------------------Evento de Siguiente y Anterior en el modal----------------------------

        function pruebas(ruta, valor1, valor2, siguiente, anterior, modal) {
            $.ajax({
                url: ruta.replace(":id", valor1),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    pruebasData = data;
                    const pruebaId = document.querySelector(valor2).value;
                    
                    const index = pruebasData.findIndex(prueba => prueba.id === parseInt(pruebaId));
                    
                    if (index !== -1) {
                        currentPruebaIndex = index;
                        if (currentPruebaIndex == 0) {
                            verificarAnterior(anterior, siguiente);
                        }else{
                            verificarSiguiente(anterior, siguiente);
                        }
                        if (modal == 'material') {
                            mostrarModalMaterial(currentPruebaIndex);
                        }else if (modal == 'parametro'){
                            mostrarModalParametro(currentPruebaIndex);
                        }
                    } else {
                        console.log('No se encontró la prueba con el ID proporcionado en pruebasData.');
                    }
                }
            });
        }
        
        function verificarAnterior(anterior, siguiente) {
            if (currentPruebaIndex == 0) {
                $(anterior).prop('hidden', true);
                $(siguiente).prop('hidden', false);
            }else{
                $(anterior).prop('hidden', false);
                $(siguiente).prop('hidden', false);
            }
        }

        function verificarSiguiente(anterior, siguiente) {
            if (currentPruebaIndex == pruebasData.length - 1) {
                $(siguiente).prop('hidden', true);
                $(anterior).prop('hidden', false);
            }else{
                $(siguiente).prop('hidden', false);
                $(anterior).prop('hidden', false);
            }
        }
        //----------------------Para el modal MATERIAL--------------------------------
        document.querySelector('.btnPruebaAnterior').addEventListener('click', () => {
            if (currentPruebaIndex > 0) {
                currentPruebaIndex--;
                verificarAnterior('.btnPruebaAnterior', '.btnPruebaSiguiente');
                mostrarModalMaterial(currentPruebaIndex);
            }
        });

        document.querySelector('.btnPruebaSiguiente').addEventListener('click', () => {
            if (currentPruebaIndex < pruebasData.length - 1) {
                currentPruebaIndex++;
                verificarSiguiente('.btnPruebaAnterior', '.btnPruebaSiguiente');
                mostrarModalMaterial(currentPruebaIndex);
            }
        });
        function mostrarModalMaterial(index) {
            mostrarCargando();
            setTimeout(() => {
                const prueba = pruebasData[index];
                $(".detmat_ca_id").val(prueba.id);
                $(".modal_agregar_materialLabel").text('Agregar Materiales: ' + prueba.nombre);
                $(".search_material").val("");
                getAllMaterial();
                getMaterialEstudio($(".detmat_ca_id").val());
                cerrarCargando();
                
            }, 500);
        }

        //----------------------Para el modal PARAMETRO------------------------------
        document.querySelector('.btnAnteriorPrueba').addEventListener('click', () => {
            if (currentPruebaIndex > 0) {
                currentPruebaIndex--;
                verificarAnterior('.btnAnteriorPrueba', '.btnSiguientePrueba');
                mostrarModalParametro(currentPruebaIndex);
            }
        });

        document.querySelector('.btnSiguientePrueba').addEventListener('click', () => {
            if (currentPruebaIndex < pruebasData.length - 1) {
                currentPruebaIndex++;
                verificarSiguiente('.btnAnteriorPrueba', '.btnSiguientePrueba');
                mostrarModalParametro(currentPruebaIndex);
            }
        });
        function mostrarModalParametro(index) {
            mostrarCargando();
            setTimeout(() => {
                const prueba = pruebasData[index];
                $(".aspecto_id_parametro").val(prueba.id);
                $(".aspecto_nombre_parametro").text('Configurar Parámetros: ' + prueba.nombre);
                $(".parametro_unidad").val(prueba.umed_id);
                if (prueba.umed_id !== null) {
                    $('.parametro_unidad').css('border', '2px solid #40CC6C');
                    $(".parametro_unidad").attr('disabled', 'true');
                }else{
                    $('.parametro_unidad').css('border', '');
                    $(".parametro_unidad").removeAttr('disabled');
                }
                camposVacios();
                estadoGenero('readonly', true, 'disabled');
                $(".btn-save-parametro").prop('hidden', false);
                getParametro($(".aspecto_id_parametro").val());
                cerrarCargando();
                
            }, 500);
        }

        //-----------------------------------------------------------------------------------------------

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
                    var dp_comp_id = $(".dp_comp_id").val();
                    getMaterialEstudio(det_id);
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

        $(document).on('click', '.btn-use-material', function() {
            var mat_id = $(this).closest('tr').find('td:eq(0)').text();
            var ca_id = $(".detmat_ca_id").val();
            var unidad = $(this).closest("tr").find("td:eq(3)").text();
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
                //if (unidad != '%') {
                    var datos = new FormData();
                    datos.append('ca_id', ca_id);
                    datos.append('mat_id', mat_id);
                    datos.append('umed_id', umed_id);
                    addDetMat(ca_id, datos);
                //}
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
                    var dp_comp_id = $(".dp_comp_id").val();
                    getMaterialEstudio(det_id);
                    tablaAspectoParametro(dp_comp_id);
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
            var det_id = $(".detmat_ca_id").val();
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
            var det_id = $(".detmat_ca_id").val();
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
            let det_id = $(".detmat_ca_id").val();
            let det_mat_id = $(this).closest('tr').find('td:eq(0)').text();
            let mat_id = $(this).closest('tr').find('td:eq(1)').text();
            let unidad_id = $(this).closest('tr').find('td:eq(5) select').val();
            let cantidad = $(this).closest('tr').find('td:eq(6) input').val();;
            let precio_total = $(this).closest('tr').find('td:eq(7) input').val();

            let datos = new FormData();
            datos.append('det_id', det_id);
            datos.append('mat_id', mat_id);
            datos.append('cantidad', cantidad);
            datos.append('umed_id', unidad_id);
            datos.append('precio_total', precio_total);
            upDetMat(det_mat_id, datos, det_id);
            
        });

        $(document).on('keyup', '.detmat_cantidad', function() {
            let cantidad_total = $(this).closest('tr').find('td:eq(3)').text();
            let precio_compra = $(this).closest('tr').find('td:eq(4)').text();
            let cantidad = $(this).val();
            let precio_total = ((cantidad * precio_compra)/cantidad_total);
            $(this).closest('tr').find('td:eq(7) input').val(precio_total);
            sumPrecioMaterials();
        });

        $(document).on('change', '.detmat_precio_total', function() {
            let det_id = $(".detmat_ca_id").val();
            let det_mat_id = $(this).closest('tr').find('td:eq(0)').text();
            let mat_id = $(this).closest('tr').find('td:eq(1)').text();
            let unidad_id = $(this).closest('tr').find('td:eq(5) select').val();
            let cantidad = $(this).closest('tr').find('td:eq(6) input').val();;
            let precio_total = $(this).closest('tr').find('td:eq(7) input').val();

            let datos = new FormData();
            datos.append('det_id', det_id);
            datos.append('mat_id', mat_id);
            datos.append('cantidad', cantidad);
            datos.append('umed_id', unidad_id);
            datos.append('precio_total', precio_total);
            upDetMat(det_mat_id, datos, det_id);
        });

        $(document).on('keyup', '.detmat_precio_total', function() {
            let cantidad_total = $(this).closest('tr').find('td:eq(3)').text();
            let precio_compra = $(this).closest('tr').find('td:eq(4)').text();
            let precio_total = $(this).val();
            let cantidad = ((precio_total * cantidad_total)/precio_compra);
            $(this).closest('tr').find('td:eq(6) input').val(cantidad);
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
            // var id = $(".detmat_ca_id").val();
            // var datos = new FormData();
            // datos.append('precio_est', suma.toFixed(2));
            // $.ajax({
            //     url: '{{ route("updatePrecioEstudio", ":id") }}'.replace(':id', id),
            //     type: 'POST',
            //     data: datos,
            //     contentType: false,
            //     processData: false,
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     success: function (response) {
            //         console.log('hecho');
            //     },
            //     error: function (xhr, textStatus, errorThrown) {
            //         console.error('Error en la solicitud: ', textStatus, ', detalles: ', errorThrown);
            //         Swal.fire({
            //             title: 'Oops...',
            //             text: 'Error en la solicitud: '+ textStatus+ ', detalles: '+ errorThrown,
            //             icon: 'error',
            //             showConfirmButton: false,
            //             timer: 2000
            //         });
            //     }
            // });
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