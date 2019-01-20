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
    <link href="{{ compile_assets('css/admin.css') }}" rel="stylesheet">

    @stack('styles-header')

    <title>{{ config('app.name', 'Cryptodales admin') }}</title>
</head>

<body style="font-size:13px">

<div class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
    <div class="container">
        <a href="{{ route('admin_dashboard') }}" class="navbar-brand">Cryptodales Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-navbar"
                aria-controls="bs-navbar" aria-expanded="false" aria-label="">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="bs-navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
            <ul class="nav navbar-nav ml-auto">
                @auth('admin')
                    <li><a class="nav-link" href="{{ route('admin_dashboard') }}">Главная</a></li>
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                           aria-expanded="false">{{ Auth::guard('admin')->user()->email }} <span
                                    class="caret"></span></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin_dashboard') }}">Сводка</a>
                            <a class="dropdown-item" href="{{ route('admin_loader') }}">Загрузчик</a>
                            <a class="dropdown-item" href="{{ route('admin_editor') }}">Редактор</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('admin_logout') }}">Выйти</a>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</div>

<div class="container">
    @if ( session('message')  )
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <span class="fa fa-check-circle"></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label=""><span aria-hidden="true">&times;</span>
                    </button>
                    {!! session('message') !!}
                </div>
            </div>
        </div>
    @endif

    @if (session('success-message'))
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <span class="fa fa-check-circle"></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label=""><span aria-hidden="true">&times;</span>
                    </button>
                    {!! session('success-message') !!}
                </div>
            </div>
        </div>
    @endif

    @yield('content')

</div>

<div class="modal" id="confirmation">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Подтвердите удаление</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <button data-dismiss="modal" class="btn btn-info btn-popup-close">Отменить</button>
                <a class="js-delete btn btn-primary" href="">Удалить</a>
            </div>
        </div>
    </div>
</div>

<script src="{{ compile_assets('js/admin.js') }}"></script>
@stack('scripts-footer')

</body>
</html>
