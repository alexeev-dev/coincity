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

    @stack('styles-header')

    <title>{{ config('app.name', 'Coincity') }}</title>
</head>

<body>
<!--[if lt IE 10]>
<p class="browsehappy">Вы используете <strong>УСТАРЕВШИЙ Internet Explorer</strong> браузер. Пожалуйста, <a
        href="http://browsehappy.com/">обновите ваш Браузер</a> чтобы увидеть больше возможностей на сайтах!</p>
<![endif]-->

<div class="preloader"></div>

<div class="app">
    <header class="wr-header">
        <div class="container">

            <div class="header">
                <div class="settings">
                    <a href="#" class="js-settings"></a>
                    <div>
                        <p>Settings</p>
                        <ul>
                            <li>
                                <a href="#about">About</a>
                            </li>
                            <li>
                                <a href="#rules">Rules</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="coins">
                    <div class="current">
                        <img src="{{ asset('img/header/coin_header.png') }}">
                        <p class="js-total-money">0</p>
                    </div>

                    <div class="for-day">
                        <img src="{{ asset('img/header/h_i_button_upg_timecoins_icon.svg') }}">
                        <p class="js-tmph">0</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="wr-houses">
        <a href="#" class="scroll-button left js-scrollHouses disabled"><img src="{{ asset('img/icons/scroll_arrow.svg') }}"></a>
        <a href="#" class="scroll-button right js-scrollHouses disabled"><img src="{{ asset('img/icons/scroll_arrow.svg') }}"></a>
        <div class="scrollbar" style="height:100%">
            <div class="parallax-mountain">
                <img src="{{ asset('img/backgrounds/mountain.svg') }}">
            </div>
            <div class="parallax-lake">
                <img src="{{ asset('img/backgrounds/lake.svg') }}">
            </div>
            <div class="houses drop" id="left-lovehandles">
            </div>
        </div>
    </section>

    @yield('content')

</div>

@yield('tmp-popup')

@stack('popups')

@stack('scripts-footer')

</body>
</html>