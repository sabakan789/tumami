<?php

namespace App\Http\Controllers;
use App\Tumami;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TumamiController extends Controller
{
    public function index(Request $request)
    {
        $tumami_name = $request->tumami_name;
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
        return view('tumami/index', ['headline' => $headline, 'tumamis' => $tumamis, 'tumami_name' => $tumami_name]);
    }
}
