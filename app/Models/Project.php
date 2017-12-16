<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Project
 *
 * @package App\Models
 */
class Project extends Model
{
    /**
     * Fillable Fields
     *
     * @var array
     */
    protected $fillable = ['project_name', 'project_description'];

    /**
     * Create a project.
     *
     * @param array $data
     *
     * @return $this|Model
     */
    public function store(array $data)
    {
        return $this->create([
            'project_name' => $data['project_name'],
            'project_description' => $data['project_description']
        ]);
    }

    /**
     * @param       $projectId
     * @param array $data
     *
     * @return bool
     */
    public function updateProject($projectId, array $data)
    {
        return $this
            ->where('id', $projectId)
            ->update([
                'project_name' => $data['project_name'],
                'project_description' => $data['project_description']
            ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function list()
    {
        return $this->orderBy('id', 'desc')->get();
    }
}
