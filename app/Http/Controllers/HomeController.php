<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Създаване на CV';

        return view('index', compact(
            'title')
        );
    }
}
