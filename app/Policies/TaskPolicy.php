<?php

namespace App\Policies;

use App\Project;
use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function ownTask(User $user, Task $task)
    {
        return $user->id === $task->project->user->id;
    }
}
