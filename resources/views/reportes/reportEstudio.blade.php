@extends('layouts.app')

@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Reportes') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Inicio') }}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ __('Reportes') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Estudios') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-sm-12">
                    <div class="card card-success">
                        <div class="card-header" style="padding-top: 15px;">
                            <h4 class="card-title">
                                {{ __('Reporte Estudios') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-xl-4 col-sm-12">
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <button class="btn btn-sm btn-success" id="calendario"><i class="fas fa-calendar"></i></button>
                                        </div>
                                        <div class="col-xl-10">
                                            <input type="text" name="fecha" id="fecha" class="form-control form-control-sm" disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-sm-12 text-right">
                                    <div class="btn-group" role="group" aria-label="Button group">
                                        <button class="btn btn-outline-danger btn-sm" title="Exportar a PDF"><i class="fas fa-file-pdf fa-2x"></i></button>
                                        <button class="btn btn-outline-warning btn-sm" title="Exportar a CSV"><i class="fas fa-file-csv fa-2x"></i></button>
                                        <button class="btn btn-outline-success btn-sm" title="Exportar a Excel"><i class="fas fa-file-excel fa-2x"></i></button>
                                        <button class="btn btn-outline-primary btn-sm" title="Exportar a Word"><i class="fas fa-file-word fa-2x"></i></button>
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-xl-12 col-sm-12" id="tabla_grupos_subgrupos">
                                    <table class="table table-sm table-bordered table-responsive-sm">
                                        <thead  style="background-color: #BDD7EE">
                                            <th style="width: 20%">Grupo:</th>
                                            <th style="width: 80%" id="Grupo_">QUIMICA SANGUINEA</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="2">
                                                    <table class="table table-sm table-bordered table-hover table-responsive-sm" id="tabla_subgrupos">
                                                        <thead style="background-color: #C6E0B4">
                                                            <th style="width: 20%">Subgrupo:</th>
                                                            <th style="width: 80%">PERFIL PANCREATICO</th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2" style="background-color: #D9D9D9">
                                                                    <table class="table table-sm table-bordered table-responsive-sm" id="tabla_estudios_subgrupo" style="background-color: #fff">
                                                                        <thead class="text-center">
                                                                            <th style="width: 40%"></th>
                                                                            <th>Unidad</th>
                                                                            <th>Med.</th>
                                                                            <th>P. Unitario</th>
                                                                            <th>Cantidad</th>
                                                                            <th>P. total</th>
                                                                            <th></th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th colspan="7">Ingresos</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>GLUCOSA</th>
                                                                                <th class="text-right">1</th>
                                                                                <th></th>
                                                                                <th class="text-right">150,00</th>
                                                                                <th class="text-right">13</th>
                                                                                <th class="text-right">1950,00</th>
                                                                                <th>Bs</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="7">Egresos</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th class="text-center" colspan="7">Materiales y/o Herramientas</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>MAT1</td>
                                                                                <td class="text-right">1</td>
                                                                                <td>Kg</td>
                                                                                <td class="text-right">5,00</td>
                                                                                <td class="text-right">13</td>
                                                                                <td class="text-right">65,00</td>
                                                                                <td>Bs</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>MAT2</td>
                                                                                <td class="text-right">0,5</td>
                                                                                <td>%</td>
                                                                                <td class="text-right">2,00</td>
                                                                                <td class="text-right">13</td>
                                                                                <td class="text-right">26,00</td>
                                                                                <td>Bs</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="5" class="text-center">Total</th>
                                                                                <th class="text-right">91,00</th>
                                                                                <th>Bs</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th class="text-center" colspan="7">Medicos</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>MED1</td>
                                                                                <td class="text-right">1</td>
                                                                                <td>%</td>
                                                                                <td class="text-right">1,50</td>
                                                                                <td class="text-right">2</td>
                                                                                <td class="text-right">3,00</td>
                                                                                <td>Bs</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>MED2</td>
                                                                                <td class="text-right">1,2</td>
                                                                                <td>%</td>
                                                                                <td class="text-right">1,80</td>
                                                                                <td class="text-right">5</td>
                                                                                <td class="text-right">9,00</td>
                                                                                <td>Bs</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>MED3</td>
                                                                                <td class="text-right">1,1</td>
                                                                                <td>%</td>
                                                                                <td class="text-right">1,65</td>
                                                                                <td class="text-right">6</td>
                                                                                <td class="text-right">9,90</td>
                                                                                <td>Bs</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="5" class="text-center">Total</th>
                                                                                <th class="text-right">21,90</th>
                                                                                <th>Bs</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="7">Ganancia Neta</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="5"  class="text-center">TOTAL</th>
                                                                                <th class="text-right">1837,10</th>
                                                                                <th>Bs</th>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table class="table table-sm table-bordered table-responsive-sm" style="background-color: #fff">
                                                                        <thead>
                                                                            <th style="width: 40%"></th>
                                                                            <th>Unidad</th>
                                                                            <th>Med.</th>
                                                                            <th>P. Unitario</th>
                                                                            <th>Cantidad</th>
                                                                            <th>P. total</th>
                                                                            <th></th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th colspan="7">Ingresos</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>AMILASA</th>
                                                                                <th class="text-right">1</th>
                                                                                <th></th>
                                                                                <th class="text-right">150,00</th>
                                                                                <th class="text-right">13</th>
                                                                                <th class="text-right">1950,00</th>
                                                                                <th>Bs</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="7">Egresos</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th class="text-center" colspan="7">Materiales y/o Herramientas</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>MAT1</td>
                                                                                <td class="text-right">1</td>
                                                                                <td>Kg</td>
                                                                                <td class="text-right">5,00</td>
                                                                                <td class="text-right">13</td>
                                                                                <td class="text-right">65,00</td>
                                                                                <td>Bs</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>MAT2</td>
                                                                                <td class="text-right">0,5</td>
                                                                                <td>%</td>
                                                                                <td class="text-right">2,00</td>
                                                                                <td class="text-right">13</td>
                                                                                <td class="text-right">26,00</td>
                                                                                <td>Bs</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="5" class="text-center">Total</th>
                                                                                <th class="text-right">91,00</th>
                                                                                <th>Bs</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th class="text-center" colspan="7">Medicos</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>MED1</td>
                                                                                <td class="text-right">1</td>
                                                                                <td>%</td>
                                                                                <td class="text-right">1,50</td>
                                                                                <td class="text-right">2</td>
                                                                                <td class="text-right">3,00</td>
                                                                                <td>Bs</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>MED2</td>
                                                                                <td class="text-right">1,2</td>
                                                                                <td>%</td>
                                                                                <td class="text-right">1,80</td>
                                                                                <td class="text-right">5</td>
                                                                                <td class="text-right">9,00</td>
                                                                                <td>Bs</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>MED3</td>
                                                                                <td class="text-right">1,1</td>
                                                                                <td>%</td>
                                                                                <td class="text-right">1,65</td>
                                                                                <td class="text-right">6</td>
                                                                                <td class="text-right">9,90</td>
                                                                                <td>Bs</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="5" class="text-center">Total</th>
                                                                                <th class="text-right">21,90</th>
                                                                                <th>Bs</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="7">Ganancia Neta</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="5" class="text-center">TOTAL</th>
                                                                                <th class="text-right">1837,10</th>
                                                                                <th>Bs</th>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="table table-sm table-bordered table-hover table-responsive-sm">
                                                        <thead style="background-color: #C6E0B4">
                                                            <th style="width: 20%">Subgrupo:</th>
                                                            <th style="width: 80%">PERFIL RENAL</th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2" style="background-color: #D9D9D9">
                                                                    <table class="table table-sm table-bordered table-responsive-sm" style="background-color: #fff">
                                                                        <thead>
                                                                            <th style="width: 40%"></th>
                                                                            <th>Unidad</th>
                                                                            <th>Med.</th>
                                                                            <th>P. Unitario</th>
                                                                            <th>Cantidad</th>
                                                                            <th>P. total</th>
                                                                            <th></th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th colspan="7">Ingresos</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>CREATININA</th>
                                                                                <th class="text-right">1</th>
                                                                                <th></th>
                                                                                <th class="text-right">150,00</th>
                                                                                <th class="text-right">13</th>
                                                                                <th class="text-right">1950,00</th>
                                                                                <th>Bs</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="7">Egresos</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th class="text-center" colspan="7">Materiales y/o Herramientas</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>MAT1</td>
                                                                                <td class="text-right">1</td>
                                                                                <td>Kg</td>
                                                                                <td class="text-right">5,00</td>
                                                                                <td class="text-right">13</td>
                                                                                <td class="text-right">65,00</td>
                                                                                <td>Bs</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>MAT2</td>
                                                                                <td class="text-right">0,5</td>
                                                                                <td>%</td>
                                                                                <td class="text-right">2,00</td>
                                                                                <td class="text-right">13</td>
                                                                                <td class="text-right">26,00</td>
                                                                                <td>Bs</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="5" class="text-center">Total</th>
                                                                                <th class="text-right">91,00</th>
                                                                                <th>Bs</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th class="text-center" colspan="7">Medicos</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>MED1</td>
                                                                                <td class="text-right">1</td>
                                                                                <td>%</td>
                                                                                <td class="text-right">1,50</td>
                                                                                <td class="text-right">2</td>
                                                                                <td class="text-right">3,00</td>
                                                                                <td>Bs</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>MED2</td>
                                                                                <td class="text-right">1,2</td>
                                                                                <td>%</td>
                                                                                <td class="text-right">1,80</td>
                                                                                <td class="text-right">5</td>
                                                                                <td class="text-right">9,00</td>
                                                                                <td>Bs</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>MED3</td>
                                                                                <td class="text-right">1,1</td>
                                                                                <td>%</td>
                                                                                <td class="text-right">1,65</td>
                                                                                <td class="text-right">6</td>
                                                                                <td class="text-right">9,90</td>
                                                                                <td>Bs</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="5" class="text-center">Total</th>
                                                                                <th class="text-right">21,90</th>
                                                                                <th>Bs</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="7">Ganancia Neta</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="5" class="text-center">TOTAL</th>
                                                                                <th class="text-right">1837,10</th>
                                                                                <th>Bs</th>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-sm-12" id="tabla_grupos" hidden>
                                    <table class="table table-sm table-bordered table-hover table-responsive-sm">
                                        <thead  style="background-color: #BDD7EE">
                                            <th style="width: 20%">Grupo:</th>
                                            <th style="width: 80%">UROANALISIS</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="2" style="background-color: #D9D9D9">
                                                    <table class="table table-sm table-bordered table-responsive-sm" style="background-color: #fff">
                                                        <thead>
                                                            <th style="width: 40%"></th>
                                                            <th>Unidad</th>
                                                            <th>Med.</th>
                                                            <th>P. Unitario</th>
                                                            <th>Cantidad</th>
                                                            <th>P. total</th>
                                                            <th></th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th colspan="7">Ingresos</th>
                                                            </tr>
                                                            <tr>
                                                                <th>EXAMEN GENERAL DE ORINA</th>
                                                                <th class="text-right">1</th>
                                                                <th></th>
                                                                <th class="text-right">150,00</th>
                                                                <th class="text-right">13</th>
                                                                <th class="text-right">1950,00</th>
                                                                <th>Bs</th>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="7">Egresos</th>
                                                            </tr>
                                                            <tr>
                                                                <th class="text-center" colspan="7">Materiales y/o Herramientas</th>
                                                            </tr>
                                                            <tr>
                                                                <td>MAT1</td>
                                                                <td class="text-right">1</td>
                                                                <td>Kg</td>
                                                                <td class="text-right">5,00</td>
                                                                <td class="text-right">13</td>
                                                                <td class="text-right">65,00</td>
                                                                <td>Bs</td>
                                                            </tr>
                                                            <tr>
                                                                <td>MAT2</td>
                                                                <td class="text-right">0,5</td>
                                                                <td>%</td>
                                                                <td class="text-right">2,00</td>
                                                                <td class="text-right">13</td>
                                                                <td class="text-right">26,00</td>
                                                                <td>Bs</td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="5" class="text-center">Total</th>
                                                                <th class="text-right">91,00</th>
                                                                <th>Bs</th>
                                                            </tr>
                                                            <tr>
                                                                <th class="text-center" colspan="7">Medicos</th>
                                                            </tr>
                                                            <tr>
                                                                <td>MED1</td>
                                                                <td class="text-right">1</td>
                                                                <td>%</td>
                                                                <td class="text-right">1,50</td>
                                                                <td class="text-right">2</td>
                                                                <td class="text-right">3,00</td>
                                                                <td>Bs</td>
                                                            </tr>
                                                            <tr>
                                                                <td>MED2</td>
                                                                <td class="text-right">1,2</td>
                                                                <td>%</td>
                                                                <td class="text-right">1,80</td>
                                                                <td class="text-right">5</td>
                                                                <td class="text-right">9,00</td>
                                                                <td>Bs</td>
                                                            </tr>
                                                            <tr>
                                                                <td>MED3</td>
                                                                <td class="text-right">1,1</td>
                                                                <td>%</td>
                                                                <td class="text-right">1,65</td>
                                                                <td class="text-right">6</td>
                                                                <td class="text-right">9,90</td>
                                                                <td>Bs</td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="5" class="text-center">Total</th>
                                                                <th class="text-right">21,90</th>
                                                                <th>Bs</th>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="7">Ganancia Neta</th>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="5" class="text-center">TOTAL</th>
                                                                <th class="text-right">1837,10</th>
                                                                <th>Bs</th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="table table-sm table-bordered table-responsive-sm" style="background-color: #fff">
                                                        <thead>
                                                            <th style="width: 40%"></th>
                                                            <th>Unidad</th>
                                                            <th>Med.</th>
                                                            <th>P. Unitario</th>
                                                            <th>Cantidad</th>
                                                            <th>P. total</th>
                                                            <th></th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th colspan="7">Ingresos</th>
                                                            </tr>
                                                            <tr>
                                                                <th>CREATINURIA EN ORINA OCASIONAL</th>
                                                                <th class="text-right">1</th>
                                                                <th></th>
                                                                <th class="text-right">150,00</th>
                                                                <th class="text-right">13</th>
                                                                <th class="text-right">1950,00</th>
                                                                <th>Bs</th>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="7">Egresos</th>
                                                            </tr>
                                                            <tr>
                                                                <th class="text-center" colspan="7">Materiales y/o Herramientas</th>
                                                            </tr>
                                                            <tr>
                                                                <td>MAT1</td>
                                                                <td class="text-right">1</td>
                                                                <td>Kg</td>
                                                                <td class="text-right">5,00</td>
                                                                <td class="text-right">13</td>
                                                                <td class="text-right">65,00</td>
                                                                <td>Bs</td>
                                                            </tr>
                                                            <tr>
                                                                <td>MAT2</td>
                                                                <td class="text-right">0,5</td>
                                                                <td>%</td>
                                                                <td class="text-right">2,00</td>
                                                                <td class="text-right">13</td>
                                                                <td class="text-right">26,00</td>
                                                                <td>Bs</td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="5" class="text-center">Total</th>
                                                                <th class="text-right">91,00</th>
                                                                <th>Bs</th>
                                                            </tr>
                                                            <tr>
                                                                <th class="text-center" colspan="7">Medicos</th>
                                                            </tr>
                                                            <tr>
                                                                <td>MED1</td>
                                                                <td class="text-right">1</td>
                                                                <td>%</td>
                                                                <td class="text-right">1,50</td>
                                                                <td class="text-right">2</td>
                                                                <td class="text-right">3,00</td>
                                                                <td>Bs</td>
                                                            </tr>
                                                            <tr>
                                                                <td>MED2</td>
                                                                <td class="text-right">1,2</td>
                                                                <td>%</td>
                                                                <td class="text-right">1,80</td>
                                                                <td class="text-right">5</td>
                                                                <td class="text-right">9,00</td>
                                                                <td>Bs</td>
                                                            </tr>
                                                            <tr>
                                                                <td>MED3</td>
                                                                <td class="text-right">1,1</td>
                                                                <td>%</td>
                                                                <td class="text-right">1,65</td>
                                                                <td class="text-right">6</td>
                                                                <td class="text-right">9,9</td>
                                                                <td>Bs</td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="5" class="text-center">Total</th>
                                                                <th class="text-right">21,90</th>
                                                                <th>Bs</th>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="7">Ganancia Neta</th>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="5" class="text-center">TOTAL</th>
                                                                <th class="text-right">1837,10</th>
                                                                <th>Bs</th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('funciones')
    @include('reportes.funciones.funcion_reporteEstudio')
@endsection