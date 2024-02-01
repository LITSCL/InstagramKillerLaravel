<?php const TIME_UPDATE_CSS = "22:39"?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css?' . TIME_UPDATE_CSS) }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css?9:36' . TIME_UPDATE_CSS) }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    InstagramKillerLaravel
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest <!-- Esto se muestra cuando no estamos logeados. -->
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else <!-- Esto se muestra cuando si estamos logeados. -->
                            <li class="nav-item">
                            	<a class="nav-link" href="{{ route('home') }}">Inicio</a> 	
                            </li>
                            
                           	<li class="nav-item">
                            	<a class="nav-link" href="{{ route('usuario.vista.usuarios') }}">Gente</a>
                            </li>
                            
                            <li class="nav-item">
                            	<a class="nav-link" href="{{ route('like.vista.favoritos') }}">Favoritos</a>
                            </li>
                            
                            <li class="nav-item">
                            	<a class="nav-link" href="{{ route('imagen.vista.subir') }}">Subir imagen</a>
                            </li>
                            
                            <li>
								<div class="contenedor-avatar-header">
    								@include('includes.avatar')
    							</div>
							</li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nombre }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('usuario.vista.perfil', ['id' => Auth::user()->id]) }}">
										Mi perfil
                                    </a>
                                    
                                    <a class="dropdown-item" href="{{ route('usuario.vista.configuracion') }}">
										Configuración
                                    </a>
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
        </nav>

        <main class="py-4">
            @yield('contenido')
        </main>
    </div>
</body>
</html>
