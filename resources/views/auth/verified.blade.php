@extends('layouts.single')

@section('single_page_content')
    <div class="popup active">
        <div class="popup-log-reg active">
            <a href="{{ route('home') }}" class="close"></a>
            <div class="log-reg">
                <h4>E-mail verified</h4>
                <div>
                    <p>Your E-mail was successfully verified.</p>
                </div>
                <a class="btn green" href="{{ route('home') }}">
                    Back
                </a>
            </div>
        </div>
    </div>
@endsection