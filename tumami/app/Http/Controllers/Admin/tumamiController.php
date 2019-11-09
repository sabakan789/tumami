<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tumami;
use Storage;

class tumamiController extends Controller
{
    public function index(Request $request)
    {
        $tumami_name = $request->tumami_name;
        if ($tumami_name != '') {
            // 検索されたら検索結果を取得する
            $tumamis = Tumami::where('tumami_name', $tumami_name)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $tumamis = Tumami::all();
        }
        return view('admin.tumami.index', ['tumamis' => $tumamis, 'tumami_name' => $tumami_name]);
    }

    public function add()
    {
        return view('admin.tumami.create');
    }


    public function create(Request $request)
    {
        $this->validate($request, Tumami::$rules);
        $tumami = new Tumami;
        $form = $request->all();
        $tumami->fill($form);
        $user = \Auth::user();
        $tumami->user_id = $user->id;
        $tumami->save();

        return redirect('admin/tumami/index');
    }

    public function edit(Request $request)
    {
        // News Modelからデータを取得する
        $tumami = Tumami::find($request->id);
        if (empty($tumami)) {
            abort(404);
        }
        return view('admin.tumami.edit', ['tumami_form' => $tumami]);
    }
    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Tumami::$rules);
        // News Modelからデータを取得する
        $tumami = Tumami::find($request->id);
        // 送信されてきたフォームデータを格納する
        $tumami_form = $request->all();
        if (isset($tumami_form['tumami_image'])) {
            $path = $request->file('tumami_image')->store('public/tumami_image');
            $tumami->image_path = basename($path);
            unset($tumami_form['tumami_image']);
        } elseif (0 == strcmp($request->remove, 'tumami_image')) {
            $tumami->video = null;
        }
        unset($tumami_form['_token']);
        unset($tumami_form['remove']);

        // 該当するデータを上書きして保存する

        $tumami->fill($tumami_form)->save();

        return redirect('admin/tumami/index');
    }

    public function show(Request $request)
    {
        // News Modelからデータを取得する
        $tumami = Tumami::find($request->id);
        if (empty($tumami)) {
            abort(404);
        }
        return view('admin.tumami.show', ['tumami' => $tumami, 'user' => $tumami->user_id]);
    }

    public function delete(Request $request)
    {
        $tumami = Tumami::find($request->id);
        $tumami->delete();
        return redirect('admin/tumami/index');
    }
}
