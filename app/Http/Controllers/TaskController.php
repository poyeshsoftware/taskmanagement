<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Http\Resources\TaskResource;
use App\Project;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        return TaskResource::collection($project->tasks);
    }


    public function store(Project $project)
    {
        request()->validate([
            'name' => [
                'string',
                'required',
                'max:255',
            ]
        ]);

        $project->tasks()->create(array_merge(request()->only('name'), [
            'sort' => $this->getOrder($project)
        ]));

        $project->refresh();

        return TaskResource::collection($project->tasks);
    }

    protected function getOrder(Project $project)
    {
        if (Task::where('project_id', $project->id)->get()->count() == 0) {
            return 1;
        } else {
            $task = Task::where('project_id', $project->id)->orderBy('sort', 'desc')->get()->first();
            return (($task->sort) + 1);
        }
    }

    public function resort(Project $project)
    {
        request()->validate([
            'tasks' => [
                'array',
                'required',
            ],
            'tasks.*.id' => ['integer', 'required'],
            'tasks.*.name' => ['string', 'required', 'max:255'],
        ]);

        foreach (request()->tasks as $key => $task) {
            Task::where('id', $task['id'])->update([
                'name' => $task['name'],
                'sort' => $key
            ]);
        }
        $project->refresh();

        return TaskResource::collection($project->tasks);
    }


    public function update(Project $project, Task $task)
    {
        request()->validate([
            'name' => [
                'string',
                'required',
                'max:255',
            ]
        ]);

        $task->update(request()->only('name'));
        $project->refresh();
        return TaskResource::collection($project->tasks);
    }


    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        $project->refresh();
        return TaskResource::collection($project->tasks);
    }
}
