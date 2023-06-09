<script src="{{ asset('dist/js/libs/wizard/jquery.smartWizard.min.js') }}"></script>
<script src="{{ asset('dist/js/libs/wizard/conf_smart_wizard.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#smartwizard_crear_client').smartWizard();
    $('#cli_departamento').on('change', function() {
        var id = $(this).val();
        $.ajax({
            url: '{{ route("datos", ":id") }}'.replace(':id', id),
            type: 'GET',
            success: function(data) {
                $('#cli_municipio').empty();
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
        $('#smartwizard_crear_client').smartWizard("reset");
    });

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
    $("#cli_celular_update").on('keyup', function(){
        let input = $(this).val();
        let longitudRequerida = 8;
        let mensaje = $("#error_cli_celular_update");

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

    $("#btnRegisterClient").on('click', function(event) {
        event.preventDefault();
        if ($("#cli_cod").val() == "" || $("#cli_nombre").val() == "" || $("#cli_apellido_pat").val() == "" || $("#cli_apellido_mat").val() == "" || $("#cli_ci_nit").val() == "" || $("#cli_ci_nit_exp").val() == "" || $("#cli_fec_nac").val() == "" || $("#cli_genero").val() == "" || $("#cli_email").val() == "" || $("#cli_direccion").val() == "" || $("#cli_celular").val() == "" || $("#cli_usuario").val() == "" || $("#cli_password").val() == "" || $("#cli_departamento").val() == "" || $("#cli_municipio").val() == "" || $("#cli_estado").val() == "" || $("#cli_rol").val() == "" ) {
            Swal.fire({
                title: 'Error!',
                text: 'Algunos campos son requeridos',
                icon: 'error',
                showConfirmButton: false,
                timer: 2000
            });
        }else{
            if ($("#cli_medico").val() == "" || $("#cli_medico").val() == null) {
                cli_medico = "";
            }else {
                cli_medico = $("#cli_medico").val();
            }
            var datos = new FormData();
            datos.append('cli_cod', $("#cli_cod").val());
            datos.append('cli_nombre', $("#cli_nombre").val());
            datos.append('cli_apellido_pat', $("#cli_apellido_pat").val());
            datos.append('cli_apellido_mat', $("#cli_apellido_mat").val());
            datos.append('cli_ci_nit', $("#cli_ci_nit").val());
            datos.append('cli_ci_nit_exp', $("#cli_ci_nit_exp").val());
            datos.append('cli_fec_nac', $("#cli_fec_nac").val());
            datos.append('cli_genero', $("#cli_genero").val());
            datos.append('cli_email', $("#cli_email").val());
            datos.append('cli_direccion', $("#cli_direccion").val());
            datos.append('cli_celular', $("#cli_celular").val());
            datos.append('cli_usuario', $("#cli_usuario").val());
            datos.append('cli_password', $("#cli_password").val());
            datos.append('cli_departamento', $("#cli_departamento").val());
            datos.append('cli_municipio', $("#cli_municipio").val());
            datos.append('cli_estado', $("#cli_estado").val());
            datos.append('cli_rol', $("#cli_rol").val());
            datos.append('med_id', cli_medico);

            // for (const [key, value] of datos) {
            //     console.log(key, '- '+value);
            // };
            $.ajax({
                url: '{{ route("cliente.store") }}',
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
                        text: 'Paciente registrado',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    if (window.location.href.indexOf("clientes") > -1) {
                        location.reload();
                        $('#smartwizard_crear_client').smartWizard("reset");
                    }else{
                        $('#smartwizard_crear_client').smartWizard("reset");
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
    function getCliente(id) {
        mostrarCargando();
        $.ajax({
            url: '{{ route("cliente.show", ":id") }}'.replace(":id", id),
            type: 'GET',
            success: function(data) {
                if (data.length !== 0) {
                    if(data[0].cli_genero == 'MASCULINO'){
                        $(".img-perfil-cliente").attr('src', "{{ asset('dist/img/avatar5.png') }}")
                    }else{
                        $(".img-perfil-cliente").attr('src', "{{ asset('dist/img/avatar3.png') }}")
                    }
                    $(".cli_cod").text(data[0].cli_cod);
                    $(".cli_id").val(data[0].id);
                    $(".cli_correo").text(data[0].cli_correo);
                    $(".cli_password").text(data[0].cli_password);
                    if (data[0].estado == '1') {
                        $(".cli_estado_color").removeClass('badge badge-danger btn-cliente-activar').addClass('badge badge-success btn-cliente-desactivar').text('ACTIVO');
                    }else{
                        $(".cli_estado_color").removeClass('badge badge-success btn-cliente-desactivar').addClass('badge badge-danger btn-cliente-activar').text('INACTIVO');
                    }
                    $(".cli_nombre").text(data[0].cli_nombre+' '+data[0].cli_apellido_pat+' '+data[0].cli_apellido_mat);
                    $(".cli_ci").text(data[0].cli_ci_nit);
                    $(".cli_exp").text(data[0].cli_exp_ci);
                    $(".cli_direccion").text(data[0].cli_direccion);
                    $(".cli_telefono").text(data[0].cli_telefono);
                    $(".cli_fec_nac").text(data[0].fecha_nacimiento);
                    $(".cli_edad").text(data[0].cli_edad + ' años');
                    $(".cli_dep").text(data[0].dep);
                    $(".cli_mun").text(data[0].mun);
                    $(".cli_num_celular").text(data[0].cli_celular);
                    $(".cli_celular").attr('href', 'https://api.whatsapp.com/send?phone=591'+data[0].cli_celular);
                    cerrarCargando();
                }
            }
        });
    }

    $(document).on('click', '.btnVerCliente', function() {
        var cli_id = $(this).closest('tr').find('td:eq(0)').text();
        getCliente(cli_id);
    })

    function updateEstado(ruta, datos, id) {
        $.ajax({
            url: ruta,
            type: 'POST',
            data: datos,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                getCliente(id);
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

    $(document).on('click', '.btn-cliente-desactivar', function() {
        var cli_id = $(".cli_id").val();
        var datos = new FormData();
        datos.append('estado', 0);
        updateEstado('{{ route("cliente.estado.0", ":id") }}'.replace(":id", cli_id), datos, cli_id);
    });
    $(document).on('click', '.btn-cliente-activar', function() {
        var cli_id = $(".cli_id").val();
        var datos = new FormData();
        datos.append('estado', 1);
        updateEstado('{{ route("cliente.estado.1", ":id") }}'.replace(":id", cli_id), datos, cli_id);
    });

    //datatables
    $("#tabla_clientes").dataTable({
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

    function getClientResult(id) {
        mostrarCargando();
        $.ajax({
            url: '{{ route("getEstudioClienteRecepcion", ":id") }}'.replace(":id", id),
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.length != 0) {
                    $('.tabla-resultados-cliente tbody').empty();
                    $.each(data, function(index, value) {
                        $('.tabla-resultados-cliente tbody').append(
                            '<tr>'+
                                '<td style="vertical-align: middle;" width="50px">'+ value.rec_id +'</td>'+
                                '<td style="vertical-align: middle;" width="100px">'+ value.est_cod +'</td>'+
                                '<td style="vertical-align: middle;">'+ value.est_nombre +'</td>'+
                                '<td style="vertical-align: middle;">'+ value.est_precio + ' ' + value.est_moneda +'</td>'+
                                '<td style="vertical-align: middle;" hidden>'+ 'CANCELADO' +'</td>'+
                                '<td style="vertical-align: middle;" width="40px"><span class="badge ' + (value.estado == 'PENDIENTE' ? 'badge-danger' : 'badge-success') + '" title="Estado">' + value.estado + '</span></td>'+
                                '<td class="text-center" style="vertical-align: middle;" width="50px">'+
                                    '<button data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-primary btn-sm btn-show-result" title="Ver resultado" ' + (value.estado == 'PENDIENTE' ? 'hidden' : '') + '><i class="fas fa-print"></i></button>'+
                                '</td>'+
                            '</tr>'
                        );
                    });
                }else {
                    $('.tabla-resultados-cliente tbody').empty().append('<td colspan="7" class="text-center fila_vacia">No hay datos recepcionados</td>');
                }
                cerrarCargando();
            }
        });
    }

    $(document).on('click', '.btnVerResultados', function() {
        var cli_id = $(this).closest('tr').find('td:eq(0)').text();
        getClientResult(cli_id);
    });

    function getFacturaCliente(id) {
        mostrarCargando();
        $.ajax({
            url: '{{ route("getFacturaCliente", ":id") }}'.replace(":id", id),
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.length != 0) {
                    $('.tabla-facturas-cliente tbody').empty();
                    $.each(data, function(index, value) {
                        $('.tabla-facturas-cliente tbody').append(
                            '<tr>'+
                                '<td style="vertical-align: middle;">'+ value.id +'</td>'+
                                '<td style="vertical-align: middle;">'+ value.fecha +'</td>'+
                                '<td style="vertical-align: middle;">'+ value.hora +'</td>'+
                                '<td style="vertical-align: middle;" hidden>'+ (value.fac_ruta_file !== null ? 'SI' : 'NO') +'</td>'+
                                '<td class="text-center" style="vertical-align: middle;">'+
                                    '<button data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-primary btn-sm btn-show-fact" title="Ver factura"><i class="fas fa-print"></i></button>'+
                                '</td>'+
                            '</tr>'
                        );
                    });
                }else {
                    $('.tabla-facturas-cliente tbody').empty().append('<td colspan="7" class="text-center fila_vacia">No hay datos recepcionados</td>');
                }
                cerrarCargando();
            }
        });
    }

    $(document).on('click', '.btnVerFacturas', function() {
        var cli_id = $(this).closest('tr').find('td:eq(0)').text();
        $(".fac_cli_id").val(cli_id);
        getFacturaCliente(cli_id);
    });

    function PdfFactura(id) {
        mostrarCargando();
        $.ajax({
            url: '{{ route("getRutaFacturaCliente", ":id") }}'.replace(":id", id),
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.fac_ruta_file !== null) {
                    $(document).on('shown.bs.modal', '.exampleModal', function (event) {
                        var pdfFrame = document.querySelector('.pdfFrame');
                        var checkPDFReadyInterval = setInterval(function() {
                            if (data.fac_ruta_file !== null) {
                                pdfFrame.src = "{{ asset('storage') }}"+"/"+data.fac_ruta_file;
                                clearInterval(checkPDFReadyInterval);
                                cerrarCargando();
                            }
                        }, 100);
                    });
                }else{
                    // $.ajax({
                    //     url: '{{ route("factura.pdf", ":id") }}'.replace(":id", id),
                    //     type: 'GET',
                    //     success: function(response) {
                    //         getFacturaCliente($(".fac_cli_id").val());
                    //         var pdfFrame = document.querySelector('.pdfFrame');
                    //         var checkPDFReadyInterval = setInterval(function() {
                    //             if (response.fac_ruta_file !== null) {
                    //                 pdfFrame.src = "{{ asset('storage') }}"+"/"+response.fac_ruta_file;
                    //                 clearInterval(checkPDFReadyInterval);
                    //                 cerrarCargando();
                    //             }
                    //         }, 100);
                    //         //window.open('{{ route("factura.pdf", ":id") }}'.replace(":id", fac_id), '_blank');
                    //     }
                    // });
                    $(document).on('shown.bs.modal', '.exampleModal', function (event) {
                        var pdfFrame = document.querySelector('.pdfFrame');
                        var checkPDFReadyInterval = setInterval(function() {
                            if (data.fac_ruta_file == null) {
                                pdfFrame.src = "";
                                clearInterval(checkPDFReadyInterval);
                                cerrarCargando();
                            }
                        }, 100);
                    });
                    setTimeout(function() {
                        Swal.fire({
                            title: 'Oops...',
                            text: 'No hay documento de factura, por favor comuniquese con la administración de ClinicoLab.',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 5000
                        });
                    }, 500);
                }
            }
        });
    }

    $(document).on('click', '.btn-show-fact', function() {
        var fac_id = $(this).closest('tr').find('td:eq(0)').text();
        $(".exampleModalLabel").text('Factura')
        PdfFactura(fac_id);
    });

    $(document).on('click', '.btnClosePdfGenerate', function() {
        var pdfFrame = document.querySelector('.pdfFrame');
        pdfFrame.src = "";
    });

    function PdfResultado(rec_id) {
        mostrarCargando();
        $.ajax({
            url: '{{ route("getRutaRecepcionCliente", ":id") }}'.replace(":id", rec_id),
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.rec_ruta_file !== null) {
                    $(document).on('shown.bs.modal', '.exampleModal', function (event) {
                        var pdfFrame = document.querySelector('.pdfFrame');
                        var checkPDFReadyInterval = setInterval(function() {
                            if (data.rec_ruta_file !== null) {
                                pdfFrame.src = "{{ asset('storage') }}"+"/"+data.rec_ruta_file;
                                clearInterval(checkPDFReadyInterval);
                                cerrarCargando();
                            }
                        }, 100);
                    });
                }else{
                    // $.ajax({
                    //     url: '{{ route("resultado.pdf", ":id") }}'.replace(":id", rec_id),
                    //     type: 'GET',
                    //     success: function(response) {
                    //         var pdfFrame = document.querySelector('.pdfFrame');
                    //         var checkPDFReadyInterval = setInterval(function() {
                    //             if (response.rec_ruta_file !== null) {
                    //                 pdfFrame.src = "{{ asset('storage') }}"+"/"+response.rec_ruta_file;
                    //                 clearInterval(checkPDFReadyInterval);
                    //                 cerrarCargando();
                    //             }
                    //         }, 100);
                    //         //window.open('{{ route("factura.pdf", ":id") }}'.replace(":id", fac_id), '_blank');
                    //     }
                    // });
                    $(document).on('shown.bs.modal', '.exampleModal', function (event) {
                        var pdfFrame = document.querySelector('.pdfFrame');
                        var checkPDFReadyInterval = setInterval(function() {
                            if (data.rec_ruta_file == null) {
                                pdfFrame.src = "";
                                clearInterval(checkPDFReadyInterval);
                                cerrarCargando();
                            }
                        }, 100);
                    });
                    setTimeout(function() {
                        Swal.fire({
                            title: 'Oops...',
                            text: 'No hay documento de resultado, por favor comuníquese con la administración de ClinicoLab.',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 5000
                        });
                    }, 500);
                }
            }
        });
    }
    
    $(document).on('click', '.btn-show-result', function() {
        var rec_id = $(this).closest('tr').find('td:eq(0)').text();
        $(".exampleModalLabel").text("Resultados");
        PdfResultado(rec_id);
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

//---para modal modificar
function extraercaracteresUp(length) {
    let result = '';
    const characters = $("#cli_ci_nit_update").val();
    for (let i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return result;
}
function generarCorreoUp() {
    const nombre = $("#cli_nombre_update").val().substring(0, 2).toLowerCase();
    const ap_pat = $("#cli_apellido_pat_update").val().substring(0, 2).toLowerCase();
    const ap_mat = $("#cli_apellido_mat_update").val().substring(0, 2).toLowerCase();
    const ci = extraercaracteresUp(4);
    const correo = `${nombre}${ap_pat}${ci}.${ap_mat}@gmail.com`;
    $("#cli_email_update").val(`${correo}`);
}
function UsuarioUp() {
    const nombre = $("#cli_nombre_update").val().substring(0, 1);
    const ap = $("#cli_apellido_pat_update").val().substring(0, 1);
    const am = $("#cli_apellido_mat_update").val().substring(0, 1);
    const randomNum = Math.floor(Math.random() * 8999) + 1000;
    const newusuario = `${ap}${am}${nombre}${randomNum}`;
    $("#cli_usuario_update").val(`${newusuario}`);   
}

function PasswordUp() {
    const nombre = $("#cli_nombre_update").val().substring(0, 1);
    const ap = $("#cli_apellido_pat_update").val().substring(0, 1);
    const am = $("#cli_apellido_mat_update").val().substring(0, 1);
    const ci = $("#cli_ci_nit_update").val();
    const caracter = generateRandomString(3);
    const randomNum1 = Math.floor(Math.random() * 899) + 100;
    const newpass = `${nombre}${ap}${am}.${ci}-${caracter}`;
    $("#cli_password_update").val(`${newpass}`);
}
</script>