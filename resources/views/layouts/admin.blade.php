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

    <link href="{{ compile_assets('css/bootstrap.min.css') }}" rel="stylesheet">

    @stack('styles-header')

    <title>{{ config('app.name', 'Coincity') }}</title>
</head>

<body>

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
