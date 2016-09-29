<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\UploadedFile;

use App\Http\Requests;

use App\Project;

class ProjectsController extends Controller
{	

	public function index()
	{
		return view('projects/index');
	}

    

	public function __construct()
    {
        $this->middleware('auth');
    }


    public function manage()
    {
    	$projects = Project::all()->where('user_id', Auth()->user()->id);

    	return view('projects/manage', compact('projects'));
    }

    public function store(Request $request)
    {
    	$project = new Project;
    	$project->user_id = Auth()->user()->id;
    	$project->title = $request->title;
    	$project->description = $request->description;
    	$project->goal = $request->goal;
    	$project->category = $request->category;


    	if($request->hasFile('foto'))
    	{
    		return 'true';
    	}

    	return 'false';
    	
    	
    	

    	

    }




}
