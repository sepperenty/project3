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


    public function users(Project $project, Request $request)
    {
        $message = "";
        if($request->session()->get("message"))
        {
               $message = $request->session()->pull("message");
        }
        $users = User::all();
        return view('admin.users', compact('users', "message"));

    }

    public function deleteUser(User $user, Request $request)
    {
        try{
                $user->delete();
                $request->session()->put('message', 'De user is succesvol verwijderd');
                return redirect("/admin/users");
        }catch(Exception $e)
        {
                $request->session()->put('message', 'Er is iets misgelopen. We lossen het zo snel mogelijk op.');
                return redirect("/admin/users");
        }
      
    }


    public function projects(User $user, Request $request)
    {   
        $message = "";
        if($request->session()->get("message"))
        {
               $message = $request->session()->pull("message");
        }

        $projects = Project::where('user_id', $user->id)->get();

        return view('admin.projects', compact("projects", "user", "message"));

    }

    public function delete(Project $project, Request $request)
    {
        try{
            $project->delete();
            $request->session()->put('message', 'Je oproep is geplaatst');
            return redirect('/admin/' .$project->user_id . '/projects');
        }catch(Exception $e){
            $request->session()->put('message', 'Er is iets misgelopen. We lossen het zo snel mogelijk op.');
            return redirect('/admin/' .$project->user_id . '/projects');
        }
    }

}
