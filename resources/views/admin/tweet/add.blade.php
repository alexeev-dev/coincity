@extends('layouts.admin')

@push('styles-header')
    <link href="{{ compile_assets('css/datepicker3.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="offset-lg-1 col-lg-10">
            <h3>Добавить твит</h3>
        </div>

        <div class="offset-lg-1 col-lg-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-body">
                <form method="POST" action="{{ route('admin-tweet-add') }}">
                    {{ csrf_field() }}

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Категория (домик)*</label>
                        <div class="col-md-4">
                            <select name="house[]" class="form-control" size="10" autocomplete="off" multiple>
                                @foreach ($houses as $house)
                                    <option value="{{ $house->id }}">{{ $house->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Интротекст</label>
                        <div class="col-lg-8">
                            <textarea class="form-control"
                                      name="introtext">{{ old('introtext') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">SEO title</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="title"
                                   value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">SEO description</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="description"
                                   value="{{ old('description') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Alias (внутренний переход по кнопке more)</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="alias"
                                   value="{{ old('alias') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Линк (внешний линк по кнопке more)</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="link" value="{{ old('link') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pub_date" class="col-md-4 col-form-label">Дата публикации*</label>
                        <div class="col-md-4">
                            <input id="pub_date" name="pub_date" type="text" class="datepicker form-control"
                                   value="{{ old('pub_date') }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label"><strong>Контент</strong></label>
                        <div class="col-lg-8">
                            <textarea id="content" name="content">{{ old('content') }}</textarea>
                        </div>
                    </div>

                    <hr>

                    <h4>Апгрейды</h4>

                    @for ($i = 0; $i < 3; $i++)
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">{{ $i + 1 }}</label>
                            <div class="col-md-4">
                                <select class="form-control" name="update_type_id[]" autocomplete="off">
                                    <option value=""></option>
                                    <option value="1"{{ old('update_type_id.'.$i) == 1 ? " selected" : "" }}>+ к монеткам в час</option>
                                    <option value="2"{{ old('update_type_id.'.$i) == 2 ? " selected" : "" }}>+ к максимальному объему</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="value[]"
                                       value="{{ old('value.'.$i) }}">
                            </div>
                        </div>
                    @endfor

                    <hr>

                    <div class="row">
                        <div class="offset-md-4 col-md-8">
                            <a href="{{ route('admin-tweet') }}" class="btn btn-info">Назад</a>
                            <button class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts-footer')
    <script src="{{ compile_assets('js/editor.js') }}"></script>
@endpush