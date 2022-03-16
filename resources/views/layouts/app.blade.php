<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Teste</title>
    

    <link rel="icon" href="{{asset('assets/img/logo_prefeitura.ico')}}" type="image/x-icon" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/form_cadastro.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('assets/css/sidebar.css')}}">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md">
            <div class="img">
                <a href="#">
                    <img src="{{asset('assets/img/logo_prefeitura.png')}}" alt="Logo Prefeitura" class="img-navbar">
                </a>
            </div>

            <div class="span">
                <span>Painel Coronavírus</span>
            </div>

        </nav>
    </header>
    <main class="main">
        @yield('content')
    </main>

    <footer>
        <div>
            <ul>
                <li>{{ date('Y') }} &copy; Setor de1 Desenvolvimento - Prefeitura</li>
            </ul>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
            integrity="sha256-Kg2zTcFO9LXOc7IwcBx1YeUBJmekycsnTsq2RuFHSZU=" crossorigin="anonymous"></script>
    </footer>
</body>

</html>
