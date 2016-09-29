<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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




}
