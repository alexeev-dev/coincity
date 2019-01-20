@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="offset-lg-4 col-lg-4">
            <div class="card">
                <div class="card-header">Загрузить данные из xls</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin_loader_update') }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <input type="password" name="password" placeholder="Пароль*"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-md-6 col-form-label">Data file (.xls)</label>
                            <div class="col-md-6">
                                <input type="file" id="file" name="datafile"
                                       class="inputfile{{ $errors->has('datafile') ? ' is-invalid' : '' }}">

                                @if ($errors->has('file'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('datafile') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-block">Загрузить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
