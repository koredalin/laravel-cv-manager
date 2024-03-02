<?php

namespace App\Http\Controllers;

use App\Models\GuestUser;

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
