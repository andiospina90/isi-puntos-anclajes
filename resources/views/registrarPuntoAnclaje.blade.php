@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ __('Registrar precinto') }}</h2>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-12">
                                <form method="POST" action="{{ route('insertarPuntoAnclaje') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Empresa</label>
                                        <select class="form-control form-select" id="id_empresa" name="id_empresa" required>
                                            <option value="" readonly selected>Selecciona una opción</option>
                                            @if ($empresas != 'undefined')
                                                @foreach ($empresas as $empresa)
                                                    <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Instalador</label>
                                        <input type="text" class="form-control" id="" aria-describedby="" name="instalador" required onkeyup="this.value = this.value.toUpperCase();">
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Persona calificada</label>
                                        <input type="text" class="form-control" id="" aria-describedby="" name="persona_calificada" required onkeyup="this.value = this.value.toUpperCase();">
                                    </div>
                                    <div class="mb-3">
                                        <label for="0" class="form-label">Sistema protección</label>
                                        <select class="form-control form-select" id="sistema_proteccion" name="sistema_proteccion" required>
                                            <option value="PUNTO DE ANCLAJE">PUNTO DE ANCLAJE</option>
                                            <option value="LÍNEA DE VIDA VERTICAL">LÍNEA DE VIDA VERTICAL</option>
                                            <option value="LÍNEA DE VIDA HORIZONTAL">LÍNEA DE VIDA HORIZONTAL</option>
                                            <option value="ESCALERA">ESCALERA</option>
                                            <option value="CANASTILLA">CANASTILLA</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Precinto</label>
                                        <input type="number" class="form-control" id="" aria-describedby="" name="precinto" required>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Estado</label>
                                        <select class="form-control form-select" id="sistema_proteccion" name="estado" required>
                                            <option value="APROBADO">APROBADO</option>
                                            <option value="NO APROBADO">NO APROBADO</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Fecha de instalación</label>
                                        <input type="date" class="form-control" id="fecha_instalacion" aria-describedby="" name="fecha_instalacion" readonly required>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Fecha de inspección</label>
                                        <input type="date" class="form-control" id="fecha_inspeccion" aria-describedby="fecha_inspeccion" name="fecha_inspeccion" required>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Resistencia en libras</label>
                                        <input type="text" class="form-control" id="" aria-describedby="" name="resistencia" value="5000" readonly required>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Marca</label>
                                        <select class="form-control form-select" id="marca" name="marca" required>
                                            <option value="ISI INGENIERÍA">ISI INGENIERÍA</option>
                                            <option value="YOKE">YOKE</option>
                                            <option value="OTRO">OTRO</option>
                                        </select>
                                        <label for="exampleInputPassword1" id="marca_otro" class="form-label" style='display:none'>Cual ?</label>
                                        <input type="text" class="form-control" id="marca_otro_input" aria-describedby="" name="marca_otro" onkeyup="this.value = this.value.toUpperCase();" style='display:none'>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Número de usuarios</label>
                                        <select class="form-control form-select" id="numero_usuarios" name="numero_usuarios" readonly required>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Uso</label>
                                        <select class="form-control form-select" id="sistema_proteccion" name="uso" required>
                                            <option value="RESTRICCIÓN">RESTRICCIÓN</option>
                                            <option value="POSICIONAMIENTO">POSICIONAMIENTO</option>
                                            <option value="DETENCIÓN">DETENCIÓN</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Observaciones</label>
                                        <input type="text" class="form-control" id="" aria-describedby="" name="observaciones" onkeyup="this.value = this.value.toUpperCase();">
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Ubicación</label>
                                        <input type="text" class="form-control" id="" aria-describedby="" name="ubicacion" required onkeyup="this.value = this.value.toUpperCase();">
                                    </div>
                                    <div class="mb-3 ">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
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
