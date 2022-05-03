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
                                <form  method="POST" action="{{ route('insertarPuntoAnclaje')}}" >
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Empresa</label>
                                        <select class="form-control form-select" id="id_empresa" name="id_empresa" required>
                                            <option value="" disabled selected>Selecciona una opción</option>
                                            @if ($empresas != 'undefined')
                                                @foreach ($empresas as $empresa)
                                                    <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Sistema protección</label>
                                        <select class="form-control form-select" id="sistema_proteccion"
                                            name="sistema_proteccion" required>
                                            <option value="0">Punto de anclaje</option>
                                            <option value="1">Línea de vida vertical</option>
                                            <option value="2">Línea de vida horizontal</option>
                                            <option value="3">Escalera</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Serial</label>
                                        <input type="text" class="form-control " id="" aria-describedby=""
                                            value="{{ $serial }}" name="serial" required>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Precinto</label>
                                        <input type="number" class="form-control" id="" aria-describedby=""
                                            name="precinto" required>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Fecha de
                                            instalación</label>
                                        <input type="date" class="form-control" id="" aria-describedby=""
                                            name="fecha_instalacion" required>
                                    </div>
                                    {{-- <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Fecha de inspección</label>
                                        <input type="date" class="form-control" id="" aria-describedby="" name="fecha_inspeccion	">
                                    </div> --}}
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Marca</label>
                                        <input type="text" class="form-control" id="" aria-describedby="" name="marca" required>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Número de
                                            usuarioas</label>
                                        <select class="form-control form-select" id="sistema_proteccion"
                                            name="numero_usuarios" required>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Uso</label>
                                        <select class="form-control form-select" id="sistema_proteccion" name="uso"
                                            required>
                                            <option value="restriccion">Restricción</option>
                                            <option value="posicionamiento">Posicionamiento</option>
                                            <option value="detencion">Petención</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Observaciones</label>
                                        <input type="text" class="form-control" id="" aria-describedby=""
                                            name="observaciones" required>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="exampleInputPassword1" class="form-label">Ubicación</label>
                                        <input type="text" class="form-control" id="" aria-describedby=""
                                            name="ubicacion" required>
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
