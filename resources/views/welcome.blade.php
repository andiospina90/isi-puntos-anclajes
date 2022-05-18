@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Consultar Puntos de Anclaje') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="GET" action="{{ route('welcome') }}">
                                    <div class="row mb-2">
                                        <div class="col-md-2">
                                            <label for="puntoAnclaje"
                                                class="">{{ __('Punto de Anclaje') }}</label>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <input id="puntoAnclaje" type="text" class="form-control"  name="puntoAnclaje" required autocomplete="current-puntoAnclaje">
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <button type="submit" class="btn btn-primary w-100">
                                                {{ __('Consultar') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12  pt-4">
                                @php
                                   // var_dump($pageWasRefreshed);
                                @endphp
                                @if ($puntoAnclaje != null)
                                <div class="card" style="width: 100%;">
                                    <div class="card-body">
                                      <h5 class="card-title" style="font-weight: bold">Sistema de ingenieria</h5>
                                      <h6 class="card-subtitle mb-2 ">Precinto:{{$puntoAnclaje->precinto}}</h6>
                                      <table style="width:100%" class="table">
                                        <tr>
                                          <th>Empresa:</th>
                                          <td>{{$puntoAnclaje->empresa->nombre}}</td>
                                        </tr>
                                        <tr>
                                          <th>Instalador:</th>
                                          <td>{{$puntoAnclaje->instalador}}</td>
                                        </tr>
                                        <tr>
                                            @if ($puntoAnclaje->sistema_proteccion == 0)
                                                <th>Sistema protección:</th>
                                                <td>{{'Punto de anclaje'}}</td>
                                            @elseif ($puntoAnclaje->sistema_proteccion == 1)
                                                <th>Sistema protección:</th>
                                                <td>{{'Línea de vida vertical'}}</td>
                                            @elseif ($puntoAnclaje->sistema_proteccion == 2)
                                                <th>Sistema protección:</th>
                                                <td>{{'Línea de vida horizontal'}}</td>
                                            @elseif ($puntoAnclaje->sistema_proteccion == 3)
                                                <th>Sistema protección:</th>
                                                <td>{{'Escalera'}}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th>Serial:</th>
                                            <td>{{$puntoAnclaje->serial}}</td>
                                        </tr>
                                        <tr>
                                            <th>Precinto:</th>
                                            <td>{{$puntoAnclaje->precinto}}</td>
                                        </tr>
                                        <tr>
                                            @if ($puntoAnclaje->estado == 0)
                                                <th>Sistema protección:</th>
                                                <td>{{'No aprobado'}}</td>
                                            @elseif ($puntoAnclaje->sistema_proteccion == 1)
                                                <th>Sistema protección:</th>
                                                <td>{{'Aporbado'}}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th>Fecha de instalación:</th>
                                            <td>{{$puntoAnclaje->fecha_instalacion}}</td>
                                        </tr>
                                        <tr>
                                            <th>Fecha que se inspecciono:</th>
                                            <td>{{$puntoAnclaje->fecha_inspeccion}}</td>
                                        </tr>
                                        <tr>
                                            <th>Fecha proxima inspección:</th>
                                            <td>{{$puntoAnclaje->fecha_proxima_inspeccion}}</td>
                                        </tr>
                                        <tr>
                                            <th>Marca:</th>
                                            <td>{{$puntoAnclaje->marca}}</td>
                                        </tr>
                                        <tr>
                                            <th>Número de usuarios:</th>
                                            <td>{{$puntoAnclaje->numero_usuarios}}</td>
                                        </tr>
                                        <tr>
                                            <th>Uso:</th>
                                            <td>{{$puntoAnclaje->uso}}</td>
                                        </tr>
                                        <tr>
                                            <th>Resistencia:</th>
                                            <td>{{$puntoAnclaje->resistencia}} lb</td>
                                        </tr>
                                        <tr>
                                            <th>Ubicación:</th>
                                            <td>{{$puntoAnclaje->ubicacion}}</td>
                                        </tr>
                                        <tr>
                                            <th>Observaciones:</th>
                                            <td>{{$puntoAnclaje->observaciones}}</td>
                                        </tr>
                                      </table>
                                    </div>
                                  </div>
                                @else
                                @if ($showAlert)
                                <div class="alert alert-danger  alert-dismissible fade show" role="alert" id="alert-index">

                                    {!!$message !!}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif

                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src='{{ asset("js/app/index.js") }}'></script>
@endsection
