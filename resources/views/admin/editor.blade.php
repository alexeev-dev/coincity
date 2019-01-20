@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="offset-lg-1 col-lg-10">
            <div class="card">
                <div class="card-header">Редактор</div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="col-md-6">
                            <textarea id="content"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts-footer')
    <script src="{{ compile_assets('js/editor.js') }}"></script>
@endpush