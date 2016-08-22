<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{

    public function __construct()
    {

    }

    public function home()
    {

        return view('pages.front.home', [
        ]);

    }
}

