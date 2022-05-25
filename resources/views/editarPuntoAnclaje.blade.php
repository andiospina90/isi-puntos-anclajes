@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ __('Editar sistema de ingeniería') }}</h2>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-12">
                                <form method="POST" action="{{ route('actualizarPuntoAnclaje',$puntoAnclaje->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Empresa</label>
                                        <select class="form-control form-select" id="id_empresa" name="id_empresa" required>
                                            <option value="" readonly selected>Selecciona una opción</option>
                                            @if ($empresas != 'undefined')
                                                @foreach ($empresas as $empresa)
                                                    <option value="{{ $empresa->id }}" {{($empresa->id == $puntoAnclaje->id_empresa)? 'selected':''}}>{{ $empresa->nombre }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Persona calificada</label>
                                        <input type="text" class="form-control" id="" aria-describedby="" name="instalador" onkeyup="this.value = this.value.toUpperCase();" value="{{$puntoAnclaje->instalador}}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="0" class="form-label">Sistema protección</label>
                                        <select class="form-control form-select" id="sistema_proteccion" name="sistema_proteccion" required>
                                            <option value="0" {{($puntoAnclaje->sistema_proteccion == 0)? 'selected':''}}>PUNTO DE ANCLAJE</option>
                                            <option value="1" {{($puntoAnclaje->sistema_proteccion == 1)? 'selected':''}}>LÍNEA DE VIDA VERTICAL</option>
                                            <option value="2" {{($puntoAnclaje->sistema_proteccion == 2)? 'selected':''}}>LÍNEA DE VIDA HORIZONTAL</option>
                                            <option value="3" {{($puntoAnclaje->sistema_proteccion == 3)? 'selected':''}}>ESCALERA</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Precinto</label>
                                        <input type="number" class="form-control" id="" aria-describedby="" name="precinto" value="{{$puntoAnclaje->precinto}}" required>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Estado</label>
                                        <select class="form-control form-select" id="sistema_proteccion" name="estado" required>
                                            <option value="1" {{($puntoAnclaje->estado  == 1)? 'selected':''}}>APROBADO</option>
                                            <option value="0" {{($puntoAnclaje->estado  == 0)? 'selected':''}}>NO APROBADO/option>
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Fecha de instalación</label>
                                        <input type="date" class="form-control" id="" aria-describedby="" name="fecha_instalacion" value="{{Carbon\Carbon::parse($puntoAnclaje->fecha_instalacion)->format('Y-m-d')}}" required>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Fecha de inspección</label>
                                        <input type="date" class="form-control" id="" aria-describedby="" name="fecha_inspeccion" value="{{Carbon\Carbon::parse($puntoAnclaje->fecha_inspeccion)->format('Y-m-d')}}" required>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Resistencia en libras</label>
                                        <input type="text" class="form-control" id="" aria-describedby="" name="resistencia" value="5000" readonly required>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Marca</label>
                                        <select class="form-control form-select" id="sistema_proteccion" name="marca" required>
                                            <option value="ISI INGENIERÍA" {{('ISI INGENIERÍA' == $puntoAnclaje->marca)? 'selected':''}}>ISI INGENIERÍA</option>
                                            <option value="YOKE" {{('YOKE' == $puntoAnclaje->marca)? 'selected':''}}>YOKE</option>
                                            <option value="OTRO" {{('Otro' == $puntoAnclaje->marca)? 'selected':''}}>OTRO</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Número de usuarios</label>
                                        <select class="form-control form-select" id="numero_usuarios" name="numero_usuarios" readonly required>
                                            <option value="1" {{($puntoAnclaje->numero_usuarios == 1)? 'selected':''}}>1</option>
                                            <option value="2" {{($puntoAnclaje->numero_usuarios == 2)? 'selected':''}}>2</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Uso</label>
                                        <select class="form-control form-select" id="sistema_proteccion" name="uso" required>
                                            <option {{($puntoAnclaje->uso == 'RESTRICCIÓN')? 'selected':''}} value="RESTRICCIÓN">RESTRICCIÓN</option>
                                            <option {{($puntoAnclaje->uso == 'POSICIONAMIENTO')? 'selected':''}} value="POSICIONAMIENTO">POSICIONAMIENTO</option>
                                            <option {{($puntoAnclaje->uso == 'DETENCIÓN')? 'selected':''}} value="DETENCIÓN">DETENCIÓN</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Observaciones</label>
                                        <input type="text" class="form-control" id="" aria-describedby="" onkeyup="this.value = this.value.toUpperCase();" value="{{$puntoAnclaje->observaciones}}" name="observaciones">
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Ubicación</label>
                                        <input type="text" class="form-control" id="" aria-describedby="" onkeyup="this.value = this.value.toUpperCase();" value="{{$puntoAnclaje->ubicacion}}" name="ubicacion" required>
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
