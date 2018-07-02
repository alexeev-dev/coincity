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

        <section class="wr-houses">
            @yield('content')

            <div class="scrollbar">
                <div class="houses drop" id="left-lovehandles">
    				<div class="house-item handle">
    					<header>
    						<div class="houses-count">
    							<span>+3.100</span>
    							<img src="{{ asset('img/house-info/coin_30.png') }}">
    						</div>
    						<div class="footer-buttons js-footerButtons">
    							<a href="#" class="info"><img src="{{ asset('img/icons/info_btn.svg') }}"></a>
    							<a href="#" class="featured"><img src="{{ asset('img/icons/featured_btn_disabled.svg') }}"></a>
    						</div>
    					</header>
    					<section>
    						<figure class="footer-image">
    							<img class="handle" src="{{ asset('img/houses/house_1_icon.png') }}">
    						</figure>
    						<figure class="houses-images">
    							<img src="{{ asset('img/houses/house_1_icon.png') }}">
    						</figure>
    						<figure class="draggable">
    							<img src="{{ asset('img/houses/house_1_icon.png') }}">
    						</figure>
    					</section>
    					<footer>
    						<div class="footer-price">
    							<img src="{{ asset('img/icons/cointime_icon.png') }}">
    							<span>3.100</span>
    						</div>
    						<div class="houses-price">
    							<a href="#" class="info"><img src="{{ asset('img/house-info/info_btn.png') }}"></a>
    							<a href="#" class="coins"><img src="{{ asset('img/header/h_i_button_upg_timecoins_icon.svg') }}"><span>3.100</span></a>
    							<span class="replace"><img class="handle" src="{{ asset('img/house-info/remove_btn.png') }}"></span>
    						</div>
    					</footer>
    				</div>
    			</div>
            </div>
        </section>

        <footer class="wr-footer">
        	<div class="container">

        		<div class="footer">
        			<section class="js-footerHouseItems new-active built-active featured-active show" id="right-lovehandles">
        				<div class="house-item handle">
        					<header>
        						<div class="houses-count">
        							<span>+2.500</span>
        							<img src="{{ asset('img/house-info/coin_30.png') }}">
        						</div>
        						<div class="footer-buttons js-footerButtons">
        							<a href="#" class="info"><img src="{{ asset('img/icons/info_btn.svg') }}"></a>
        							<a href="#" class="featured"><img src="{{ asset('img/icons/featured_btn_disabled.svg') }}"></a>
        						</div>
        					</header>
        					<section>
        						<figure class="footer-image">
        							<img class="handle" src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        						<figure class="houses-images">
        							<img src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        						<figure class="draggable">
        							<img src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        					</section>
        					<footer>
        						<div class="footer-price">
        							<img src="{{ asset('img/icons/cointime_icon.png') }}">
        							<span>2.500</span>
        						</div>
        						<div class="houses-price">
        							<a href="#" class="info"><img src="{{ asset('img/house-info/info_btn.png') }}"></a>
        							<a href="#" class="coins"><img src="{{ asset('img/header/h_i_button_upg_timecoins_icon.svg') }}"><span>2.500</span></a>
        							<span class="replace"><img class="handle" src="{{ asset('img/house-info/remove_btn.png') }}"></span>
        						</div>
        					</footer>
        				</div>

        				<div class="house-item handle">
        					<header>
        						<div class="houses-count">
        							<span>+2.600</span>
        							<img src="{{ asset('img/house-info/coin_30.png') }}">
        						</div>
        						<div class="footer-buttons js-footerButtons">
        							<a href="#" class="info"><img src="{{ asset('img/icons/info_btn.svg') }}"></a>
        							<a href="#" class="featured"><img src="{{ asset('img/icons/featured_btn_disabled.svg') }}"></a>
        						</div>
        					</header>
        					<section>
        						<figure class="footer-image">
        							<img class="handle" src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        						<figure class="houses-images">
        							<img src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        						<figure class="draggable">
        							<img src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        					</section>
        					<footer>
        						<div class="footer-price">
        							<img src="{{ asset('img/icons/cointime_icon.png') }}">
        							<span>2.600</span>
        						</div>
        						<div class="houses-price">
        							<a href="#" class="info"><img src="{{ asset('img/house-info/info_btn.png') }}"></a>
        							<a href="#" class="coins"><img src="{{ asset('img/header/h_i_button_upg_timecoins_icon.svg') }}"><span>2.600</span></a>
        							<span class="replace"><img class="handle" src="{{ asset('img/house-info/remove_btn.png') }}"></span>
        						</div>
        					</footer>
        				</div>

        				<div class="house-item handle">
        					<header>
        						<div class="houses-count">
        							<span>+2.700</span>
        							<img src="{{ asset('img/house-info/coin_30.png') }}">
        						</div>
        						<div class="footer-buttons js-footerButtons">
        							<a href="#" class="info"><img src="{{ asset('img/icons/info_btn.svg') }}"></a>
        							<a href="#" class="featured"><img src="{{ asset('img/icons/featured_btn_disabled.svg') }}"></a>
        						</div>
        					</header>
        					<section>
        						<figure class="footer-image">
        							<img class="handle" src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        						<figure class="houses-images">
        							<img src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        						<figure class="draggable">
        							<img src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        					</section>
        					<footer>
        						<div class="footer-price">
        							<img src="{{ asset('img/icons/cointime_icon.png') }}">
        							<span>2.700</span>
        						</div>
        						<div class="houses-price">
        							<a href="#" class="info"><img src="{{ asset('img/house-info/info_btn.png') }}"></a>
        							<a href="#" class="coins"><img src="{{ asset('img/header/h_i_button_upg_timecoins_icon.svg') }}"><span>2.700</span></a>
        							<span class="replace"><img class="handle" src="{{ asset('img/house-info/remove_btn.png') }}"></span>
        						</div>
        					</footer>
        				</div>

        				<div class="house-item handle">
        					<header>
        						<div class="houses-count">
        							<span>+2.800</span>
        							<img src="{{ asset('img/house-info/coin_30.png') }}">
        						</div>
        						<div class="footer-buttons js-footerButtons">
        							<a href="#" class="info"><img src="{{ asset('img/icons/info_btn.svg') }}"></a>
        							<a href="#" class="featured"><img src="{{ asset('img/icons/featured_btn_disabled.svg') }}"></a>
        						</div>
        					</header>
        					<section>
        						<figure class="footer-image">
        							<img class="handle" src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        						<figure class="houses-images">
        							<img src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        						<figure class="draggable">
        							<img src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        					</section>
        					<footer>
        						<div class="footer-price">
        							<img src="{{ asset('img/icons/cointime_icon.png') }}">
        							<span>2.800</span>
        						</div>
        						<div class="houses-price">
        							<a href="#" class="info"><img src="{{ asset('img/house-info/info_btn.png') }}"></a>
        							<a href="#" class="coins"><img src="{{ asset('img/header/h_i_button_upg_timecoins_icon.svg') }}"><span>2.800</span></a>
        							<span class="replace"><img class="handle" src="{{ asset('img/house-info/remove_btn.png') }}"></span>
        						</div>
        					</footer>
        				</div>

        				<div class="house-item handle">
        					<header>
        						<div class="houses-count">
        							<span>+2.900</span>
        							<img src="{{ asset('img/house-info/coin_30.png') }}">
        						</div>
        						<div class="footer-buttons js-footerButtons">
        							<a href="#" class="info"><img src="{{ asset('img/icons/info_btn.svg') }}"></a>
        							<a href="#" class="featured"><img src="{{ asset('img/icons/featured_btn_disabled.svg') }}"></a>
        						</div>
        					</header>
        					<section>
        						<figure class="footer-image">
        							<img class="handle" src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        						<figure class="houses-images">
        							<img src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        						<figure class="draggable">
        							<img src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        					</section>
        					<footer>
        						<div class="footer-price">
        							<img src="{{ asset('img/icons/cointime_icon.png') }}">
        							<span>2.900</span>
        						</div>
        						<div class="houses-price">
        							<a href="#" class="info"><img src="{{ asset('img/house-info/info_btn.png') }}"></a>
        							<a href="#" class="coins"><img src="{{ asset('img/header/h_i_button_upg_timecoins_icon.svg') }}"><span>2.900</span></a>
        							<span class="replace"><img class="handle" src="{{ asset('img/house-info/remove_btn.png') }}"></span>
        						</div>
        					</footer>
        				</div>

        				<div class="house-item handle">
        					<header>
        						<div class="houses-count">
        							<span>+3.000</span>
        							<img src="{{ asset('img/house-info/coin_30.png') }}">
        						</div>
        						<div class="footer-buttons js-footerButtons">
        							<a href="#" class="info"><img src="{{ asset('img/icons/info_btn.svg') }}"></a>
        							<a href="#" class="featured"><img src="{{ asset('img/icons/featured_btn_disabled.svg') }}"></a>
        						</div>
        					</header>
        					<section>
        						<figure class="footer-image">
        							<img class="handle" src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        						<figure class="houses-images">
        							<img src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        						<figure class="draggable">
        							<img src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        					</section>
        					<footer>
        						<div class="footer-price">
        							<img src="{{ asset('img/icons/cointime_icon.png') }}">
        							<span>3.000</span>
        						</div>
        						<div class="houses-price">
        							<a href="#" class="info"><img src="{{ asset('img/house-info/info_btn.png') }}"></a>
        							<a href="#" class="coins"><img src="{{ asset('img/header/h_i_button_upg_timecoins_icon.svg') }}"><span>3.000</span></a>
        							<span class="replace"><img class="handle" src="{{ asset('img/house-info/remove_btn.png') }}"></span>
        						</div>
        					</footer>
        				</div>

        				<div class="house-item handle">
        					<header>
        						<div class="houses-count">
        							<span>+3.100</span>
        							<img src="{{ asset('img/house-info/coin_30.png') }}">
        						</div>
        						<div class="footer-buttons js-footerButtons">
        							<a href="#" class="info"><img src="{{ asset('img/icons/info_btn.svg') }}"></a>
        							<a href="#" class="featured"><img src="{{ asset('img/icons/featured_btn_disabled.svg') }}"></a>
        						</div>
        					</header>
        					<section>
        						<figure class="footer-image">
        							<img class="handle" src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        						<figure class="houses-images">
        							<img src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        						<figure class="draggable">
        							<img src="{{ asset('img/houses/house_1_icon.png') }}">
        						</figure>
        					</section>
        					<footer>
        						<div class="footer-price">
        							<img src="{{ asset('img/icons/cointime_icon.png') }}">
        							<span>3.100</span>
        						</div>
        						<div class="houses-price">
        							<a href="#" class="info"><img src="{{ asset('img/house-info/info_btn.png') }}"></a>
        							<a href="#" class="coins"><img src="{{ asset('img/header/h_i_button_upg_timecoins_icon.svg') }}"><span>3.100</span></a>
        							<span class="replace"><img class="handle" src="{{ asset('img/house-info/remove_btn.png') }}"></span>
        						</div>
        					</footer>
        				</div>
        			</section>

        			<section class="buld-active-block">

        			</section>

        			<section class="featured-active-block">

        			</section>

        			<footer>
        				<ul class="js-listSort">
        					<li>
        						<a href="#" class="new active">
        							<em>
        								<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        								width="31px" height="31px" viewBox="0 0 31 31" enable-background="new 0 0 31 31" xml:space="preserve">
        								<path fill="#FFFFFF" d="M30.999,18.67c0,0.912-0.74,1.652-1.654,1.652h-9.023v9.025c0,0.912-0.74,1.652-1.654,1.652H12.33
        								c-0.912,0-1.652-0.74-1.652-1.652v-9.025H1.652C0.74,20.323,0,19.583,0,18.67v-6.338c0-0.914,0.74-1.654,1.652-1.654h9.025V1.655
        								C10.678,0.741,11.418,0,12.33,0h6.337c0.914,0,1.654,0.74,1.654,1.654v9.023h9.023c0.914,0,1.654,0.74,1.654,1.654V18.67z"/>
        							</svg>
        						</em>
        						<!-- <img src="{{ asset('img/icons/icon_new_disable.png') }}"> -->
        						<span>New</span>
        					</a>
        				</li>
        				<li>
        					<a href="#" class="built active">
        						<em>
        							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        							width="33.828px" height="31.923px" viewBox="0 0 33.828 31.923" enable-background="new 0 0 33.828 31.923" xml:space="preserve">
        							<g>
        								<path fill="#FFFFFF" d="M10.133,16.731c-0.631,0.633-0.729,1.594-0.293,2.33l-1.824,1.822c-0.641,0.641-1.678,0.641-2.318,0
        								L0.48,15.668c-0.641-0.641-0.641-1.678,0-2.318l1.803-1.803c0.746,0.514,1.777,0.439,2.441-0.225
        								c0.662-0.664,0.736-1.693,0.223-2.439l4.928-4.928c0.166-0.164,0.357-0.287,0.561-0.365c2.391-1.539,8.125-4.855,12.498-3.082
        								l0.807,2.902c0,0-8.545,0.322-7.578,4.514l1.248,1.248c0.639,0.639,0.639,1.678,0,2.318l-4.949,4.947
        								C11.727,16.004,10.764,16.1,10.133,16.731z"/>
        								<path fill="#FFFFFF" d="M32.807,30.155l-0.746,0.746c-1.236,1.238-3.109,1.369-4.184,0.297L14.141,17.459l5.223-5.225
        								l13.738,13.736C34.176,27.045,34.043,28.918,32.807,30.155z"/>
        							</g>
        						</svg>
        					</em>
        					<!-- <img src="{{ asset('img/icons/icon_built_disable.png') }}"> -->
        					<span>Built</span>
        				</a>
        			</li>
        			<li>
        				<a href="#" class="featured active">
        					<em>
        						<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        						width="31.517px" height="30.326px" viewBox="0 0 31.517 30.326" enable-background="new 0 0 31.517 30.326" xml:space="preserve">
        						<path fill="#FFFFFF" d="M30.426,15.02l-4.717,4.596l1.113,6.49c0.232,1.355-0.322,2.723-1.436,3.529
        						c-0.629,0.459-1.373,0.691-2.121,0.691c-0.574,0-1.15-0.137-1.68-0.416l-5.828-3.064l-5.83,3.064
        						C9.4,30.189,8.824,30.326,8.25,30.326c-0.75,0-1.494-0.232-2.123-0.691c-1.111-0.807-1.668-2.174-1.436-3.529l1.113-6.49L1.09,15.02
        						c-0.984-0.959-1.338-2.393-0.914-3.699s1.553-2.26,2.914-2.457l6.518-0.947l2.914-5.906C13.129,0.779,14.383,0,15.758,0
        						c1.373,0,2.629,0.779,3.234,2.01l2.916,5.906l6.518,0.947c1.357,0.197,2.49,1.15,2.914,2.457S31.408,14.061,30.426,15.02z"/>
        					</svg>
        				</em>
        				<!-- <img src="{{ asset('img/icons/icon_featuring_disable.png') }}"> -->
        				<span>Featured</span>
        			</a>
        		</li>
        	</ul>
        </footer>
    </div>

</div>
</footer>
	</div>

    @yield('tmp-popup')

    <script src="{{ compile_assets('js/app.js') }}"></script>
    <!-- <script src="{{ compile_assets('js/libs.min.js') }}"></script> -->
    <script src="{{ compile_assets('js/jquery.min.js') }}"></script>
    <script src="{{ compile_assets('js/owl.carousel.min.js') }}"></script>
    <script src="{{ compile_assets('js/dragula.min.js') }}"></script>
    <script src="{{ compile_assets('js/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ compile_assets('js/main.js') }}"></script>

	@stack('scripts-footer')
</body>
</html>