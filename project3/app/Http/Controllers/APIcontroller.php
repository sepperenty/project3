<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Project;

class APIcontroller extends Controller
{

    public function allPorjectsAPI()
    {
        $projects = Project::where('is_active', 1)->get();
        $projects->load('user');

        return $projects;
    }

    public function fiterProjects($isCompany, $isPriority)
    {
        $projects = Project::where('is_active', 1)->where('isCompany', $isCompany)->where('isPriority', $isPriority)->get();
        $projects->load('user');

        return $projects;
    }



    public function showOneProjectAPI(Project $project)
    {
        $project->load('user');

        return $project;
    }
}
