<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Word training') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" ></script>
        <script src="{{ asset('js/jquery-3.3.1.js') }}" ></script>
        <script src="{{ asset('js/jquery.textareaAutoResize.js') }}" ></script>


        <link rel="shortcut icon" href="{{ asset('/img/logo_page.png') }}" type="image/png">

        <!-- Fonts 
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        -->
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/word-training.css') }}" rel="stylesheet">
        <link href="{{ asset('css/sticky-footer.css') }}" rel="stylesheet">
    </head>
    <body >
        <div id="app">

            <nav class="shadow  navbar navbar-expand-md navbar-light  " style="background: #4ebdad" >
                <button  class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand mt-1" href="{{ route('quiz.start') }}"><img src="{{ URL::to('/img/logo_sm.png') }}" ></a>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    
                    
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

                        <li class="nav-item li-local d-none invisible">

                            <div class="input-group mb-3 dropdown-item  m-0 p-0 ">
                                    <div class="input-group-prepend " >
                                        <a class="a-local btn bt-grey-silver-hover border border-secondary {{ Cookie::get('locale') == 'ru' ? 'bt-grey-silver text-white' : '' }} " href="{{ route('locale.setlocale', ['locale' => 'ru']) }}">RU</a>
                                        <a class="a-local btn bt-grey-silver-hover border border-secondary {{ Cookie::get('locale') == 'en' || Cookie::get('locale') == null ? 'bt-grey-silver text-white' : '' }} " href="{{ route('locale.setlocale', ['locale' => 'en']) }}">EN</a>
                                        <a class="a-local btn bt-grey-silver-hover border border-secondary rounded-right {{ Cookie::get('locale') == 'uk' ? 'bt-grey-silver text-white' : '' }} " href="{{ route('locale.setlocale', ['locale' => 'uk']) }}">UK</a>
                                    </div>
                                </div>
                            
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('translation.show') }}"><img class='mr-2 img-icon d-none invisible' src="{{ URL::to('/img/icons/book.svg') }}" width="20" height="20">@lang('app_strings.vocabulary')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('translation.import') }}" ><img class='mr-2 img-icon d-none invisible' src="{{ URL::to('/img/icons/download.svg') }}" width="20" height="20">@lang('app_strings.import')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('quiz.show_all') }}" ><img class='mr-2 img-icon d-none invisible' src="{{ URL::to('/img/icons/clock.svg') }}" width="20" height="20">@lang('app_strings.quiz')</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white" href="{{ route('statistics.show') }}"><img class='mr-2 img-icon d-none invisible' src="{{ URL::to('/img/icons/graph-up.svg') }}" width="20" height="20">@lang('app_strings.statistic')</a>
                        </li>
                    </ul>
                    
                    


                    <ul class="navbar-nav ml-auto">


                        @guest
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"   style="position:relative; padding-left:50px;">
                                <img class="align-middle" src="/img/avatars/{{ Auth::user()->avatar }}" style="width:32px; height:32px; position:absolute; top:3px; left:10px; border-radius:50%">
                                {{ Auth::user()->name }}<span class="caret"></span>

                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    @lang('app_strings.profile')
                                </a>

<!--                                <a class="dropdown-item" href="{{ route('statistics.show') }}">
                                    @lang('app_strings.statistic')
                                </a>-->

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
<!--                                    {{ __('Logout') }}-->
                                    @lang('app_strings.logout')
                                </a>


                                <div class="input-group mb-3 dropdown-item div-local m-0 ">
                                    <div class="input-group-prepend ">
                                        <a class="a-local btn bt-grey-silver-hover border border-secondary {{ Cookie::get('locale') == 'ru' ? 'bt-grey-silver text-white' : '' }} " href="{{ route('locale.setlocale', ['locale' => 'ru']) }}">RU</a>
                                        <a class="a-local btn bt-grey-silver-hover border border-secondary {{ Cookie::get('locale') == 'en' || Cookie::get('locale') == null ? 'bt-grey-silver text-white' : '' }} " href="{{ route('locale.setlocale', ['locale' => 'en']) }}">EN</a>
                                        <a class="a-local btn bt-grey-silver-hover border border-secondary rounded-right {{ Cookie::get('locale') == 'uk' ? 'bt-grey-silver text-white' : '' }} " href="{{ route('locale.setlocale', ['locale' => 'uk']) }}">UK</a>
                                    </div>
                                </div>



                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>

                </div>


            </nav>
            <div class="menu-overlay"></div>


            <main class="py-4">
                @yield('content')   
            </main>
        </div>

        <br>
        <br>
        <br>
        <footer class="footer mt-10">
            <div class="container">
                <h5 class="text-muted mt-2">Word training</h5>

                <ul class="list-unstyled">
                    <li>
                        <span class="text-muted">Denis.grin1618@gmail.com</span>
                    </li>
                    <li>
                        <span class="text-muted"><a class="text-muted" href="https://github.com/denisgrin1618/LARAVEL-Word-training">Github.com/denisgrin1618/LARAVEL-Word-training</a></span>
                    </li>
                </ul>

            </div>
        </footer>


        <script type="text/javascript" defer>
//        
            $('[data-toggle="collapse"]').on('click', function () {
                $navMenuCont = $($(this).data('target'));

                if ($navMenuCont.attr('id') == 'navbarTogglerDemo03') {
                    $navMenuCont.animate({
                        'width': 'toggle'
                    }, 350);
                    $(".menu-overlay").fadeIn(500);

                    $navMenuCont.find('.nav-link')
                            .not('.a-local')
                            .removeClass('text-white')
                            .addClass('text-black');
//                    console.log($navMenuCont.attr('id'));

                    
//                    $('.div-local').addClass('p-0').appendTo(".li-local");
                    $(".li-local").removeClass('d-none invisible');
                    $('.div-local').addClass('d-none invisible');
                    $('.img-icon').removeClass('d-none invisible');
                }


            });
            $(".menu-overlay").click(function (event) {
                $(".navbar-toggler").trigger("click");
                $(".menu-overlay").fadeOut(500);
                $("#navbarTogglerDemo03")
                        .find('.nav-link')
                        .not('.a-local')
                        .removeClass('text-black')
                        .addClass('text-white');
//                $('.div-local').removeClass('p-0').appendTo(".dropdown-menu-right");
                $(".div-local").removeClass('d-none invisible');
                $('.li-local').addClass('d-none invisible');
                $('.img-icon').addClass('d-none invisible');
            });




        </script>


    </body>
</html>
