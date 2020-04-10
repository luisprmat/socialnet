<!doctype html>
<html lang="es">
    <head>
        <title>Social App</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="user" content="{{ Auth::user() }}">

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-sm navbar-light navbar-socialapp shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <i class="fas fa-address-book fa-fw text-primary mr-1"></i>
                        Social App
                    </a>
                    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavId">
                        <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                            {{-- <li class="nav-item active">
                                <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Link</a>
                            </li> --}}
                        </ul>

                        <ul class="navbar-nav ml-auto">
                            @guest
                                <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">{{ __('Login') }}</a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                                        <a class="dropdown-item" href="#">Action 1</a>
                                        <a class="dropdown-item" href="#">Action 2</a>
                                        <div class="dropdown-divider"></div>
                                        <a onclick="document.getElementById('logout').submit()" class="dropdown-item" href="#">{{ __('Logout') }}</a>
                                    </div>
                                    <form id="logout" action="{{ route('logout') }}" method="POST">@csrf</form>
                                </li>
                            @endguest
                        </ul>

                    </div>
                </div>

            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
