<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function index(){

        $posts = Post::orderBy('created_at', 'desc')
        // ->get();
        ->paginate(5);
        // dd($posts);

        return view('posts.index', ['posts' => $posts]);
    }

    public function store(Request $request){
        // $input = $request->all();
        // dd($request->all());
        $this->validate($request, Post::$rules);

        // $posts = new Post;
        // $posts->user_id = Auth::id();
        // $posts->body = $request->input('body');

        // カリキュラムを参考にして書いてみたもの。
        $posts = new Post;
        $form = $request->all();
        unset($form['_token']);
        $posts->fill($form);
        $posts->user_id = Auth::id();
        // dd(Auth::id());

        $posts->save();

        return redirect('posts/index');
    }

    public function destroy(Request $request){
        $posts = Post::find($request->id);
        $posts->delete();

        return redirect('posts/index');
    }
}
