<?php

namespace App\Http\Controllers;

use App\Tumami;
use Illuminate\Http\Request;

class TumamiController extends Controller
{
    public function index(Request $request)
    {
        $tumami_name = $request->tumami_name;
        // $cond_title が空白でない場合は、記事を検索して取得する
        if ($tumami_name != '') {
            $tumamis = Tumami::where('tumami_name', $tumami_name) . orderBy('updated_at', 'desc')->get();
        } else {
            $tumamis = Tumami::all()->sortByDesc('updated_at');
        }

        if (count($tumamis) > 0) {
            $headline = $tumamis->shift();
        } else {
            $headline = null;
        }

        // news/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、 cond_title という変数を渡している
        return view('tumami.index', ['headline' => $headline, 'tumamis' => $tumamis, 'tumami_name' => $tumami_name]);
    }
}
