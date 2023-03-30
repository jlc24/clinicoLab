@extends('layouts.app')

@section('contenido')
    
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Inicio</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $contUser }}</h3>
            
                            <p>Usuarios Registrados</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $contmed }}</h3>
                            <p>Medicos Registrados</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('medico') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $contcli }}</h3>
                            <p>Clientes Registrados</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('cliente') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                  <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>
        
                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="card bg-gradient-info">
                        <div class="card-header border-0">
                          <h3 class="card-title">
                            <i class="fas fa-th mr-1"></i>
                            Sales Graph
                          </h3>
                        </div>
                        <div class="card-body">
                          <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer bg-transparent">
                          <div class="row">
                            <div class="col-4 text-center">
                              <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                                     data-fgColor="#39CCCC">
          
                              <div class="text-white">Mail-Orders</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                              <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                                     data-fgColor="#39CCCC">
          
                              <div class="text-white">Online</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                              <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                                     data-fgColor="#39CCCC">
          
                              <div class="text-white">In-Store</div>
                            </div>
                            <!-- ./col -->
                          </div>
                          <!-- /.row -->
                        </div>
                        <!-- /.card-footer -->
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card bg-gradient-success">
                        <div class="card-header border-0">
          
                            <h3 class="card-title">
                                <i class="far fa-calendar-alt"></i>
                                Calendario
                            </h3>
                            <!-- tools card -->
                            <div class="card-tools">
                                <!-- button with a dropdown -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a href="#" class="dropdown-item">Nuevo evento</a>
                                        <a href="#" class="dropdown-item">Limpiar eventos</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item">Ver calendario</a>
                                    </div>
                                </div>
                            </div>
                          <!-- /. tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-0">
                          <!--The calendar -->
                          <div id="calendar" style="width: 100%"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
            </div>
        </div>
    </section>
    
@endsection
