@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="offset-lg-1 col-lg-3 col-md-4 col-sm-6 col-12">
            <a href="{{ route('admin-tweet-add') }}" class="btn btn-primary btn-block mb-3">Добавить новый</a>
        </div>
    </div>
    <div class="row">
        <div class="offset-lg-1 col-lg-10">
            <h3>Твиты</h3>
        </div>

        <div class="offset-lg-1 col-lg-10">
            <div class="card">
                <div class="card-body">
                    @foreach ($tweets as $tweet)
                        <div class="row item-edit">
                            <div class="col-sm-10 col-9">
                                <h4>{{ $tweet->title }}</h4>
                                <p>
                                    <span class="badge badge-info">{{ \Carbon\Carbon::parse($tweet->pub_date)->format('d.m.Y H:i')}}</span>
                                    @foreach ($tweet->houses as $house)
                                        <span class="badge badge-success">
                                            {{ $house->name }}
                                        </span>
                                    @endforeach
                                    @foreach ($tweet->tweet_updates as $update)
                                        <span class="badge badge-warning">+{{ $update->value }}</span>
                                    @endforeach
                                    <br>
                                    {{ $tweet->introtext }}
                                </p>
                            </div>
                            <div class="col-sm-2 col-3 text-right">
                                <a href="{{ route('admin-tweet-edit', $tweet->id) }}"><span
                                            class="glyphicon glyphicon-edit"></span></a>
                                <a href="" data-follow="{{ route('admin-tweet-delete', $tweet->id) }}"
                                   data-toggle="modal"
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