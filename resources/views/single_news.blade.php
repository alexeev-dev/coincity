@extends('layouts.app')

@section('tmp-popup')
    <div class="popup active">
        <div class="popup-log-reg active">
            <a href="{{ route('home') }}" class="close"></a>
            <div class="page-content">
                <h2>{{ $singleNews->title }}</h2>
                {!! $singleNews->content !!}
            </div>
        </div>
    </div>
@endsection