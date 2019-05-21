<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <meta name="Description" content="">
    <meta name="Rating" content="">
    <meta name="Author" content="">
    <meta name="Robots" content="index,follow">

    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta property="og:url" content=""/>
    <meta property="og:type" content=""/>
    <meta property="og:title" content="Title"/>
    <meta property="og:description" content="Description"/>
    <meta property="og:image" content=""/>
    <link rel="image_src" href="">

    <link href="{{ compile_assets('css/app.css') }}" rel="stylesheet">
    <link href="{{ compile_assets('css/dragula.min.css') }}" rel="stylesheet">
    <link href="{{ compile_assets('css/jquery.scrollbar.css') }}" rel="stylesheet">

    @stack('styles-header')

    <style>
        .header .news div > ul > li {
            background: #f2f2f2;
        }
        .header .news div > ul > li section p {
            color:#777;
        }
        .house-info > ul > li section p {
            color: #777;
            font-size: 24px;
            line-height: 28px;
            font-family: robotocondensed-regular, sans-serif;
        }
    </style>

    <title>{{ config('app.name', 'Cryptodales') }}</title>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-129496431-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-129496431-1');
    </script>
</head>

<body>
<!--[if lt IE 10]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser.
 Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="preloader"></div>

<div class="app @guest {{ !$errors->any() ? ' tutorial' : '' }} @endguest">
    <header class="wr-header">
        <div class="container">

            <div class="header">
                <div class="settings">
                    <a href="#" class="js-settings"></a>
                    <div>
                        <p>Settings</p>
                        <ul>
                            @auth
                                <li>
                                    <input maxlength="16" class="js-name" type="text" placeholder="Your name"
                                           value="{{ Auth::user()->name }}">
                                </li>
                                <li>
                                    <a href=""
                                       class="sound js-sound">Sound: {{ Auth::user()->user_stat->sound_text }}</a>
                                </li>
                            @endauth
                            <li>
                                <a href="" class="js-advertising">Advertising</a>
                            </li>
                            <li>
                                <a href="" class="js-feedback">Feedback</a>
                            </li>

                            @auth
                                <li>
                                    <a href="" class="js-stats">Statistics</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" class="log-out">Log Out</a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>

                <div class="coins">
                    <div class="current">
                        <img src="{{ asset('img/header/coin_header.png') }}">

                        @auth
                            <p class="js-total-money odometer" id="odometer">{{ Auth::user()->user_stat->money }}</p>
                        @endauth

                        @guest
                            <p class="js-total-money">0</p>
                        @endguest
                    </div>

                    <div class="for-day">
                        <img src="{{ asset('img/header/h_i_button_upg_timecoins_icon.svg') }}">

                        @auth
                            <p class="js-tmph">{{ Auth::user()->user_stat->total_money_per_hour }} per hour</p>
                        @endauth

                        @guest
                            <p class="js-tmph">0</p>
                        @endguest
                    </div>

                    @guest
                        <div class="log-reg">
                            <ul>
                                <li>
                                    <a href="#" class="login">Log In</a>
                                </li>
                                <li>
                                    <a href="#" class="register">Register</a>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>

                @yield('news')

            </div>
        </div>
    </header>

    @yield('content')

</div>

<div class="popup{{ $errors->any() ? ' active' : '' }}">
    @stack('popups')

    @include('partials.popups.static_popups')
</div>

@if (!empty($newTweetCount))
    <div class="news-alert"></div>
@endif

<script src="{{ compile_assets('js/app.js') }}"></script>

@guest
    <script src="{{ compile_assets('js/guest.js') }}"></script>
@endguest

@auth
    <script src="{{ compile_assets('js/app2.js') }}"></script>
@endauth

<script src="{{ compile_assets('js/odometer.min.js') }}"></script>

@stack('scripts-footer')

</body>
</html>