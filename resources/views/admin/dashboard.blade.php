@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="offset-lg-1 col-lg-10">
            <div class="card">
                <div class="card-header">Сводка</div>
                <div class="card-body">
                    <h4>Пользователи</h4>

                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Email</th>
                            <th>Имя</th>
                            <th>Дата регистрации</th>
                            <th>Последний просмотр новостей</th>
                            <th>Построил домов</th>
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
                                <td>{{ $user->user_houses()->count() }}</td>
                                <td>{{ $user->user_stat->money }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
