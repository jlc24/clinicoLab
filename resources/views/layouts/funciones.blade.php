<script type="text/javascript">
    //para eliminar datos solo colocar el nombre de la ruta correspondiente   
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var route = $(this).data('route');
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¡No podrás revertir esto!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, borrarlo!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: route.replace(':id', id),
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire({
                            title: '¡Eliminado!',
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then((result)=>{
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                });
            }
        })
    });
    $(document).ready(function() {
        
    });
    
    @if(session('success'))
        Swal.fire({
            title: 'Registrado',
            text: '{{ session('success') }}',
            icon: 'success',
            showConfirmButton: false,
            timer: 2000
        });
    @endif
    @if(session('info'))
        Swal.fire({
            title: 'Oops...!',
            text: '{{ session('info') }}',
            icon: 'info',
            showConfirmButton: false,
            timer: 2000
        });
    @endif

    //----------------------------------------------------------------------------------------
</script>