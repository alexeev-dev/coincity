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
                <li>
                    @foreach ($tweet->houses as $house)
                        <img src="{{ asset($house->icon) }}">
                    @endforeach
                </li>
                @php $timeLeft = $tweet->time_left; @endphp
                @if (!empty($timeLeft))
                    <li><img src="{{ asset('img/header/news/time_icon.svg') }}"><span>{{ $timeLeft }}</span></li>
                @endif
            </ul>
            <ul class="btns">
                @auth
                    @if ($tweet->is_house_built && !$tweet->is_old
                        && !empty($tweet->tweet_updates))
                        @foreach ($tweet->tweet_updates as $tweet_update)
                            @if (count($tweet_update->current_user_houses()) == 0)
                                <li>
                                    <a data-house-id="{{ $userHouse->house->id }}" data-update-id="{{ $tweet_update->id }}" href="#"
                                       class="js-update{{ $tweet_update->update_class }}">{{ $tweet_update->value_text }}</a>
                                </li>
                            @endif
                        @endforeach
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
    <li class="more">
        <a href="#" class="load_more js-more-house btn" data-house-id="{{ $userHouse->house->id }}">LOAD MORE</a>
    </li>
@endif
