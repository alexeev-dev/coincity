@extends('layouts.app')

@section('tmp-popup')
    <div class="popup active">
        <div class="popup-log-reg active">
            <a href="{{ route('home') }}" class="close"></a>
            <div class="log-reg">
                <p>{{ $singleNews->title }}</p>
                <div><p>{{ $singleNews->content }}</p></div>
            </div>
        </div>
    </div>
@endsection