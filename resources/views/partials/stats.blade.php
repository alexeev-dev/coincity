<header></header>
<section>
    <h3>Statistics</h3>
    <div class="table">
        <table>
            <tr>
                <th>Title</th>
                <th>Money per hour</th>
                <th>Max money</th>
                <th>Speed</th>
                <th>Earned coins</th>
            </tr>
            @foreach ($userHouses as $userHouse)
            <tr>
                <td>
                    <div class="title">
                        <figure>
                            <img src="{{ asset('img/icons/statistics-image.png') }}">
                        </figure>
                        <p>Title of game</p>
                    </div>
                </td>
                <td>
                    <p><img src="{{ asset('img/icons/coin.png') }}"> <span>{{ $userHouse->money_per_hour }}</span></p>
                </td>
                <td>
                    <p><img src="{{ asset('img/icons/coin.png') }}"> {{ $userHouse->max_money }}</p>
                </td>
                <td>
                    <p><img src="{{ asset('img/icons/timer_clock.png') }}"> <span>x1</span></p>
                </td>
                <td>
                    <p><img src="{{ asset('img/icons/coin.png') }}"> {{ $userHouse->money }}</p>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</section>
<footer></footer>
