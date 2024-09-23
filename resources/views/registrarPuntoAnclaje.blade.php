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
                        @if ($errors->has('precinto'))
    `                       <div class="alert alert-danger">
                            {{ $errors->first('precinto') }}
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
                                                <option value="{{ $empresa->id }}" {{ old('id_empresa') == $empresa->id ? 'selected' : '' }}>
                                                    {{ $empresa->nombre }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="numero_propuesta" class="form-label">Número de propuesta</label>
                                        <input type="text" class="form-control" id="numero_propuesta" aria-describedby="" name="numero_propuesta" value="{{ old('numero_propuesta') }}" required>
                                    </div>    
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Instalador</label>
                                        <select class="form-control form-select" id="instalador" name="instalador" required>
                                            <option value="" readonly selected>Selecciona una opción</option>
                                            {{-- <option value="WILLIAM HERNÁNDEZ CÓRDOBA">WILLIAM HERNÁNDEZ CÓRDOBA</option>
                                            <option value="CARLOS FERNANDO ZAMBRANO">CARLOS FERNANDO ZAMBRANO</option>
                                            <option value="RONALDO SUAZA SUAZA">RONALDO SUAZA SUAZA</option> --}}
                                                @if ($instaladores != 'undefined')
                                                @foreach ($instaladores as $instaladores)
                                                    <option value="{{ $instaladores->nombre }}" {{ old('instalador') == $instaladores->nombre ? 'selected' : '' }}>
                                                        {{ $instaladores->nombre }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Persona calificada</label>
                                        <select class="form-control form-select" id="persona_calificada" name="persona_calificada" required>
                                            <option value="DANIEL VELÁSQUEZ ARTEAGA">DANIEL VELÁSQUEZ ARTEAGA</option>
                                            @if ($personaCalificada != 'undefined')
                                                @foreach ($personaCalificada as $personaCalificada)
                                                    <option value="{{ $personaCalificada->nombre }}" {{ old('persona_calificada') == $personaCalificada->nombre ? 'selected' : '' }}>
                                                        {{ $personaCalificada->nombre }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="0" class="form-label">Sistema protección</label>
                                        <select class="form-control form-select" id="sistema_proteccion" name="sistema_proteccion" required>
                                            {{-- <option value="PUNTO DE ANCLAJE">PUNTO DE ANCLAJE</option>
                                            <option value="LÍNEA DE VIDA VERTICAL">LÍNEA DE VIDA VERTICAL</option>
                                            <option value="LÍNEA DE VIDA HORIZONTAL">LÍNEA DE VIDA HORIZONTAL</option>
                                            <option value="ESCALERA">ESCALERA</option>
                                            <option value="CANASTILLA">CANASTILLA</option> --}}
                                            <option value="" readonly selected>Selecciona una opción</option>
                                            @if ($sistemaProteccion != 'undefined')
                                                @foreach ($sistemaProteccion as $sistemaProteccion)
                                                    <option value="{{ $sistemaProteccion->nombre }}" {{ old('sistema_proteccion') == $sistemaProteccion->nombre ? 'selected' : '' }}>
                                                        {{ $sistemaProteccion->nombre }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Número precinto Inicial</label>
                                        <input type="number" class="form-control" id="precinto_inicial" aria-describedby="" name="precinto_inicial" value="{{ old('precinto_inicial') }}" required>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Número precinto final</label>
                                        <input type="number" class="form-control" id="precinto_final" aria-describedby="" name="precinto_final" value="{{ old('precinto_final') }}" required>
                                        <label for="" class="form-label" id="error_preciento_final" style='display:none'>El número de precinto final no puede ser menor al inicial o igual.</label>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Estado</label>
                                        <select class="form-control form-select" id="estado" name="estado" required>
                                            <option value="APROBADO" {{ old('estado') == 'APROBADO' ? 'selected' : '' }}>APROBADO</option>
                                            <option value="NO APROBADO" {{ old('estado') == 'NO APROBADO' ? 'selected' : '' }}>NO APROBADO</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Fecha de instalación</label>
                                        <input type="date" class="form-control" id="fecha_instalacion" aria-describedby="" name="fecha_instalacion" value="{{ old('fecha_instalacion') }}" required>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Fecha de inspección</label>
                                        <input type="date" class="form-control" id="fecha_inspeccion" aria-describedby="fecha_inspeccion" name="fecha_inspeccion" value="{{ old('fecha_inspeccion') }}" required>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Resistencia en libras</label>
                                        <input type="text" class="form-control" id="" aria-describedby="" name="resistencia" value="{{ old('resistencia') }}" required>

                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Marca</label>
                                        <select class="form-control form-select" id="marca" name="marca" required>
                                            <option value="ISI INGENIERÍA">ISI INGENIERÍA</option>
                                            <option value="YOKE" {{ old('marca') == 'YOKE' ? 'selected' : '' }}>YOKE</option>
                                            <option value="OTRO" {{ old('marca') == 'OTRO' ? 'selected' : '' }}>OTRO</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                    <label for="" id="marca_otro" class="form-label" style='display:none'>Cual ?</label>
                                        <input type="text" class="form-control" id="marca_otro_input" aria-describedby="" name="marca_otro" onkeyup="this.value = this.value.toUpperCase();" style='display:none' value="">
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Número de usuarios</label>
                                        <select class="form-control form-select" id="numero_usuarios" name="numero_usuarios" readonly required>
                                            <option value="1" {{ old('numero_usuarios') == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('numero_usuarios') == '2' ? 'selected' : '' }}>2</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Uso</label>
                                        <select class="form-control form-select" id="uso" name="uso" required>
                                            <option value="" readonly selected>Selecciona una opción</option>
                                            @if ($usos != 'undefined')
                                                @foreach ($usos as $usos)
                                                    <option value="{{ $usos->uso_sistema_proteccion }}" {{ old('uso') == $usos->uso_sistema_proteccion ? 'selected' : '' }}>
                                                        {{ $usos->uso_sistema_proteccion }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Observaciones</label>
                                        <input type="text" class="form-control" id="" aria-describedby="" name="observaciones" onkeyup="this.value = this.value.toUpperCase();" value="{{ old('observaciones') }}">
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Ubicación</label>
                                        <input type="text" class="form-control" id="" aria-describedby="" name="ubicacion" required onkeyup="this.value = this.value.toUpperCase();" value="{{ old('ubicacion') }}">
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
