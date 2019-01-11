@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Сводка</div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Пользователи</h4>

                                <table class="table table-hover table-responsive table-bordered">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Email</th>
                                        <th>Имя</th>
                                        <th>Дата регистрации</th>
                                        <th>Последний просмотр новостей</th>
                                        <th>Монет</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->created_at_text }}</td>
                                            <td>{{ $user->user_stat->last_tweet_read_text }}</td>
                                            <td>{{ $user->user_stat->money }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
