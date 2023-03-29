@extends('layouts.app')

@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Administración</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Administración</a></li>
                        <li class="breadcrumb-item active">Médico</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-sm-6">
                    <div class="card">
                        <div class="card-header" style="background-color: #E8F8ED; height: 50px; padding-top: 15px;">
                            <h4 class="page-title">
                                <a style="color: #32C861;" href="#" data-toggle="modal"  data-target="#modal_crear_medico" title="Agregar medico">
                                    <i class="far fa-plus-square"></i>
                                </a> Registrar Medico
                            </h4>
                        </div>
                        <div class="card-body" id="tabla_medico">
                            <table class="table table-bordered table-striped">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>#</th>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Direccion</th>
                                        <th>Celular</th>
                                        <th>Op</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>MED01</td>
                                        <td>Asdsk</td>
                                        <td>Uwekjms</td>
                                        <td>Fioweknj ijqwme</td>
                                        <td>535165151</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>MED02</td>
                                        <td>Gioruu</td>
                                        <td>Vkljasje</td>
                                        <td>Slsdkmkf windn</td>
                                        <td>354165151</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="modal_crear_medico" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_medicoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal_crear_medicoLabel">Agregar Médico</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>
@endsection