@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="offset-lg-1 col-lg-10">
            <h3>Добавить домик</h3>
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
                <form method="POST" action="{{ route('admin-house-add') }}">
                    {{ csrf_field() }}

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Название*</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Иконка</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="icon" value="{{ old('icon') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Картинка домика</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="image_small" value="{{ old('image_small') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Картинка в описании</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="image" value="{{ old('image') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Монет в час*</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="money_per_hour" value="{{ old('money_per_hour') }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Максимум монет*</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="max_money" value="{{ old('max_money') }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">SEO title</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">SEO description</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label"><strong>Контент</strong></label>
                        <div class="col-lg-8">
                            <textarea id="content" name="content">{{ old('content') }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="offset-md-4 col-md-8">
                            <a href="{{ route('admin-house') }}" class="btn btn-info">Назад</a>
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