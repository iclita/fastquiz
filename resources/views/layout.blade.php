<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta name="description" content="Creative One Page Parallax Template">
    <meta name="keywords" content="Creative, Onepage, Parallax, HTML5, Bootstrap, Popular, custom, personal, portfolio" /> 
    <meta name="author" content=""> 
    <title>@yield('title')</title> 

    <!-- GOOGLE FONTS -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto" />

    <link rel="stylesheet" type="text/css" href="{{ cached_asset('css/app.css') }}" />
    
    <!--[if lt IE 9]> <script src="js/html5shiv.js"></script> 
    <script src="js/respond.min.js"></script> <![endif]--> 
    
    <link rel="shortcut icon" href="images/ico/favicon.png"> 
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png"> 
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png"> 
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png"> 
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body>
    <div class="preloader">
        <div class="preloder-wrap">
            <div class="preloder-inner"> 
                <div class="ball"></div> 
                <div class="ball"></div> 
                <div class="ball"></div> 
                <div class="ball"></div> 
                <div class="ball"></div> 
                <div class="ball"></div> 
                <div class="ball"></div>
            </div>
        </div>
    </div><!--/.preloader-->
    <header id="navigation"> 
        <div class="navbar navbar-inverse navbar-fixed-top" role="banner"> 
            <div class="container"> 
                <div class="navbar-header"> 
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> 
                    </button> 
                    <a class="navbar-brand" href="/"><h1><img src="/images/logo.png" alt="logo"></h1></a> 
                </div> 
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right"> 
                        @if (Request::is('/'))
                        <li class="scroll active menu-scroll">
                            <a class="material-box btn-menu-space" href="#navigation">
                                <i class="fa fa-home" aria-hidden="true">&nbsp;</i>@lang('home.menu.home')
                            </a>
                        </li> 
                        <li class="scroll menu-scroll">
                            <a class="material-box btn-menu-space" href="#services">
                                <i class="fa fa-cog" aria-hidden="true"></i>&nbsp;@lang('home.menu.how_it_works')
                            </a>
                        </li> 
                        <li class="scroll menu-scroll">
                            <a class="material-box btn-menu-space" href="#blog">
                                <i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp;@lang('home.menu.brain_food')
                            </a>
                        </li>
                        <li class="scroll lang-scroll"> 
                            <div class="dropdown profile">
                                <a class="logout material-box" id="lang-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;@lang('home.menu.language')<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu material-box lang-menu" aria-labelledby="lang-dropdown">
                                    <li class="scroll">
                                        <a class="logout" href="{{ route('change-language') }}?lang=en&url={{ Request::fullUrl() }}">
                                            <span class="flag-icon flag-icon-gb"></span>&nbsp;@lang('home.menu.en')
                                        </a>
                                    </li>
                                    <li class="scroll">
                                        <a class="logout" href="{{ route('change-language') }}?lang=de&url={{ Request::fullUrl() }}">
                                            <span class="flag-icon flag-icon-de"></span>&nbsp;@lang('home.menu.de')
                                        </a>
                                    </li>
                                    <li class="scroll">
                                        <a class="logout" href="{{ route('change-language') }}?lang=ro&url={{ Request::fullUrl() }}">
                                            <span class="flag-icon flag-icon-ro"></span>&nbsp;@lang('home.menu.ro')
                                        </a>
                                    </li>
                                </ul>
                            </div>
                         </li>
                        @endif
                        @if (Auth::check())
                        <li class="scroll profile-scroll">
                            @if (Auth::user()->isAdmin())
                            @include('partials.admin_dropdown_menu')
                            @else
                            @include('partials.user_dropdown_menu')
                            @endif 
                        </li>
                        @endif 
                    </ul> 
                </div> 
            </div> 
        </div><!--/navbar--> 
    </header> <!--/#navigation--> 

    @yield('content')

    @include('partials.flash')

    @yield('footer')

    @yield('modal')

    <script type="text/javascript" src="{{ cached_asset('js/app.js') }}"></script> 

</body>
</html>