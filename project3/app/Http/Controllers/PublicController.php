<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Project;
use App\Reaction;

class PublicController extends Controller
{
    public function index()
    {
        $amountRegistered = User::count();
        $amountProjectCompanys = Project::where('isCompany', 1)->where("is_active", 1)->count();
        $amountProjectUsers = Project::where('isCompany', 0)->where("is_active", 1)->count();

        return view('welcome', compact("amountRegistered", "amountProjectCompanys", "amountProjectUsers"));
    }

    public function show(Project $project)
    {
        $project->load('reactions.user');
        return view('projects/show', compact('project'));

    }
}
