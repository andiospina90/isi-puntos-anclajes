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
                        <div class="row pb-4 d-flex flex-row-reverse mb-2">
                            <div class="col-md-2  mb-2">
                                    <a class="btn btn-primary ml-1" href="{{ url('/exportar') }}"
                                        role="button" style="background-color: orangered; border-color: orangered">Descargar en excel</a>
                            </div>
                            <div class="col-md-2 ">

                                    <a class="btn btn-primary ml-1" href="{{ url('/registrarPuntoAnclaje') }}"
                                        role="button" style="background-color: orangered; border-color: orangered">Registrar Precinto</a>
                            </div>
                        </div>
                        <table class="table " id="puntosAnclajeTabla" style="width:100%">
                            <thead>
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
    <script src='{{ asset('js/app/homePage.js') }}'></script>
@endsection
