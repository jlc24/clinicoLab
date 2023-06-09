<script type="text/javascript">
    $(document).ready(function(){
        $('#modal_crear_empresa').on('shown.bs.modal', function () {
            $('#emp_nit').trigger('focus');
        });
        $("#btnCloseAddEmp").on('click', function(){
            $("#formulario_crear_empresa").trigger('reset');
        });
        $('#emp_departamento').on('change', function() {
            var id = $(this).val();
            //alert(id);
            $.ajax({
                url: '{{ route("datos", ":id") }}'.replace(':id', id),
                type: 'GET',
                success: function(data) {
                    $('#emp_municipio').empty();
                    $.each(data, function(index, element) {
                        $('#emp_municipio').append($('<option>', {
                            value: element.id,
                            text: element.nombre
                        }));
                    });
                }
            });
        });

        $("#tabla_empresas").dataTable({
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
    });
</script>