<script type="text/javascript">
    //para eliminar datos solo colocar el nombre de la ruta correspondiente 
    $(window).on('load', function() {
        $('#loader-wrapper').fadeOut('slow');
    });  
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var route = $(this).data('route');
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
        })
    });
    function filtroTabla(campoInput, Tabla) {
        const $filtro = document.querySelector(campoInput);
        const $tabla = document.querySelector(Tabla +' tbody');
        let filaNoData;
        function filtrarTabla(event) {
            const texto = event.target.value.toLowerCase(); 
            const filas = $tabla.querySelectorAll('tr'); 
            let hayCoincidencias = false;
            filas.forEach((fila) => {
                const contenidoFila = fila.textContent.toLowerCase(); 
                if (contenidoFila.includes(texto)) {
                    fila.style.display = '';
                    hayCoincidencias = true;
                } else {
                    fila.style.display = 'none';
                }
            });
            if (!hayCoincidencias) {
                if (!filaNoData) {
                    filaNoData = $tabla.insertRow();
                    filaNoData.setAttribute("id", "no-data-row");
                    const nuevaCelda = filaNoData.insertCell();
                    nuevaCelda.style.textAlign = 'center';
                    nuevaCelda.colSpan = filas[0].children.length;
                    nuevaCelda.textContent = 'No se encontraron datos';
                }else{
                    filaNoData.style.display = '';
                }
            }else{
                if (filaNoData) {
                    filaNoData.style.display = 'none'
                }
            }
        }
        $filtro.addEventListener('input', filtrarTabla);
    }
    function calcularPrecioCantidad(stock, precioCompra, precioUnitario) {
        var cantidad = $(stock).val();
        var precio_comp = $(precioCompra).val();
        var precioUni = parseFloat(precio_comp / cantidad).toFixed(2);
        $(precioUnitario).val(precioUni);
    }
    
    function VerImagen(inputImagenLoad, showImagen) {
        const inputImagen = document.getElementsByClassName(inputImagenLoad)[0];
        const imgMaterial = document.getElementsByClassName(showImagen)[0];
        if (inputImagen.files.length === 0) {
            imgMaterial.src = '{{ asset("dist/img/default.png") }}';
        }else{
            imgMaterial.src = URL.createObjectURL(inputImagen.files[0]);
        }
    }

    //var convert = require('convert-units');

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
    
    @if(session('success'))
        Swal.fire({
            title: 'Registrado',
            text: '{{ session('success') }}',
            icon: 'success',
            showConfirmButton: false,
            timer: 2000
        });
    @endif
    @if(session('factura'))
        Swal.fire({
            title: '¡Exito!',
            text: '{{ session('factura') }}',
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ver factura',
            cancelButtonText: 'Continuar'
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