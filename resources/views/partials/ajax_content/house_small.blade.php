<header>
    <div class="banner"></div>
</header>
<section>
    <div class="info-full">
        <header>
            <figure>
                <img src="{{ asset($house->image) }}">
                <figcaption>
                    <h2>{{ $house->name }}</h2>
                    {!! $house->content !!}
                </figcaption>
            </figure>
        </header>
    </div>
</section>

