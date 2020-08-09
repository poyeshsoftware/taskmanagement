<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectResortRequest;
use App\Http\Requests\ProjectStoreRequest;
use App\Project;
use App\Repositories\ProjectRepositoryInterface;

class ProjectController extends Controller
{

    private $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->projectRepository->index();
    }

    public function store(ProjectStoreRequest $request)
    {
        $this->projectRepository->store($request);
        return $this->projectRepository->index();
    }


    public function resort(ProjectResortRequest $request)
    {
        $this->projectRepository->resort($request);
        return $this->projectRepository->index();
    }

    public function update(Project $project, ProjectStoreRequest $request)
    {
        $this->projectRepository->update($project, $request);
        return $this->projectRepository->index();
    }

    public function destroy(Project $project)
    {
        $this->projectRepository->destroy($project);
        return $this->projectRepository->index();
    }
}
