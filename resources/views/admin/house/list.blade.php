@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="offset-lg-1 col-lg-3 col-md-4 col-sm-6 col-12">
            <a href="{{ route('admin-house-add') }}" class="btn btn-primary btn-block mb-3">Добавить новый</a>
        </div>
    </div>
    <div class="row">
        <div class="offset-lg-1 col-lg-10">
            <h3>Домики</h3>
        </div>

        <div class="offset-lg-1 col-lg-10">
            <div class="card">
                <div class="card-body">
                    @foreach ($houses as $house)
                        <div class="row item-edit">
                            <div class="col-sm-2 col-3">
                                <img class="img-fluid" src="{{ asset($house->image_small) }}" alt="">
                            </div>
                            <div class="col-sm-8 col-6">
                                <h4>{{ $house->name }}</h4>
                                <p>
                                    <strong>Id: </strong>{{ $house->id }}<br>
                                    <strong>Money per hour: </strong>{{ $house->money_per_hour_text }}<br>
                                    <strong>Max money: </strong>{{ $house->max_money_text }}
                                </p>
                            </div>
                            <div class="col-sm-2 col-3 text-right">
                                <a href="{{ route('admin-house-edit', $house->id) }}"><span
                                            class="glyphicon glyphicon-edit"></span></a>
                                <a href="" data-follow="{{ route('admin-house-delete', $house->id) }}" data-toggle="modal"
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