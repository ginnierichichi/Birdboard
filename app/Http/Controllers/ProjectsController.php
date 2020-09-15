<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Http\Requests\UpdateProjectRequest;


class ProjectsController extends Controller
{
    public function index() {
        $projects = auth()->user()->groupProjects();

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

    /**
     * @return mixed
     */

    /**
     * Persist a new project.
     *
     * @return mixed
     */
    public function store()
    {
        $project = auth()->user()->projects()->create($this->validateRequest());

        if ($tasks = request('tasks')) {
            $project->addTasks($tasks);
        }

        if (request()->wantsJson()) {
            return ['message' => $project->path()];
        }

        return redirect($project->path());

        //validate
        /*$attributes = request()->validateRequest([
            'title'=> 'required',
            'description'=> 'required|max:100',
            'notes' => 'min:3'
        ]);*/

        //dd($attributes);

        //$attributes['owner_id'] = auth()->id();  //have to be signed in in order to access
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

    public function destroy(Project $project)
    {
        $this->authorize('manage', $project);
        $project->delete();
        return redirect('/projects');
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
