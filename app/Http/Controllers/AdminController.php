<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function admin_index(Request $request)
    {
        $user = Auth::user();


        return view('pages.admin.admin_index', [

        ]);
    }
}