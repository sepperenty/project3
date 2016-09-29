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

	public function showOneProjectAPI(Project $project)
	{
		$project->load('user');

		return $project;
	}
}
