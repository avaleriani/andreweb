<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    protected $roles;

    CONST ADMIN = 1;
    CONST PAGINATIONVALUE = 25;

    public function login()
    {
        if (Auth::check()) {
            return Redirect::route('adminIndex');
        } else {
            return view('pages.users.login');
        }
    }

    public function doLogin(Request $request)
    {
        $userdata = array(
            'username' => $request->input('username'),
            'password' => $request->input('password')
        );
        if (Auth::guard('admin')->attempt($userdata)) {
            return Redirect::to(route('adminIndex'));
        } else {
            Session::flash('message', 'Usuario o contraseña incorrecto, por favor intente nuevamente.');
            return Redirect::to(route('login'));

        }
    }

    public function doLogout()
    {
        Auth::logout();
        return Redirect::to(route('login'));
    }

    public function index(Request $request, User $users)
    {
        $roles = array(
            self::ADMIN => "Administrador",
        );

        if ($search = $request->get('busqueda')) {
            $users->search($request->get('busqueda'));
        }

        return view('pages.users.index',
            [
                'users' => $users->sortable()->paginate(self::PAGINATIONVALUE),
                'roles' => $roles,
                'busqueda' => $search
            ]);
    }

    public function show($id)
    {
        return view('pages.users.show',
            ["user", User::find($id)]
        );
    }

    public function create()
    {
        return view('pages.users.create', [
            'roles' => $this->getAvailableRoles()
        ]);
    }

    public function store(Request $request)
    {
        $rules = array(
            'username' => 'bail|required|unique:user',
            'email' => 'required|email',
            'fnac' => 'date',
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        } else {
            $user = new User;
            $user->username = $request->get('username');
            $user->fnac = $request->get('fnac');
            $user->nombre = $request->get('nombre');
            $user->role = $request->get('role');
            $user->password = bcrypt($request->get('password'));
            $user->status = 1;
            $user->email = $request->get('email');
            $user->save();
            Session::flash('message', 'Usuario creado');
            return Redirect::to(route('admin.users.index'));
        }
    }

    public function getAvailableRoles()
    {

        $roles = array();
        if (Auth::user()->role == 1) {
            $roles = array(
                self::ADMIN => "Administrador",
            );
        }
        return $roles;
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.users.edit', [
            'user' => $user,
            'roles' => $this->getAvailableRoles()
        ]);
    }

    public function update($id, Request $request)
    {

        $rules = array(
            'username' => 'bail|required|unique:user,username,' . $id,
            'email' => 'required|email',
            'fnac' => 'date',
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        } else {
            $user = User::find($id);
            $user->username = $request->get('username');
            $user->fnac = $request->get('fnac');
            $user->nombre = $request->get('nombre');
            $user->role = $request->get('role');
            $user->status = 1;
            $user->email = $request->get('email');
            $user->password = bcrypt($request->get('password'));
            $user->save();
            Session::flash('message', 'Usuario actualizado');
            return Redirect::to(route('admin.users.index'));
        }
    }


    public function destroy($id)
    {
        try {
            $user = User::find($id);
            $user->delete();

            Session::flash('message', 'El usuario fue borrado');
            return Redirect::to(route('admin.users.index'));
        } catch (\Exception $e) {
            return Redirect::back()->with('message', 'Error, el usuario no pudo ser borrado.');
        }
    }
}