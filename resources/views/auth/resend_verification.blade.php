@extends('layouts.tmp')

@section('tmp-popup')
    <div class="popup active">
        <div class="popup-log-reg active">
            <a href="{{ route('home') }}" class="close"></a>
            <div class="log-reg">
                <h3>Resend verification code</h3>

                <form class="form-horizontal" method="POST" action="{{ route('resend_verification') }}">
                    {{ csrf_field() }}

                    <section>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">E-Mail</label>
                                
                            <input id="email" type="email" class="form-control" name="email" value="{{ $errors->has('email') ? old('email') : $email }}" autofocus required>

                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </section>

                    <footer>
                        <button type="submit" class="btn">
                            Send
                        </button>
                    </footer>
                </form>
            </div>
        </div>
    </div>
@endsection