<p>News<span>{{ count($tweets) }}</span></p>
<ul>
    @foreach ($tweets as $tweet)
        <li>
            <section>
                <p>{{ $tweet->content }}</p>
            </section>
            <footer>
                <ul class="timer">
                    <li><img src="{{ asset('img/header/news/logo_bitcoin.svg') }}"></li>
                    <li><img src="{{ asset('img/header/news/time_icon.svg') }}"><span>{{ $tweet->time_left }}</span></li>
                </ul>
                <ul class="btns">
                    @auth
                        @if ($tweet->is_house_built)
                            <li>
                                <a href="#" class="{{ $tweet->tweet_update->update_class }}">{{ $tweet->tweet_update->value_text }}</a>
                            </li>
                        @endif
                    @endauth
                    <li>
                        <a href="#" class="more">More</a>
                    </li>
                </ul>
            </footer>
        </li>
    @endforeach
</ul>