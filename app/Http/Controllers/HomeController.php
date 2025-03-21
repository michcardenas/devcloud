<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $content = \App\Models\HomepageContent::firstOrCreate([]);
        return view('index', compact('content'));
    }
}
