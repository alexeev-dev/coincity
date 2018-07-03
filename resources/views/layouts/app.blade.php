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

	<link href="{{ compile_assets('css/app.css') }}" rel="stylesheet">
	<link href="{{ compile_assets('css/main.css') }}" rel="stylesheet">
	<link href="{{ compile_assets('css/print.css') }}" rel="stylesheet" media="print">
	@stack('styles-header')
	
	<title>{{ config('app.name', 'Coincity') }}</title>
</head>
<body>
	<!--[if lt IE 10]>
	<p class="browsehappy">Вы используете <strong>УСТАРЕВШИЙ Internet Explorer</strong> браузер. Пожалуйста, <a href="http://browsehappy.com/">обновите ваш Браузер</a> чтобы увидеть больше возможностей на сайтах!</p>
	<![endif]-->

	<!-- Preloader  -->
	<div class="preloader"></div>

	<!-- Application -->
	<div class="app">

		<header class="wr-header">
			<div class="container">
		
				<div class="header">
					<div class="settings">
						<a href="#" class="js-settings"></a>
						<div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
							<p>Settings</p>
							<ul>
								@auth
								<li>
									<input type="text" placeholder="Your name" value="{{ Auth::user()->name }}">
								</li>
                                @endauth
								<li>
									<a href="#" class="sound">Sound:on</a>
								</li>
								<li>
									<a href="#">About</a>
								</li>
								<li>
									<a href="#">Rules</a>
								</li>
                                @auth
								<li>
									<a href="{{ route('logout') }}" class="log-out"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log Out</a>
								</li>
                                @endauth
							</ul>
						</div>
					</div>
					<div class="coins">
						<div class="current">
							<img src="{{ asset('img/header/coin_header.png') }}">
							<p>000.000.000.000</p>
						</div>
						<div class="for-day">
							<img src="{{ asset('img/header/h_i_button_upg_timecoins_icon.svg') }}">
							<p>0 for day</p>
						</div>

                        @guest
						<div class="log-reg">
							<ul>
								<li>
									<a href="{{ route('login') }}" class="login">Log In</a>
								</li>
								<li>
									<a href="{{ route('register') }}" class="register">Register</a>
								</li>
							</ul>
						</div>
                        @endguest

					</div>
					<div class="news">
						<a href="#" class="js-news"><span>99</span></a>
						<div>
							<p>News<span>99</span></p>
							<ul>

							</ul>
						</div>
					</div>
				</div>
				
			</div>
		</header>

		@if ( session('message')  )
			<div class="alert alert-warning alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
				<p><strong>Предупреждение!</strong></p>
				<p>{!! session('message') !!}</p>
			</div>
		@endif

		@yield('content')

	</div>

    @yield('tmp-popup')

    <script src="{{ compile_assets('js/app.js') }}"></script>

    @stack('scripts-footer')
</body>
</html>