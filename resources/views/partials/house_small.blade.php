<figure>
    <img src="{{ !empty($house->ico) ? asset($house->ico) : '#' }}">
</figure>
<h4>{{ $house->name }}</h4>
<ul>
    <li class="time">
        <img src="{{ asset('img/house-info/popup_house_info_timecoins.png') }}">
        <p>{{ $house->money_per_hour_text }}</p>
    </li>
    <li class="coins">
        <img src="{{ asset('img/house-info/popup_house_info_maxcoins.png') }}">
        <p>{{ $house->max_money_text }}</p>
    </li>
</ul>
