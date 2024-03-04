<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $skills = DB::table('skills')->get();
        $title = 'Създаване на CV';

        return view('index', compact(
            'skills',
            'title')
        );
    }
}
