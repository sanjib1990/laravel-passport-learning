<?php

namespace App\Http\Controllers;

use App\Models\Project;

/**
 * Class ProjectController
 *
 * @package App\Http\Controllers
 */
class ProjectController extends Controller
{
    /**
     * @var Project
     */
    private $project;

    /**
     * ProjectController constructor.
     *
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->project->list());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        return response()->json(request()->project);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $data = $this->validateProject();

        return response()->json($this->project->store($data));
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy()
    {
        request()->project->delete();

        return response(null, 204);
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update()
    {
        $data = $this->validateProject();

        $this->project->updateProject(request()->project->id, $data);

        return response(null, 205);
    }

    /**
     * @return array
     */
    private function validateProject()
    {
        return $this->validate(request(), [
            'project_name' => 'required',
            'project_description' => 'required'
        ]);
    }
}
