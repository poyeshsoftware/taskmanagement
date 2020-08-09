<?php

namespace App\Repositories;

use App\Project;
use App\Task;

interface TaskRepositoryInterface
{
    public function index(Project $project);

    public function store(Project $project, $request);

    public function resort(Project $project, $request);

    public function update(Project $project, Task $task, $request);

    public function destroy(Project $project, Task $task);
}
