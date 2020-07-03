<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\models\Step;
use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = auth()->user()->projects;

        return ProjectResource::collection($projects);
    }

    public function store()
    {
        request()->validate([
            'name' => [
                'string',
                'required',
                'max:255',
            ]
        ]);

        auth()->user()->projects()->create(array_merge(request()->only('name'), [
            'sort' => $this->getOrder()
        ]));

        return ProjectResource::collection(auth()->user()->projects);

    }

    protected function getOrder()
    {
        if (Project::all()->count() === 0) {
            return 1;
        } else {
            $project = Project::orderBy('sort', 'desc')->first();
            return (($project->sort) + 1);
        }

    }

    public function resort()
    {
        request()->validate([
            'projects' => [
                'array',
                'required',
            ],
            'projects.*.id' => ['integer', 'required'],
            'projects.*.name' => ['string', 'required', 'max:255'],
        ]);

        foreach (request()->projects as $key => $project) {
            Project::where('id', $project['id'])->update([
                'name' => $project['name'],
                'sort' => $key
            ]);
        }
        auth()->user()->refresh();
        return ProjectResource::collection(auth()->user()->projects);
    }

    public function update(Project $project)
    {
        request()->validate([
            'name' => [
                'string',
                'required',
                'max:255',
            ]
        ]);

        $project->update(request()->only('name'));
        $project->refresh();

        return ProjectResource::collection(auth()->user()->projects);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        auth()->user()->refresh();
        return ProjectResource::collection(auth()->user()->projects);
    }
}
