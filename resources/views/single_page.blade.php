@extends('layouts.single')

@section('single_page_content')
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
							{!! $content !!}
    					</div>
    				</div>
    			</section>
    		</div>
        </div>
    </div>
@endsection