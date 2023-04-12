<div class="col-xl-12 col-sm-12">
    <table class="table table-bordered table-responsive-lg">
        <thead>
            <th>#</th>
            <th>Clave</th>
            <th>Estudio</th>
            <th>Costo</th>
            <th>Tipo de muestra</th>
            <th>indicaciones</th>
            <th>Op</th>
        </thead>
        <tbody>
            @foreach ($recepciones as $recepcion)
            
                <tr>
                    @if($recepcion->estudio != null)
                        <td>{{ $recepcion->estudio->id}}</td>
                        <td>{{ $recepcion->estudio->est_cod }}</td>
                        <td>{{ $recepcion->estudio->est_nombre }}</td>
                        <td>{{ $recepcion->estudio->est_precio }}</td>
                        <td>{{ $recepcion->estudio->detalle->muestra->nombre }}</td>
                        <td>{{ $recepcion->estudio->detalle->indicacion->nombre }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    @else
                        <td colspan="7" class="text-center">Detalle no disponible</td>
                    @endif
                    
                </tr>
            @endforeach
            
        </tbody>
    </table>
</div>