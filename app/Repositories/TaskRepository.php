<?php


namespace App\Repositories;


use App\Http\Resources\TaskResource;
use App\Project;
use App\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function index(Project $project){
        return TaskResource::collection($project->tasks);
    }

    public function store(Project $project,$request){
        $project->tasks()->create(array_merge($request->only('name'), [
            'sort' => $this->getOrder($project)
        ]));

        $project->refresh();
    }

    public function resort(Project $project,$request){
        foreach ($request->tasks as $key => $task) {
            Task::where('id', $task['id'])->update([
                'name' => $task['name'],
                'sort' => $key
            ]);
        }
        $project->refresh();
    }

    public function update(Project $project, Task $task,$request){
        $task->update($request->only('name'));
        $project->refresh();
    }

    public function destroy(Project $project, Task $task){
        $task->delete();
        $project->refresh();
    }

    /**
     *
     */
    protected function getOrder(Project $project)
    {
        if (Task::where('project_id', $project->id)->get()->count() == 0) {
            return 1;
        } else {
            $task = Task::where('project_id', $project->id)->orderBy('sort', 'desc')->get()->first();
            return (($task->sort) + 1);
        }
    }
}
