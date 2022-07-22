<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="d-flex justify-content-around" style="width: 100%">
                    @if (Auth::check())
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            <img alt="Qries"
                                src="https://isiseguridadindustrial.com/wp-content/uploads/2017/04/png.jpg"style="max-width: 5em;">
                        </a>
                        <div class="row" style="display: flex; justify-content: space-around; width: 100%; padding-left: 5%; padding-right: 5%">
                            <Button class="btn btn-primary col-xs-12 col-md-2 mb-2" style="background-color: orangered; border-color: orangered"><a href="{{ url('/registrarPuntoAnclaje') }}"
                                    style="text-decoration: none; color: white; font-weight: 500">Registrar
                                    Precinto</a></Button>
                            <Button class="btn btn-primary col-xs-12 col-md-2 mb-2" style="background-color: orangered; border-color: orangered"><a href="{{ url('/registrarEmpresa') }}"
                                    style="text-decoration: none; color: white; font-weight: 500">Registrar
                                    Empresa</a></Button>
                            <Button class="btn btn-primary col-xs-12 col-md-2 mb-2" style="background-color: orangered; border-color: orangered"><a href="{{ url('/home') }}"
                                    style="text-decoration: none; color: white; font-weight: 500">Consultar Sistemas
                                    de ingeniería</a></Button>
                                    <Button class="btn btn-primary col-xs-12 col-md-2 mb-2" style="background-color: orangered; border-color: orangered">
                            <a class="" style="text-decoration: none; color: white; font-weight: 500" href="{{ route('logout') }} "
                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Cerrar Sesion') }}
                            </a>
                            </Button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    @else
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img alt="Qries"
                                src="https://isiseguridadindustrial.com/wp-content/uploads/2017/04/png.jpg"
                                style="max-width: 5em;">
                        </a>
                        <Button class="btn btn-primary" style="background-color: orangered; border-color: orangered"><a
                                class="nav-link" href="{{ route('login') }}"
                                style="color:white">{{ __('Iniciar sesión') }}</a></Button>
                    @endif
                </div>

            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js" crossorigin="anonymous">
        </script>

        @yield('scripts')

    </div>
</body>

</html>
