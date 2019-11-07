<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class MapController extends Controller
{
    public function index()
    {
        return view('map');
    }
}
