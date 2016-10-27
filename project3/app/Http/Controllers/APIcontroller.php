<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Project;

class APIcontroller extends Controller
{

    public function allPorjectsAPI()
    {
        $projects = Project::all();
        $projects->load('user');

        return $projects;
    }

    public function fiterProjects($key)
    {
        $projects = "";
        if($key == "company") {
            $projects = Project::where('isCompany', 1)->get();

        }elseif($key == "individual"){
            $projects = Project::where('isCompany', 0)->get();
        }elseif($key == "priority"){
            $projects = Project::where('isPriority', 1)->get();
        }


        return $projects;
    }



    public function showOneProjectAPI(Project $project)
    {
        $project->load('user');

        return $project;
    }
}
