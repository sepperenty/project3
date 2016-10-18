<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Project;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }


    public function edit(Project $project)
    {
        $project->load("User");
        return view('admin.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {

    }

    public function deleteProject(Project $project)
    {

    }

}
