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

    <link href="{{ compile_assets('css/bootstrap.min.css') }}" rel="stylesheet">

    @stack('styles-header')

    <title>{{ config('app.name', 'Cryptodales') }}</title>
</head>

<body style="font-size:13px">

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Cryptodales') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @auth('admin')
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            {{ Auth::guard('admin')->user()->email }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('admin_dashboard') }}">
                                    Сводка
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin_loader') }}">
                                    Загрузчик
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin_editor') }}">
                                    Редактор
                                </a>
                            </li>
                            <li><a href="{{ route('admin_logout') }}">Выйти</a></li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div id="app" class="main-container" style="padding:30px 0">
    @if ( session('message')  )
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <p><strong>Warning!</strong></p>
            <p>{!! session('message') !!}</p>
        </div>
    @endif

    @if ( session('success-message')  )
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <p><strong>{!! session('success-message') !!}</strong></p>
        </div>
    @endif

    @yield('content')

</div>

<script src="{{ compile_assets('js/admin.js') }}"></script>

@stack('scripts-footer')

</body>
</html>
