@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="offset-lg-4 col-lg-4">
            <div class="card">
                <div class="card-header">Administration</div>
                <div class="card card-body">
                    <form method="POST" action="{{ route('admin_login') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <input type="text" name="email" placeholder="Email*"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" placeholder="Пароль*"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6 col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input name="remember"
                                               type="checkbox"
                                               class="custom-control-input"
                                               id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="remember">Запомнить</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-block">Войти</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection