<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
    <meta name="description" content="Test your knowledge speed" />
    <meta name="keywords" content="quiz, question, article, general knowledge" /> 
    <meta name="author" content="FastQuiz" /> 
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta property="fb:app_id"        content="{{ config('services.facebook.client_id') }}" />
    <meta property="og:url"           content="{{ url('/') }}" />
    <meta property="og:site_name"     content="FastQuiz" />
    <meta property="og:type"          content="article" />
    <meta property="og:title"         content="FastQuiz - @lang('home.motto')" />
    <meta property="og:description"   content="FastQuiz - @lang('home.fast')" />
    <meta property="og:image"         content="{{ url('images/logo.png') }}" />

    <title>@yield('title')</title> 

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto" /> -->

    <link rel="stylesheet" type="text/css" href="{{ cached_asset('css/app.css') }}" />
    
    <!--[if lt IE 9]> <script src="js/html5shiv.js"></script> 
    <script src="js/respond.min.js"></script> <![endif]--> 
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head><!--/head-->
<body>
    @include('vendor.analytics')
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

                @if (Auth::check() && Auth::user()->isAdmin())
                <h2 style="float:left;">ADMIN ZONE</h2>
                @else
                <div class="navbar-header"> 
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> 
                    </button> 
                    <a class="navbar-brand" href="/"><h1><img width="200" src="/images/logo.png" alt="logo"></h1></a> 
                </div> 
                @endif 

                <div class="collapse navbar-collapse menu-navbar">

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

    @stack('scripts')

</body>
</html>