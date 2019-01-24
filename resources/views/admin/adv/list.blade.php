@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="offset-lg-1 col-lg-3 col-md-4 col-sm-6 col-12">
            <a href="{{ route('admin-adv-add') }}" class="btn btn-primary btn-block mb-3">Добавить новый</a>
        </div>
    </div>
    <div class="row">
        <div class="offset-lg-1 col-lg-10">
            <h3>Рекламные блоки</h3>
        </div>

        <div class="offset-lg-1 col-lg-10">
            <div class="card">
                <div class="card-body">
                    @foreach ($advs as $adv)
                        <div class="row item-edit">
                            <div class="col-sm-10 col-9">
                                {!! $adv->content !!}
                            </div>
                            <div class="col-sm-2 col-3 text-right">
                                <a href="{{ route('admin-adv-edit', $adv->id) }}"><span
                                            class="glyphicon glyphicon-edit"></span></a>
                                <a href="" data-follow="{{ route('admin-adv-delete', $adv->id) }}" data-toggle="modal"
                                   data-target="#confirmation"><span class="glyphicon glyphicon-trash"></span></a>
                            </div>
                            @if (!$loop->last)
                                <div class="col-sm-12 col-12">
                                    <hr>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection