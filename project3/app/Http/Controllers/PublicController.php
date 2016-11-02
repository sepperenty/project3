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
    public function index(Request $request)
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


        if($request->session()->get("message"))
        {
               $message = $request->session()->pull("message");

        }



        return view('welcome', compact("amountRegistered", "amountProjectCompanys", "amountProjectUsers", "randomPictures","message"));
    }

    public function show(Project $project)
    {
        $project->load('reactions.user');
        return view('projects/show', compact('project'));

    }

    public function info()
    {
        return view("info");
    }

    public function contact()
    {
        return view('contact');
    }
}
