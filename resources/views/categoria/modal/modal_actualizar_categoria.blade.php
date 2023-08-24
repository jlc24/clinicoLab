<div class="modal fade" id="modal_actualizar_categoria" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_actualizar_categoriaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #FFC107; color: #000">
                <h1 class="modal-title fs-5" id="modal_actualizar_categoriaLabel"><strong>{{ __('Modificar Categoría') }}</strong></h1>
                <button type="button" id="btnCloseUpCategoria" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
                <form class="form-horizontal" id="formulario_actualizar_categorias">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="cat_nombre_update">{{ __('Nombre') }}: </label>
                                <div class="col-md-8">
                                    <input type="hidden" name="cat_id" id="cat_id" class="cat_id">
                                    <input type="text" id="cat_nombre_update" name="cat_nombre_update" class="form-control form-control-sm cat_nombre_update" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); " placeholder="Nombre Categoria" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnUpdateCategoria" class="btn btn-success btnUpdateCategoria">{{ __('Actualizar') }}</button>
            </div>
        </div>
    </div>
</div>