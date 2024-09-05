@extends('layouts.app')

@section('styles')
    <!-- Incluye el CSS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Registros Duplicados') }}</div>
                    <div class="card-body">
                        <!-- Tabla de registros eliminados -->
                        <h4>Registros Eliminados</h4>
                        <table class="table table-bordered" id="deletedRecordsTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Precinto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deletedRecords as $record)
                                    <tr>
                                        <td>{{ $record['id'] }}</td>
                                        <td>{{ $record['precinto'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Enlaces de paginación para registros eliminados -->
                        <div class="d-flex justify-content-center">
                            {{ $deletedRecords->links('vendor.pagination.bootstrap-4') }}
                        </div>

                        <!-- Tabla de registros no eliminados -->
                        <h4 class="mt-4">Registros No Eliminados</h4>
                        <button class="btn btn-danger ml-2" id="deleteRecordsButton"
                            onclick="window.location.href='{{ route('exportToExcel') }}'">
                            Exportar Registros
                        </button>
                        <table class="table table-bordered" id="notDeletedRecordsTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Precinto</th>
                                    <th>ID Primer Registro</th>
                                    <th>ID Segundo Registro</th>
                                    <th>Diferencias</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notDeletedRecords as $record)
                                    <tr>
                                        <td>{{ $record['precinto'] }}</td>
                                        <td>{{ $record['primer_registro_id'] }}</td>
                                        <td>{{ $record['segundo_registro_id'] }}</td>
                                        <td>
                                            <div class="difference-content">
                                                @foreach ($record['diferencias'] as $field => $diff)
                                                    <strong>{{ $field }}:</strong><br>
                                                    <em>Primer Registro:</em> {{ $diff['primer_registro'] }}<br>
                                                    <em>Registro Actual:</em> {{ $diff['segundo_registro'] }}<br><br>
                                                @endforeach
                                            </div>
                                            <button class="btn btn-link expand-btn">Ver Más</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Enlaces de paginación para registros no eliminados -->
                        <div class="d-flex justify-content-center">
                            {{ $notDeletedRecords->links('vendor.pagination.bootstrap-4') }}
                        </div>

                        <!-- Botón para abrir el modal -->
                        <button type="button" class="btn btn-primary mt-4" data-toggle="modal"
                            data-target="#criteriaModal">
                            Seleccionar Criterios de Eliminación
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Incluye los scripts de jQuery, Bootstrap, y Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializar Select2 en el multiselect
            $('.js-example-basic-multiple').select2({
                placeholder: 'Selecciona una o más diferencias'

            });

            // Manejar la expansión del contenido
            document.querySelectorAll('.expand-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const content = this.previousElementSibling;
                    if (content.classList.contains('expanded')) {
                        content.classList.remove('expanded');
                        this.textContent = 'Ver Más';
                    } else {
                        content.classList.add('expanded');
                        this.textContent = 'Ver Menos';
                    }
                });
            });
        });
    </script>
@endsection
