<div class="modal fade" id="modal_crear_categoria" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_categoriaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_crear_categoriaLabel"><strong>{{ __('Agregar Categoría') }}</strong></h1>
                <button type="button" id="btnCloseAddCategoria" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form class="form-horizontal" id="formulario_crear_categorias">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="cat_nombre">{{ __('Nombre') }}: <span class="dato_requerido">*</span> </label>
                                <div class="col-md-8">
                                    <input type="text" id="cat_nombre" name="cat_nombre" class="form-control form-control-sm cat_nombre" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); obligado($(this))" placeholder="Nombre Categoria" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-xl-12 col-sm-12 text-right">
                        <button id="btnRegisterCat" class="btn btn-success">{{ __('Agregar') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>