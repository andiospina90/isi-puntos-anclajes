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
                                        <div class="col-md-6">
                                            <input id="puntoAnclaje" type="text" class="form-control"  name="puntoAnclaje" required autocomplete="current-puntoAnclaje">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Consultar') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12">
                                @php
                                   // var_dump($pageWasRefreshed);
                                @endphp
                                @if ($puntoAnclaje != null)

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
