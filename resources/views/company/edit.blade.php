@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center ">
            <div class="">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ __('Registrar Empresa') }}</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" action="{{ route('company.update',$empresa->id) }}">
                                    @csrf
                                     @method('PUT')
                                    <div class="mb-3 col-md-12">
                                        <label for="nombre" class="form-label">Razon social</label>
                                        <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                            id="nombre" aria-describedby="" name="nombre"
                                            onkeyup="this.value = this.value.toUpperCase();" value="{{$empresa->nombre}}">
                                        @error('nombre')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="exampleInputPassword1" class="form-label">Sede</label>
                                        <input type="text" class="form-control @error('sede') is-invalid @enderror"
                                            id="" aria-describedby="" name="sede" 
                                            onkeyup="this.value = this.value.toUpperCase();" value="{{$empresa->sede}}">
                                        @error('sede')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="exampleInputPassword1" class="form-label">Ciudad</label>
                                        <input type="text" class="form-control @error('ciudad') is-invalid @enderror"
                                            id="" aria-describedby="" name="ciudad"
                                            onkeyup="this.value = this.value.toUpperCase();" value="{{$empresa->ciudad}}">
                                        @error('ciudad')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="exampleInputPassword1" class="form-label">NIT</label>
                                        <input type="text" class="form-control @error('nit') is-invalid @enderror"
                                            id="" aria-describedby="" name="nit" value="{{$empresa->nit}}">
                                        @error('nit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="exampleInputPassword1" class="form-label">Nombre contacto</label>
                                        <input type="text"
                                            class="form-control @error('nombre_contacto_empresa') is-invalid @enderror"
                                            id="" aria-describedby="" name="nombre_contacto_empresa" value="{{$empresa->nombre_contacto_empresa}}">
                                        @error('nombre_contacto_empresa')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="exampleInputPassword1" class="form-label">Telefono contacto</label>
                                        <input type="text" class="form-control @error('telefono_contacto_empresa') is-invalid @enderror" id="" aria-describedby=""
                                            name="telefono_contacto_empresa" value="{{$empresa->telefono_contacto_empresa}}">
                                        @error('telefono_contacto_empresa')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="exampleInputPassword1" class="form-label">Correo contacto</label>
                                        <input type="email" class="form-control @error('email_contacto_empresa') is-invalid @enderror" id="" aria-describedby=""
                                            name="email_contacto_empresa" value="{{$empresa->email_contacto_empresa}}">
                                            @error('email_contacto_empresa')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="exampleInputPassword1" class="form-label">Nombre segundo contacto <span
                                                style="font-size:small;color:gray">(opcional)</span></label>
                                        <input type="text" class="form-control" id="" aria-describedby=""
                                            name="nombre_contacto_empresa_2" value="{{$empresa->nombre_contacto_empresa_2}}">
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="exampleInputPassword1" class="form-label">Telefono segundo contacto
                                            <span style="font-size:small;color:gray">(opcional)</span></label>
                                        <input type="text" class="form-control" id="" aria-describedby=""
                                            name="telefono_contacto_empresa_2" value="{{$empresa->telefono_contacto_empresa_2}}">
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="exampleInputPassword1" class="form-label">Correo segundo contacto
                                            <span style="font-size:small;color:gray">(opcional)</span></label>
                                        <input type="email" class="form-control" id="" aria-describedby=""
                                            name="email_contacto_empresa_2" value="{{$empresa->email_contacto_empresa_2}}">
                                    </div>
                                    <div class="mb-3 ">
                                        <button type="submit" class="btn btn-primary"
                                            style="background-color: orangered; border-color: orangered">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script src='{{ asset('js/app/empresa.js') }}'></script>
    @endsection
