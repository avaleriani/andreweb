<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProjectsImagesController extends Controller
{
    CONST PAGINATIONVALUE = 10;

    public function index($id)
    {
        return view('pages.projectsImages.index', [
            "project" => Project::find($id),
        ]);
    }

    public function show($id)
    {
        return view('pages.projectsImages.show',
            ["projectImages", Project::find($id)]
        );
    }

    public function create()
    {
        return view('pages.projectsImages.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator);
        } else {
            $project = new Project;
            $project->name = $request->get('name');
            $project->description = $request->get('edit');
            $project->client = $request->get('client');
            $project->dc = $request->get('dc');
            $project->year = $request->get('year');
            $project->save();
            Session::flash('message', 'Proyecto creado');
            return Redirect::to(route('admin.projects.index'));
        }
    }

    public function edit($id)
    {
        $project = Project::find($id);
        return view('pages.projects.edit', [
            'project' => $project,
        ]);
    }

    public function update($id, Request $request)
    {
        $rules = array(
            'name' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator);
        } else {
            $project = Project::find($id);
            $project->name = $request->get('name');
            $project->description = $request->get('edit');
            $project->client = $request->get('client');
            $project->dc = $request->get('dc');
            $project->year = $request->get('year');
            $project->save();
            Session::flash('message', 'Proyecto actualizado');
            return Redirect::to(route('admin.projects.index'));
        }
    }


    public function destroy($id)
    {
        try {
            $project = Project::find($id);
            $project->delete();

            Session::flash('message', 'El proyecto fue borrado');
            return Redirect::to(route('admin.projects.index'));
        } catch (\Exception $e) {
            return Redirect::back()->with('message', 'Error, el proyecto no pudo ser borrado.');
        }
    }
}