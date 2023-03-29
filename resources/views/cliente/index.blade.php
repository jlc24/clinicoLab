@extends('layouts.app')

@section('contenido')
<!-- 
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Administracion | Clientes</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#" title="Nuevo cliente">
                                <div style="border-style: solid; border-width: 1px; border-radius: 50%; width: 30px; text-align: center;">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>/.container-fluid 
        </section>-->
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
                        <li class="breadcrumb-item active">Pacientes</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-12 col-sm-6">
                    <div class="card">
                        <div class="card-header" style="background-color: #E8F8ED; height: 50px; padding-top: 15px;">
                            <h4 class="page-title">
                                <a style="color: #32C861;" href="#" data-toggle="modal" data-target="#modal_crear_cliente" title="Agregar Cliente">
                                    <i class="far fa-plus-square"></i>
                                </a> Nuevo Paciente
                            </h4>
                        </div>
                        <div class="card-body" id="tabla_cliente">
                            <h3>Lista de Pacientes registrados en el Sistema</h3><hr>
                            <table class="table table-bordered  table-responsive-sm">
                                <thead style="text-align: center;">
                                    <tr class="table-info">
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
                                    @foreach ($clientes as $cliente)
                                        <tr>
                                            <td>{{ $cliente->id }}</td>
                                            <td>{{ $cliente->cli_cod }}</td>
                                            <td>{{ $cliente->cli_nombre }}</td>
                                            <td>{{ $cliente->cli_apellido }}</td>
                                            <td>{{ $cliente->cli_direccion }}</td>
                                            <td>{{ $cliente->cli_celular }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button class="btn btn-sm btn-outline-warning"><i class="fas fa-user-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-info"><i class="fas fa-info-circle"></i></button>
                                                    <button class="btn btn-sm btn-outline-success"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-file"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>1</td>
                                        <td>PA01</td>
                                        <td>Asdsk</td>
                                        <td>Uwekjms</td>
                                        <td>Fioweknj ijqwme</td>
                                        <td>535165151</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Button group">
                                                <button class="btn btn-sm btn-outline-warning"><i class="fas fa-user-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-info"><i class="fas fa-info-circle"></i></button>
                                                <button class="btn btn-sm btn-outline-success"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-file"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>PA02</td>
                                        <td>Gioruu</td>
                                        <td>Vkljasje</td>
                                        <td>Slsdkmkf windn</td>
                                        <td>354165151</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Button group">
                                                <button class="btn btn-sm btn-outline-warning"><i class="fas fa-user-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-info"><i class="fas fa-info-circle"></i></button>
                                                <button class="btn btn-sm btn-outline-success"><i class="far fa-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-file"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @include('cliente.modal.modal_crear_cliente')
@endsection

@if(session('success'))
    <script>
        swal.fire({
            title: 'Éxito',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif