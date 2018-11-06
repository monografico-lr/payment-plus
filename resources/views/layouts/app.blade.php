<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{ asset('css/chunk-vendors.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel=icon href=/favicon.ico> <title>frontend</title>
    <meta charset=utf-8>
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <meta name=viewport content="width=device-width,initial-scale=1">
    <link href=/js/about.js rel=prefetch>
    <link href=/js/chunk-vendors.js rel=preload as=script>

    <style>

    </style>
</head>
<body>
    <div id="app-server">

        <div class="loader"><span class="load"></span></div>
        @guest

        @else
            <!-- <header class="loading">
                <div class="header-low">
                    <div class="brand">
                    <a href="#" @click.prevent="toggleMenu">
                        <i class="material-icons brand__menu">menu</i>
                    </a>
                    <a href="{{ url('/') }}" class="hidden-xs">
                        <h3>{{ config('app.name', 'Payment-Plus') }}</h3>
                    </a>
                    </div>

                    <nav class="top-nav">
                    <li class="navButton hidden-xs"><a href="/"> Dashboard </a></li>
                    <li class="navButton hidden-xs"><a href="/clientes">Clientes</a></li>
                    <li class="navButton hidden-xs"><a href="/servicios">Servicios</a></li>
                    <li class="navButton hidden-xs"><a href="/contratos">Contratos</a>
                        <ul class="submenu">
                        <li class="navButton hidden-xs"><a href="/extras">Extras</a></li>
                        </ul>
                    </li>

                    {{--  @if ($user.type == 0)  --}}
                        <li class="navButton hidden-xs"><a href="/secciones">Secciones</a></li>
                        <li class="navButton hidden-xs"><a href="/reportes">Reportes</a></li>
                    {{--  @endif  --}}
                    </nav>

                    <div class="user-div ">
                    <nav class="user-controls">
                        <li class="navButton">
                        <a href="#" data-toggle="modal" data-target="#app-petty-cash-modal" title="Caja Chica" @click.prevent="openPettyCash('retire')">
                        <i class="material-icons">inbox</i>
                        </a></li>
                        <li class="navButton">
                        <a href="" data-toggle="modal" data-target="#app-ticket-modal" data-placement="bottom" title="Averias">
                        <i class="material-icons">assignment</i>
                        </a></li>
                        <li class="navButton">
                        <a href="" data-toggle="modal" data-target="#app-message-modal" data-placement="bottom" title="Mensajes">
                        <i class="material-icons">perm_phone_msg</i>
                        </a></li>
                        <li class="navButton dropdown mymenu">
                            <a href="{{ url('app/admin/averias') }}" id="dropdown-notification" title="notificaciones" class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="material-icons">notifications</i>
                            </a>
                            {{--  @if ($notifications > 0) %}  --}}
                            {{--  <span class="badge">{{notifications}}</span>  --}}
                            {{--  @endif  --}}
                        {{--  {{ include('layouts/dropdown_notification.twig') }}  --}}
                        </li>
                    </nav>
                    {{--  <div class="dropdown mymenu">
                        <a id="dLabel" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="user-name hidden-xs">{{user.name}}</span>
                        <div class="profile-picture">
                            <span>{{ user.name[:1] }}{{ user.lastname[:1] }}</span>
                        </div>
                        <span class="caret"></span>
                        </a>
                    {{--  {{ include('layouts/dropdown_user.twig') }}
                    </div>  --}}
                    </div>

                </div>
            </header> -->
        @endguest
        @yield('content')
    </div>
    <script src=/js/chunk-vendors.js> </script>
     <!-- Scripts -->
     <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
