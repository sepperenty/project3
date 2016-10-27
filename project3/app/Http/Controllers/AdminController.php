<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Project;

use App\User;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }


    public function users(Project $project)
    {
        $users = User::all();

        return view('admin.users', compact('users'));

    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect("/admin/users");
    }


    public function projects(User $user)
    {
        $projects = Project::where('user_id', $user->id);

        return view('admin.projects', compact("projects", "user"));

    }

}
