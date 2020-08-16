<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Todo;
use Carbon\Carbon;
use DateTime;

class TodoController extends Controller
{
  // 以下を追記
  public function add()
  {
      return view('todo.create');
  }

  public function index(Request $request)
  {
    $cond_title = $request->cond_title;
    if($cond_title != ''){
      // 検索されたら検索結果を取得する
      $todos = Todo::where('title', $cond_title)->get();
    } else{
      // それ以外はすべて取得する
      $todos = Todo::where('is_complete', 0)
      ->orderBy('priority', 'desc')
      ->get();
    }
    $today = Carbon::today();
    return view('todo.index', ['todos' => $todos, 'cond_title' => $cond_title, 'today' => $today]);
  }

  public function create(Request $request)
  {
    // バリデーションを行う
    $this->validate($request, Todo::$rules);
    $todo = new Todo;
    $form = $request->all();

    // フォームから送信されてきた_tokenを削除
    unset($form['_token']);
    $todo->fill($form);
    $todo->is_complete = 0;

    // データベースに保存する
    $todo->save();
    return redirect('todo/');
  }

  public function edit(Request $request)
  {
    // Todoモデルからデータを取得
    $todos = Todo::find($request->id);
    if(empty($todos)){
      abort(404);
    }
    return view('todo.edit', ['todo_form' => $todos]);
  }

  public function update(Request $request)
  {
    // バリデーションをかける
    $this->validate($request, Todo::$rules);
    // Todoモデルからデータの取得
    $todo = Todo::find($request->id);
    // 送信されてきたフォームデータを格納
    $todo_form = $request->all();

    unset($todo_form['_token']);
    unset($todo_form['remove']);

    // 該当するデータを上書きして保存
    $todo->fill($todo_form)->save();

    return redirect('todo');
  }

  public function delete(Request $request)
  {
    // 該当するTodo Modelを取得
    $todos = Todo::find($request->id);
    // 削除
    $todos->delete();
    return redirect('todo/');
  }

  public function complete(Request $request)
  {
    // 該当するTodo Modelを取得

    $todo = Todo::find($request->id);
    $todo->is_complete = 1;
    $todo->save();
    //dd($todo->is_complete);

    return redirect('todo/complete_list');
  }

  public function complete_list()
  {
  // 完了フラグがtrueのデータのみ取得
  $posts = Todo::where('is_complete',1)->get();

  return view('todo.complete_list', ['posts' => $posts]);
  }

  public function incomplete(Request $request)
  {
    // 該当するTodo Modelを取得
    $todo = Todo::find($request->id);
    $todo->is_complete = 0;
    $todo->save();
    return redirect('todo/');
  }

  public function sort(Request $request)
  {
    $cond_title = $request->cond_title;
    $todos = Todo::where('is_complete', 0)
    ->orderBy('priority', 'asc')
    ->get();

    return view('todo.index', ['todos' => $todos, 'cond_title' => $cond_title]);
  }

  public function dead_list(Request $request)
  {
    // 該当するTodoモデルを取得
    $posts = Todo::where([
      ['deadline', '<', date("Y-m-d")]
    ])->get();

    return view('todo.dead_list', ['posts' => $posts]);
  }

  public function search_dead_list(Request $request)
  {
    $cond_title = $request->cond_title;
    $posts = Todo::where([
      ['deadline', '<', date("Y-m-d")],
      ['title', 'like', '%' . $cond_title . '%']
    ])->get();

    return view('todo.dead_list', ['posts' => $posts]);
  }
}