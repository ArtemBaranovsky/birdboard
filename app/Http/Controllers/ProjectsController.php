<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{
    public function index()
    {
//        $projects = Project::all();
        $projects = auth()->user()->projects;
        return view('projects.index', compact('projects'));
    }
    public function store()
    {
        // validate
/*        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
//            'owner_id' => 'required'
        ]);*/
//        $attributes['owner_id'] = auth()->id();
//        auth()->user()->projects()->create($attributes);
        auth()->user()->projects()->create(request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]));

        // persist
//        Project::create($attributes);
        // redirect
        return redirect('/projects');
    }

    public function show(Project $project)
    {
//        $project = Project::findOrFail(request('project'));
//        if (auth()->id() !== $project->owner_id) {
//        if (auth()->id() !== (int) $project->owner_id) {
        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }
        return view('projects.show', compact('project'));
    }
}
