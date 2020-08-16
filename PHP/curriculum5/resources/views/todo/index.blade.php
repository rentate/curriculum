@extends('layouts.layout')
@section('title', 'todos一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Todos一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\TodoController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Admin\TodoController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                        <ul class="sort">
                            <li><a href="{{ action('Admin\TodoController@add') }}" role="button">新規作成</a></li>
                            <li><a href="{{ action('Admin\TodoController@sort') }}" role="button">重要度昇順↑</a></li>
                            <li><a href="{{ action('Admin\TodoController@index') }}" role="button">重要度降順↓</a></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>タイトル</th>
                            <th>場所</th>
                            <th>期限</th>
                            <th colspan="2">重要度</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todos as $todo)

                            @if(new DateTime($todo->deadline) >= $today)

                            @else
                                <tr class="deadline-todo">
                            @endif
                                <td>{{ $todo->id }}</td>
                                <td>{{ str_limit($todo->title, 100) }}</td>
                                <td>{{ str_limit($todo->space, 100) }}</td>
                                <td>{{ str_limit($todo->deadline, 100) }}</td>
                                <td>{{ str_limit($todo->priority, 100) }}</td>
                                <td><div><a href="{{ action('Admin\TodoController@edit', ['id' => $todo->id]) }}">編集</a></div></td>
                                <td><div><a href="{{ action('Admin\TodoController@delete', ['id' => $todo->id]) }}">削除</a></div></td>
                                <td><div><a class="mod-btn" href="{{ action('Admin\TodoController@complete', ['id' => $todo->id]) }}">完了</a></div></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection