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
        $projects = Project::where('user_id', $user->id)->get();

        return view('admin.projects', compact("projects", "user"));

    }

    public function delete(Project $project)
    {
        $project->delete();
        //return $project->id;
        return redirect('/admin/' .$project->user_id . '/projects');
    }

}
