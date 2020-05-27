<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'WordTraining') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" ></script>
        <script src="{{ asset('js/jquery-3.3.1.js') }}" ></script>
        <script src="{{ asset('js/jquery.textareaAutoResize.js') }}" ></script>


        <link rel="shortcut icon" href="{{ asset('img/logo_page.png') }}" type="image/png">
        
        <!-- Fonts 
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        -->
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/word-training.css') }}" rel="stylesheet">
        <link href="{{ asset('css/sticky-footer.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">

            <nav class="navbar navbar-expand-lg navbar-light  " style="background-color: #4ebdad;">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="{{ route('quiz.start') }}"><img src="{{ URL::to('/img/logo_sm.png') }}" ></a>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
<!--                        
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('home') }}" style="color: rgb(255,255,255)">Home <span class="sr-only">(current)</span></a>
                        </li>
-->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('translation.show') }}" style="color: rgb(255,255,255)">Vocabulary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('translation.import') }}" style="color: rgb(255,255,255)">Import</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('quiz.show_all') }}" style="color: rgb(255,255,255)">Quiz</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"   style="position:relative; padding-left:50px;">

                                <img src="/img/avatars/{{ Auth::user()->avatar }}" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%">
                                {{ Auth::user()->name }} <span class="caret"></span>
    
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    Profile
                                </a>
                                
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>

                </div>
            </nav>


            <main class="py-4">
                @yield('content')   
            </main>
        </div>

        <br>
        <footer class="footer mt-10">
            <div class="container">
                <h5 class="text-muted mt-2">Word training</h5>

                <ul class="list-unstyled">
                    <li>
                        <span class="text-muted">Email: Denis.grin1618@gmail.com</span>
                    </li>
                    <li>
                        <span class="text-muted">Phone: +38(093)909-22-45</span>
                    </li>
                </ul>

            </div>
        </footer>

    </body>
</html>
