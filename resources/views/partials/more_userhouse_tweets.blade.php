@foreach ($tweets as $tweet)
    @if ($loop->last && count($tweets) > $pageSize)
        @break
    @endif
    <li>
        <section>
            <p>{{ $tweet->introtext }}</p>
        </section>
        <footer>
            <ul class="timer">
                <li><img src="{{ asset($userHouse->house->icon) }}"></li>
                <li><img src="{{ asset('img/header/news/time_icon.svg') }}"><span>{{ $tweet->time_left }}</span></li>
            </ul>
            <ul class="btns">
                @auth
                    @if ($tweet->is_house_built
                        && !empty($tweet->tweet_update)
                        && count($tweet->tweet_update->current_user_houses()) == 0)
                        <li>
                            <a data-update-id="{{ $tweet->tweet_update->id }}" href="#"
                               class="js-update{{ $tweet->tweet_update->update_class }}">{{ $tweet->tweet_update->value_text }}</a>
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
@if (count($tweets) > $pageSize)
    <li>
        <a href="#" class="load_more js-more-house btn" data-house-id="{{ $userHouse->house->id }}">LOAD MORE</a>
    </li>
@endif
