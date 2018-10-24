@extends('layouts.simple')

@section('tmp-popup')
    <div class="popup active">
    	<div class="popup-news-single active">
    		<a href="{{ route('home') }}" class="close"></a>
    		<div class="news-single">
    			<header>
    				<div class="banner"></div>
    			</header>
    			<section>
    				<div class="news-article">
    					<div class="content">
							{!! $singleNews->content !!}
    					</div>
                        <!--
    					<div class="article-footer">
    						<div class="timer">
    							<figure>
    								<img src="{{ asset('img/article/house.png') }}">
    							</figure>
    							<img src="{{ asset('img/icons/timer_clock.png') }}">
    							<span>04:56:34</span>
    						</div>
    						<a href="#" class="button">+770</a>
    					</div>
    					<div class="socials">
    						<p>Follow social networks to upgrade in time</p>
    						<ul>
    							<li><a href="#" class="fb"><span><i class="fab fa-facebook-f"></i></span>12</a></li>
    							<li><a href="#" class="tg"><span><i class="fab fa-telegram-plane"></i></span>5k</a></li>
    							<li><a href="#" class="tw"><span><i class="fab fa-twitter"></i></span>600</a></li>
    						</ul>
    					</div>
    					<div class="next-article">
    						<p>Next article loads...</p>
    						<ul>
    							<li></li>
    							<li></li>
    							<li></li>
    						</ul>
    					</div>
    					-->
    				</div>
                    <!--
    				<div class="news-sidebar">
    					<div class="currency">
    						<ul>
    							<li>
    								<div class="name"><figure><img src="{{ asset('img/currency/bitcoin.png') }}"></figure>Bitcoin</div>
    								<div class="current">$6,405.56</div>
    								<div class="percentage positive">+3%</div>
    							</li>
    							<li>
    								<div class="name"><figure><img src="{{ asset('img/currency/ethereum.png') }}"></figure>Ethereum</div>
    								<div class="current">$506.56</div>
    								<div class="percentage positive">+22%</div>
    							</li>
    							<li>
    								<div class="name"><figure><img src="{{ asset('img/currency/xrp.png') }}"></figure>XRP</div>
    								<div class="current">$0.56</div>
    								<div class="percentage negative">-82%</div>
    							</li>
    							<li>
    								<div class="name"><figure><img src="{{ asset('img/currency/bitcoin_cash.png') }}"></figure>Bitcoin Cash</div>
    								<div class="current">$6,405.56</div>
    								<div class="percentage positive">+45%</div>
    							</li>
    							<li>
    								<div class="name"><figure><img src="{{ asset('img/currency/litecoin.png') }}"></figure>Litecoin</div>
    								<div class="current">$6,405.56</div>
    								<div class="percentage positive">+3%</div>
    							</li>
    						</ul>
    						<a href="#">All currency</a>
    					</div>
    					<div class="banner"></div>
    					<div class="posts">
    						<h2>Posts</h2>
    						<ul>
    							<li>
    								<figure>
    									<img src="{{ asset('img/article/userphoto.png') }}">
    								</figure>
    								<div>
    									<ul>
    										<li>
    											<a href="#">Username</a>
    										</li>
    										<li>
    											<span><img src="{{ asset('img/icons/posts_time.png') }}"> 1 week ago</span>
    										</li>
    									</ul>
    									<a>Bitfinex Reveals Details on EOSfinex, Beta Launch in September</a>
    								</div>
    							</li>
    							<li>
    								<figure>
    									<img src="{{ asset('img/article/userphoto.png') }}">
    								</figure>
    								<div>
    									<ul>
    										<li>
    											<a href="#">Username</a>
    										</li>
    										<li>
    											<span><img src="{{ asset('img/icons/posts_time.png') }}"> 1 week ago</span>
    										</li>
    									</ul>
    									<a>Bitfinex Reveals Details on EOSfinex, Beta Launch in September</a>
    								</div>
    							</li>
    							<li>
    								<figure>
    									<img src="{{ asset('img/article/userphoto.png') }}">
    								</figure>
    								<div>
    									<ul>
    										<li>
    											<a href="#">Username</a>
    										</li>
    										<li>
    											<span><img src="{{ asset('img/icons/posts_time.png') }}"> 1 week ago</span>
    										</li>
    									</ul>
    									<a>Bitfinex Reveals Details on EOSfinex, Beta Launch in September</a>
    								</div>
    							</li>
    						</ul>
    						<a href="#">See more</a>
    					</div>
    				</div>
    				-->
    			</section>
                <!--
    			<footer>
    				<div class="banner"></div>
    			</footer>
    			-->
    		</div>
        </div>
    </div>
@endsection