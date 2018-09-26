<figure>
    <img src="{{ asset($userHouse->house->image) }}">
    <figcaption>
        <ul>
            <li class="time">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="98.76px" height="92.215px" viewBox="0 0 98.76 92.215"
                     enable-background="new 0 0 98.76 92.215" xml:space="preserve">
                    <g>
                        <g>
                            <path fill="#FFFFFF" d="M71.76,47.031c1.176,1.002,2.916,0.957,4.027-0.152c1.066-1.068,1.154-2.723,0.262-3.877l-0.043-0.043
                            c-0.021-0.043-0.066-0.088-0.088-0.109l-7.316-8.709c-0.303-0.369-0.5-0.826-0.523-1.328l-1.066-16.395
                            c-0.129-1.523-1.393-2.701-2.961-2.701c-1.523,0-2.764,1.133-2.939,2.615v0.021c0,0.064,0,0.129-0.021,0.195l-1.174,18.006
                            c-0.021,0.109-0.021,0.238-0.021,0.348v0.043c0,0.021,0,0.045,0,0.066c0,0.043,0,0.064,0,0.088
                            c-0.023,1.088,0.391,2.176,1.217,3.004c0.176,0.174,0.35,0.326,0.545,0.459L71.76,47.031z"/>
                            <path fill="#FFFFFF" d="M64.314,0C49.203,0,36.357,9.775,31.719,23.32c3.004,0.348,5.922,1.002,8.73,1.98
                            c3.68-9.602,13-16.438,23.865-16.438c14.086,0,25.561,11.475,25.561,25.561c0,12.76-9.385,23.34-21.619,25.256
                            c0.193,1.656,0.303,3.354,0.303,5.053c0,1.305-0.066,2.59-0.174,3.873c17.07-2.023,30.375-16.566,30.375-34.182
                            C98.736,15.438,83.299,0,64.314,0z"/>
                            <path fill="#FFFFFF" d="M32.303,27.607C14.463,27.607,0,42.07,0,59.912c0,17.84,14.463,32.303,32.303,32.303
                            s32.303-14.463,32.303-32.303C64.605,42.07,50.143,27.607,32.303,27.607z M53.082,58.348l-0.541,0.596
                            c-0.773,0.852-1.793,1.193-2.279,0.766s-0.881-0.775-0.881-0.775V77.4c0,1.15-0.93,2.08-2.08,2.08h-7.896
                            c-1.146,0-1.971-0.93-1.955-2.076V64.297h-9.502v13.107c0,1.146-0.932,2.078-2.08,2.078h-7.451c-1.148,0-2.08-0.932-2.08-2.078
                            V58.672l-1.428,1.279c-0.789,0.705-2.074,0.607-2.869-0.219l-0.48-0.5c-0.795-0.826-0.754-2.129,0.092-2.906l19.117-17.523
                            c0.848-0.775,2.232-0.791,3.098-0.033l19.053,16.668C53.781,56.195,53.857,57.498,53.082,58.348z"/>
                        </g>
                    </g>
                </svg>
                <p>{{ $userHouse->money_per_hour_text }}</p>
            </li>
            <li class="coins">
                <img src="{{ asset('img/house-info/popup_house_info_maxcoins.png') }}">
                <p>{{ $userHouse->max_money_text }}</p>
            </li>
        </ul>
    </figcaption>
</figure>
<ul>
    @foreach ($tweets as $tweet)
        @if ($loop->last && count($tweets) > $pageSize)
            @break
        @endif
        <li>
            <section>
                {!! $tweet->content !!}
            </section>
            <footer>
                <ul class="timer">
                    <li><img src="{{ asset($userHouse->house->ico) }}"></li>
                    <li><img src="{{ asset('img/header/news/time_icon.svg') }}"><span>{{ $tweet->time_left }}</span>
                    </li>
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
            <a href="#" class="load_more js-more-house" data-house-id="{{ $userHouse->house->id }}">LOAD MORE</a>
        </li>
    @endif
</ul>