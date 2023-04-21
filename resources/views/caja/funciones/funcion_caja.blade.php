<script type="text/javascript">
    $(document).ready(function(){
        $("#btnRegisterCaja").on('click', function(){
            event.preventDefault();
            $.ajax({
                url: '{{ route('getCajaStatus') }}',
                type: 'GET',
                success: function(data) {
                    //console.log(data);
                    if (data.caja_estado == 1) {
                        Swal.fire({
                            title: 'Caja Abierta',
                            text: 'Aun tiene caja abierta, debe cerrarla para abrir otra',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 3000
                        })
                    }else{
                        $('#formulario_crear_caja').submit();
                    }
                }
            });
        });
        $('#modal_crear_caja').on('shown.bs.modal', function () {
            $('#caja_monto_apertura').trigger('focus');
        });
    })
</script>