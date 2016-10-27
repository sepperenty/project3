<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Project;
use App\Picture;
use App\Reaction;
use App\RandomPictures;

class PublicController extends Controller
{
    public function index()
    {
        $amountRegistered = User::count();
        $amountProjectCompanys = Project::where('isCompany', 1)->count();
        $amountProjectUsers = Project::where('isCompany', 0)->count();

        $pictureCount = Picture::count();
        $maxAmount = 8;

        if($pictureCount < $maxAmount)
        {
            $maxAmount = $pictureCount;
        }

        $randomPictures = Picture::orderByRaw('RAND()')->take($maxAmount)->get();





        return view('welcome', compact("amountRegistered", "amountProjectCompanys", "amountProjectUsers", "randomPictures"));
    }

    public function show(Project $project)
    {
        $project->load('reactions.user');
        return view('projects/show', compact('project'));

    }
}
