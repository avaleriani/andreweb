<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function admin_index(Request $request)
    {


        //mostrar algo copado  random cada vez que entras. o estadisticas de visitas ¿analytics?


        return view('pages.admin.admin_index', [

        ]);
    }
}