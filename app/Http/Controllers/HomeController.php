<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $json = file_get_contents(public_path('news.json'));
        $news = json_decode($json, true);

        return view('welcome', compact('news'));
    }

    public function show($image)
    {
        return view('gallery', compact('image'));
    }
}