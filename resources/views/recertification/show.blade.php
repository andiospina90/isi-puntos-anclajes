@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Sistemas de ingeniería.') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{-- <div class="row pb-4 d-flex flex-row-reverse mb-2">
                            <div class="col-md-2  mb-2">
                                <a class="btn btn-primary ml-1" href="{{ url('/exportar') }}" role="button"
                                    style="background-color: orangered; border-color: orangered">Descargar en excel</a>
                            </div>
                        </div> --}}
                        <table class="table " id="recertificacionesTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sistema de protección</th>
                                    <th>Propuesta principal</th>
                                    <th>Propuesta recertificación</th>
                                    <th>Precinto</th>
                                    <th>Serial</th>
                                    <th>Empresa</th>
                                    <th>Fecha recirtificación</th>
                                    <th>Marca</th>
                                    <th>Número de usuarios</th>
                                    <th>Uso</th>
                                    <th>Estado</th>
                                    <th>Ubicación</th>
                                    <th>Observaciones</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src='{{ asset('js/app/recertification.js') }}'></script>
@endsection
