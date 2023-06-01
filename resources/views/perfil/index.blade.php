@extends('layouts.app')

@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Perfil de Usuario') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Inicio') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Perfil') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <div>
                                <h4>{{ __('Foto de Perfil') }}</h4>
                            </div>
                            <div class="mt-4 mb-4">
                                
                                <img src="{{ asset('dist/img/default.png') }}" class="img_logo" width="200px" height="200px" style="border: 2px solid rgb(146, 144, 144); border-radius: 50%; box-shadow: 2px 2px 4px 2px rgba(0, 0, 0, 0.3);;">
                            
                            </div>
                            <div class="text-center">
                                <div class="form-group row">
                                    <label class="col-form-label" for="photo_logo">{{ __('Cambiar Logo') }}: </label>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <div class="col-md-10">
                                        <input type="file" name="photo_logo" id="photo_logo" accept=".jpge,.jpg,image/png" class="form-control form-control-sm form-control-file photo_logo" onchange="VerImagen('photo_logo', 'img_logo')">
                                    </div>
                                    <div class="col-md-1 m-0 p-0 div-clear-file" hidden>
                                        <a href="javascript:void(0)" title="Borrar imagen seleccionada" class="btn-clear-file"><i class="fas fa-refresh"></i></a>
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <div class="col-md-11">
                                        <button class="btn btn-sm btn-outline-success btn-save-logo" hidden>{{ __('Guardar cambios') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Title</h5>
                            <p class="card-text">Content</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection