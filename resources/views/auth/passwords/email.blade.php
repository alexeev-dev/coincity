@extends('layouts.single')

@section('single_page_content')
    <div class="popup active">
        <div class="popup-log-reg active">
            <a href="{{ route('home') }}" class="close"></a>
            <div class="log-reg">
                <p>FORGOT YOUR PASSWORD?</p>

                @if (session('status'))
                    <p>
                        {{ session('status') }}
                    </p>
                @endif

                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}

                    <section>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">E-Mail</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </section>

                    <footer>
                        <button type="submit" class="btn">
                            RESET YOUR PASSWORD
                        </button>
                    </footer>
                </form>

            </div>
        </div>
    </div>
@endsection
