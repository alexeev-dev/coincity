@extends('layouts.tmp')

@section('tmp-popup')
    <div class="popup active">
        <div class="popup-log-reg active">
            <a href="{{ route('home') }}" class="close"></a>
            <div class="log-reg">
                <p>Verification code sent</p>
                <div><p>Verification code was sent to your E-mail {{ session('code_sent_to_email') }}. Please, follow the link in the letter.</p></div>
            </div>
        </div>
    </div>
@endsection