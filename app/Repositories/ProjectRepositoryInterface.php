<?php

namespace App\Repositories;

use App\Project;

interface ProjectRepositoryInterface
{
    public function index();

    public function store($request);

    public function update(Project $project,$request);

    public function resort($request);

    public function destroy(Project $project);
}
