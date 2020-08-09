<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskResortRequest;
use App\Http\Requests\TaskStoreRequest;
use App\Project;
use App\Repositories\TaskRepositoryInterface;
use App\Task;

class TaskController extends Controller
{
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Display a listing of the resources
     */
    public function index(Project $project)
    {
        return $this->taskRepository->index($project);
    }


    /**
     *
     */
    public function store(Project $project, TaskStoreRequest $request)
    {
        $this->taskRepository->store($project,$request);
        return $this->taskRepository->index($project);
    }

    /**
     *
     */
    public function resort(Project $project, TaskResortRequest $request)
    {
        $this->taskRepository->resort($project,$request);

        return $this->taskRepository->index($project);
    }

    /**
     *
     */
    public function update(Project $project, Task $task, TaskStoreRequest $request)
    {
        $this->taskRepository->update($project,$task,$request);

        return $this->taskRepository->index($project);
    }

    /**
     *
     */
    public function destroy(Project $project, Task $task)
    {
        $this->taskRepository->destroy($project,$task);

        return $this->taskRepository->index($project);
    }
}
