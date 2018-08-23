<p>News
    @if (!empty($newTweetCount))
    <span>{{ $newTweetCount }}</span>
    @endif
</p>
<ul>
    @foreach ($tweets as $tweet)
        <li class="{{ empty($tweet->current_user_read()) ? 'unseen' : '' }}">
            <section>
                {!! $tweet->content !!}
            </section>
            <footer>
                <ul class="timer">
                    <li><img src="{{ asset('img/header/news/logo_bitcoin.svg') }}"></li>
                    <li><img src="{{ asset('img/header/news/time_icon.svg') }}"><span>{{ $tweet->time_left }}</span></li>
                </ul>
                <ul class="btns">
                    @auth
                        @if ($tweet->is_house_built
                            && !empty($tweet->tweet_update)
                            && count($tweet->tweet_update->current_user_houses()) == 0)
                            <li>
                                <a data-update-id="{{ $tweet->tweet_update->id }}" href="#" class="js-update{{ $tweet->tweet_update->update_class }}">{{ $tweet->tweet_update->value_text }}</a>
                            </li>
                        @endif
                    @endauth
                    @if (!empty($tweet->link))
                        <li>
                            <a target="_blank" href="{{ $tweet->link }}" class="more">More</a>
                        </li>
                    @elseif (!empty($tweet->alias))
                        <li>
                            <a href="/news/{{ $tweet->alias }}" class="more">More</a>
                        </li>
                    @endif
                </ul>
            </footer>
        </li>
    @endforeach
</ul>