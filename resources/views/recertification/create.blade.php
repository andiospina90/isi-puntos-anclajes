@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ __('Recertificacion de precinto') }}</h2>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->has('precinto'))
                            <div class="alert alert-danger">
                            {{ $errors->first('precinto') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <form method="POST" action="{{ route('recertification.store') }}">
                                    @csrf
                                    <input type="hidden" name="id_propuesta" value="{{ $propouse }}">
                                    <div class="mb-3">
                                        <label for="propuesta_recertificacion" class="form-label">Número de propuesta recertificación</label>
                                        <input type="text" class="form-control" id="propuesta_recertificacion" aria-describedby=""
                                            name="propuesta_recertificacion" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="0" class="form-label">Sistema protección</label>
                                        <select class="form-control form-select" id="sistema_proteccion"
                                            name="sistema_proteccion" required>
                                            {{-- <option value="PUNTO DE ANCLAJE">PUNTO DE ANCLAJE</option>
                                            <option value="LÍNEA DE VIDA VERTICAL">LÍNEA DE VIDA VERTICAL</option>
                                            <option value="LÍNEA DE VIDA HORIZONTAL">LÍNEA DE VIDA HORIZONTAL</option>
                                            <option value="ESCALERA">ESCALERA</option>
                                            <option value="CANASTILLA">CANASTILLA</option> --}}
                                            <option value="" readonly selected>Selecciona una opción</option>
                                            @if ($sistemaProteccion != 'undefined')
                                                @foreach ($sistemaProteccion as $sistemaProteccion)
                                                    <option value="{{ $sistemaProteccion->id }}">
                                                        {{ $sistemaProteccion->nombre }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Número precinto
                                            Inicial</label>
                                        <input type="number" class="form-control" id="precinto_inicial" aria-describedby=""
                                            name="precinto_inicial" required>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Número precinto final</label>
                                        <input type="number" class="form-control" id="precinto_final" aria-describedby=""
                                            name="precinto_final" required>
                                        <label for="" class="form-label" id="error_preciento_final"
                                            style='display:none'>El número de precinto final no puede ser menor al
                                            inicial.</label>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Estado</label>
                                        <select class="form-control form-select" id="estado" name="estado" required>
                                            <option value="APROBADO">APROBADO</option>
                                            <option value="NO APROBADO">NO APROBADO</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Fecha de recertificación</label>
                                        <input type="date" class="form-control" id="fecha_recertificacion"
                                            aria-describedby="" name="fecha_recertificacion" required>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Marca</label>
                                        <select class="form-control form-select" id="marca" name="marca" required>
                                            <option value="ISI INGENIERÍA">ISI INGENIERÍA</option>
                                            <option value="YOKE">YOKE</option>
                                            <option value="OTRO">OTRO</option>
                                        </select>
                                        <label for="exampleInputPassword1" id="marca_otro" class="form-label"
                                            style='display:none'>Cual ?</label>
                                        <input type="text" class="form-control" id="marca_otro_input" aria-describedby=""
                                            name="marca_otro" onkeyup="this.value = this.value.toUpperCase();"
                                            style='display:none'>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Número de usuarios</label>
                                        <select class="form-control form-select" id="numero_usuarios"
                                            name="numero_usuarios" readonly required>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Uso</label>
                                        <select class="form-control form-select" id="uso" name="uso" required>
                                            <option value="" readonly selected>Selecciona una opción</option>
                                            @if ($usos != 'undefined')
                                                @foreach ($usos as $usos)
                                                    <option value="{{ $usos->uso_sistema_proteccion }}">
                                                        {{ $usos->uso_sistema_proteccion }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Observaciones</label>
                                        <input type="text" class="form-control" id="" aria-describedby=""
                                            name="observaciones" onkeyup="this.value = this.value.toUpperCase();">
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Ubicación</label>
                                        <input type="text" class="form-control" id="" aria-describedby=""
                                            name="ubicacion" required onkeyup="this.value = this.value.toUpperCase();">
                                    </div>
                                    <div class="mb-3 ">
                                        <button type="submit" class="btn btn-primary" id="guardar" style="background-color: orangered; border-color: orangered">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src='{{ asset('js/app/puntoAnclajes.js') }}'></script>
@endsection
