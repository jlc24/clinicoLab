@extends('layouts.app')

@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Catálogo</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Catálogo</a></li>
                        <li class="breadcrumb-item active">Estudio</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-12 col-sm-12">
                    <div class="card card-success">
                        <div class="card-header" style="padding-top: 15px;">
                            <h4 class="card-title">
                                <a style="color: #fff;" href="#" data-toggle="modal"  data-target="#modal_crear_estudio" title="Agregar estudio">
                                    <i class="far fa-plus-square"></i>
                                </a>Estudios
                            </h4>
                        </div>
                        <div class="card-body">
                            <h3>Lista de Estudios o Análisis registrados en el Sistema</h3><hr>
                            <table class="table table-bordered table-responsive-lg">
                                <thead>
                                    <th>#</th>
                                    <th>Clave</th>
                                    <th>Nombre</th>
                                    <th>Op</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('estudio.modal.modal_crear_estudio')
@endsection