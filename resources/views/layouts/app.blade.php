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
	<link href="{{ compile_assets('css/dragula.min.css') }}" rel="stylesheet">
	<link href="{{ compile_assets('css/jquery.scrollbar.css') }}" rel="stylesheet">

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
									<input class="js-name" type="text" placeholder="Your name" value="{{ Auth::user()->name }}">
								</li>
								<li>
									<a href="" class="sound js-sound">Sound: {{ Auth::user()->user_stat->sound_text }}</a>
								</li>
								@endauth
								<li>
									<a href="#about">About</a>
								</li>
								<li>
									<a href="#rules">Rules</a>
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

							@auth
							<p class="js-total-money">{{ Auth::user()->user_stat->money_text }}</p>
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
									<a href="{{ route('login') }}" class="login">Log In</a>
								</li>
								<li>
									<a href="{{ route('register') }}" class="register">Register</a>
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

    @yield('tmp-popup')

    @stack('popups')

    <script src="{{ compile_assets('js/app.js') }}"></script>
    <script src="{{ compile_assets('js/app2.js') }}"></script>

    @stack('scripts-footer')

</body>
</html>