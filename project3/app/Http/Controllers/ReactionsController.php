<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;

use App\Reaction;
use App\Project;

class ReactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Project $project)
    {
        $reaction = new Reaction;
        $reaction->reaction = $request->body;
        $reaction->user_id =  Auth()->user()->id;

        $reaction->project_id = $project->id;

        $reaction->save();

        return redirect("/projects/" . $project->id . "/show");


    }


}
