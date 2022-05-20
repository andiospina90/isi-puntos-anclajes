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
                        <img alt="Qries" src="https://isiseguridadindustrial.com/wp-content/uploads/2017/04/png.jpg"  style="max-width: 5em;">
                    </a>
                    @else
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img alt="Qries" src="https://isiseguridadindustrial.com/wp-content/uploads/2017/04/png.jpg" style="max-width: 5em;">
                    </a>
                    @endif

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        @if (Auth::check())
                            <div class="row" style="display: flex; justify-content: space-around; width: 100%; padding-left: 5%; padding-right: 5%">
                                <div class="col-xs-12 col-md-4 ml-1"><a href="{{ url('/registrarPuntoAnclaje') }}" style="text-decoration: none; color: orangered; font-weight: 700">Registrar Precinto</a></div>
                                <div class="col-xs-12 col-md-4"><a href="{{ url('/registrarEmpresa') }}" style="text-decoration: none; color: orangered; font-weight: 700">Registrar Empresa</a></div>
                                <div class="col-xs-12 col-md-4" ><a href="{{ url('/home') }}" style="text-decoration: none; color: orangered; font-weight: 700">Consultar Sistemas de ingeniería</a></div>



                            </div>
                        @endif

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                            </li>
                            @endif

                            <!-- @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif -->
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" style="font-size: 18px;" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>

            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js" crossorigin="anonymous"></script>

        @yield('scripts')

    </div>
</body>

</html>
