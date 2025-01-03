<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('app.css');}}">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                
                <!-- LOGO -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                    <img width="30px" height="30px" src="{{ asset('logo2.png') }}" alt="Logo" class="logo"> 
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
                        @guest
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
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Hello, {{ Auth::user()->name }} {{ Auth::user()->surname }}!
                                </a>



                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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

                            <!-- Settings icon /app/model/user -> IsAdmin -->
                            @if (auth()->check() && auth()->user()->isAdmin())
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/users">
                                            {{ __('User list') }}
                                        </a>
                                    
                                        <a class="dropdown-item" href="/productList">
                                            {{ __('Product list') }}
                                        </a>

                                        <a class="dropdown-item" href="/orders">
                                            {{ __('Orders') }}
                                        </a>
                                    </div>

                                </li>
                            @endif

                            <!-- Basked icon for authenticated users -->
                            @if (auth()->check())

                                <li class="nav-item">

                                    <a href="{{ route('cart.view') }}" class="cart-icon">
                                        <i class="fa fa-shopping-cart"></i>
                                        @if(isset($cartItemCount) && $cartItemCount > 0)
                                            <span class="cart-count">{{ $cartItemCount }}</span>
                                        @endif
                                    </a>  

                                </li>
                            @endif
                        
                            
                        @endguest
                        
                    </ul>
                </div>
            </div>
        </nav>

        @if (session('error'))
            <div class="d-flex align-items-center justify-content-center" style="color: red; font-size:30px;">
                {{ session('error') }}
            </div>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
        
    </div>
    @include('layouts.footer')
</body>
</html>
