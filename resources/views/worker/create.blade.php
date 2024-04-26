@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center ">
            <div class="">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ __('Registrar instalador') }}</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" action="{{ route('worker.store') }}">
                                    @csrf
                                    <div class="mb-3 col-md-12">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                            id="nombre" aria-describedby="" name="nombre"
                                            onkeyup="this.value = this.value.toUpperCase();">
                                        @error('nombre')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="exampleInputPassword1" class="form-label">Telefono<span style="font-size:small;color:gray">(opcional)</span></label>
                                        <input type="text" class="form-control @error('sede') is-invalid @enderror"
                                            id="" aria-describedby="" name="sede"
                                            onkeyup="this.value = this.value.toUpperCase();">
                                        @error('sede')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
