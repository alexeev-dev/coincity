@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="offset-lg-1 col-lg-10">
            <h3>Редактировать рекламный блок</h3>
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
                <form method="POST" action="{{ route('admin-adv-update', $adv->id) }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="col-form-label">Контент</label>
                        <textarea id="content" name="content">{{ old('content', $adv->content) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{ route('admin-adv') }}" class="btn btn-info">Назад</a>
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