@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ホーム</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <ul class="error-message">
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form method="POST" action="{{ action('PostsController@store') }}">
                        @csrf
                        <div class="form-group">
                            <textarea name="body" rows="3" class="form-control" placeholder="いまどうしてる？"></textarea>
                        </div>
                        <button type="submit" class="btn btn-info text-light submit-btn">つぶやく</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 post-list">
            @foreach($posts as $post)
            <div class="card">
                <div class="card-body">
                    <div class="body-upper clearfix" >
                        <div class="contributor">{{ $post->user->name }}</div>
                        <div class="post_time">{{ $post->created_at }}</div>
                    </div>
                    <div class="body-bottom">
                        <div class="post">{{ $post->body }}</div>
                        @if($post->user_id === Auth::id())
                        <a href="{{ action('PostsController@destroy', ['id' => $post->id]) }}" class="post-destroy">削除</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            {{--  {{ $posts->links() }}  --}}
        </div>
    </div>
</div>
@endsection
