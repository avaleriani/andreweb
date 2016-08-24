<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    CONST PAGINATIONVALUE = 25;

    public function index(Request $request, Project $project)
    {
        if ($search = $request->get('busqueda')) {
            $project->search($request->get('busqueda'));
        }

        return view('pages.projects.index',
            [
                'projects' => $project->orderBy('order')->sortable()->paginate(self::PAGINATIONVALUE),
                'busqueda' => $search
            ]);
    }

    public function show($id)
    {
        return view('pages.projects.show',
            ["project", Project::find($id)]
        );
    }

    public function create()
    {
        return view('pages.projects.create');
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
            $user = new Project;
            $user->username = $request->get('username');
            $user->fnac = $request->get('fnac');
            $user->nombre = $request->get('nombre');
            $user->role = $request->get('role');
            $user->password = bcrypt($request->get('password'));
            $user->status = 1;
            $user->email = $request->get('email');
            $user->save();
            Session::flash('message', 'Usuario creado');
            return Redirect::to(route('admin.projects.index'));
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
        $user = Project::find($id);
        return view('pages.projects.edit', [
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
            $user = Project::find($id);
            $user->username = $request->get('username');
            $user->fnac = $request->get('fnac');
            $user->nombre = $request->get('nombre');
            $user->role = $request->get('role');
            $user->status = 1;
            $user->email = $request->get('email');
            $user->password = bcrypt($request->get('password'));
            $user->save();
            Session::flash('message', 'Usuario actualizado');
            return Redirect::to(route('admin.projects.index'));
        }
    }


    public function destroy($id)
    {
        try {
            $user = Project::find($id);
            $user->delete();

            Session::flash('message', 'El usuario fue borrado');
            return Redirect::to(route('admin.projects.index'));
        } catch (\Exception $e) {
            return Redirect::back()->with('message', 'Error, el usuario no pudo ser borrado.');
        }
    }
}