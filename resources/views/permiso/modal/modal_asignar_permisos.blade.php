<div class="modal fade" id="modal_asginar_permiso" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_asginar_permisoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_asginar_permisoLabel"><strong>{{ __('Asignar Permisos') }}</strong></h1>
                <button type="button" id="btnCloseAddPermiso" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="user_id" id="user_id" class="user_id">
                <div class="row">
                    {{-- @php
                        $permisoArray = $permisos->toArray();
                        $chunks = array_chunk($permisoArray, ceil(count($permisoArray) / 2));
                    @endphp --}}
                    <div class="col-md-12">
                        <div class="card">
                            <table class="table table-sm table-bordered table-light" style="width: 100%;">
                                <tr>
                                    <td style="width: 50%; padding: 0; margin: 0;">
                                        <table class="table table-sm table-bordered tabla-permiso1">
                                            <thead class="thead-light">
                                                <th hidden>#</th>
                                                <th>Nombre</th>
                                                <th class="text-center">Acceso</th>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach ($chunks[0] as $permiso)
                                                    <tr>
                                                        <td hidden>{{ $permiso['id'] }}</td>
                                                        <td>{{ $permiso['permiso'] }}</td>
                                                        <td class="text-center"><input type="checkbox" name="checkPermiso" id="checkPermiso" class="checkPermiso"></td>
                                                    </tr>
                                                @endforeach --}}
                                            </tbody>
                                        </table>
                                    </td>
                                    <td style="width: 50%; padding: 0; margin: 0;">
                                        <table class="table table-sm table-bordered tabla-permiso2">
                                            <thead class="thead-light">
                                                <th hidden>#</th>
                                                <th>Nombre</th>
                                                <th class="text-center">Acceso</th>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach ($chunks[1] as $permiso)
                                                    <tr>
                                                        <td hidden>{{ $permiso['id'] }}</td>
                                                        <td>{{ $permiso['permiso'] }}</td>
                                                        <td class="text-center"><input type="checkbox" name="checkPermiso" id="checkPermiso" class="checkPermiso"></td>
                                                    </tr>
                                                @endforeach --}}
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>