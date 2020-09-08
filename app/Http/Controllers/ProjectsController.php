<?php

namespace App\Http\Controllers;
use App\Project;
use Illuminate\Http\Request;


class ProjectsController extends Controller
{
    public function index() {
        $projects = auth()->user()->projects;

       return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }


    public function store()
    {
        //validate
        /*$attributes = request()->validateRequest([
            'title'=> 'required',
            'description'=> 'required|max:100',
            'notes' => 'min:3'
        ]);*/

        //dd($attributes);

        //$attributes['owner_id'] = auth()->id();  //have to be signed in in order to access

        $project = auth()->user()->projects()->create($this->validateRequest());

        //redirect
        return redirect($project->path());
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Project $project)
    {
        $this->authorize('update', $project);

        $project->update($this->validateRequest()) ;

        return redirect($project->path());
    }

    protected function validateRequest()        //can also use a form request
    {
         return request()->validate([
            'title'=> 'sometimes|required',
            'description'=> 'sometimes|required|max:100',
            'notes' => 'nullable'
        ]);


    }
}
