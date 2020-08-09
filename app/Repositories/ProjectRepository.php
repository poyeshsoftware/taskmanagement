<?php


namespace App\Repositories;


use App\Http\Resources\ProjectResource;
use App\Project;

class ProjectRepository implements ProjectRepositoryInterface
{

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(){
        return ProjectResource::collection(auth()->user()->projects);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function store($request){
        auth()->user()->projects()->create(array_merge($request->only('name'), [
            'sort' => $this->getOrder()
        ]));

        return ProjectResource::collection(auth()->user()->projects);
    }

    /**
     * @param Project $project
     * @param $request
     */
    public function update(Project $project,$request){
        $project->update($request->only('name'));
        $project->refresh();
    }

    /**
     * @param $request
     */
    public function resort($request){
        foreach ($request->projects as $key => $project) {
            Project::where('id', $project['id'])->update([
                'name' => $project['name'],
                'sort' => $key
            ]);
        }
        auth()->user()->refresh();
    }

    /**
     * @param Project $project
     * @throws \Exception
     */
    public function destroy(Project $project){
        $project->delete();
        auth()->user()->refresh();
    }

    /**
     * @return int
     */
    protected function getOrder()
    {
        if (Project::all()->count() === 0) {
            return 1;
        } else {
            $project = Project::orderBy('sort', 'desc')->first();
            return (($project->sort) + 1);
        }

    }

}
