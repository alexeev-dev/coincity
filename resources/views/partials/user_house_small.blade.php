<figure>
    <img src="{{ !empty($userHouse->house->ico) ? asset($userHouse->house->ico) : '#' }}">
</figure>
<h4>{{ $userHouse->house->name }}</h4>
<ul>
    <li class="time">
        <img src="{{ asset('img/house-info/popup_house_info_timecoins.png') }}">
        <p>{{ $userHouse->money_per_hour_text }}</p>
    </li>
    <li class="coins">
        <img src="{{ asset('img/house-info/popup_house_info_maxcoins.png') }}">
        <p>{{ $userHouse->max_money_text }}</p>
    </li>
</ul>
