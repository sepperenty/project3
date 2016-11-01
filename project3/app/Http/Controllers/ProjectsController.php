<?php
namespace App\Http\Controllers;


use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Project;

use App\User;

use App\UploadPicture;
use League\Flysystem\Exception;

class ProjectsController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
    }


    public function add(Request $request)
    {
        if($request->session()->get("message"))
        {
               $message = $request->session()->pull("message");

        }
        return view('projects/add', compact('message'));
    }

     public function store(Request $request)
    {


        $this->validate($request, [
            'title' => 'required|max:50',
            'description' => 'required | max:500',
            'address' => 'required | max:255',
            'foto' => 'max:50000000 | mimes:jpeg,bmp,png',
            'email' => 'email | max:50',
            'telephoneNumber' => 'required|min:11|numeric|max:50',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $project = new Project;
        $path = "";
        $isPriority = 0;
        $isCompany = 0;

        if ($request->isPriority == 'on') {
            $isPriority = 1;
        }
        if ($request->isCompany == 'on') {
            $isCompany = 1;

        }

        if ($request->hasFile('foto')) {

            $newName = rtrim(base64_encode(md5(microtime())), "=");
            $uploader = new UploadPicture($request->foto, $newName);
            $uploader->store();
            $path = $newName;
        }


        
            if ($path == "") {
                $path = "default";
            }
            $project->foto = $path;
            $project->user_id = Auth()->user()->id;
            $project->title = $request->title;
            $project->description = $request->description;
            $project->email = $request->email;
            $project->telephoneNumber = $request->telephoneNumber;
            $project->address = $request->address;
            $project->lat = $request->lat;
            $project->lng = $request->lng;
            $project->isPriority = $isPriority;
            $project->isCompany = $isCompany;

            $updateSuccessful =  $project->save();

            if($updateSuccessful)
            {
                $request->session()->put('message', 'Je oproep is geplaatst');
                 return redirect('/projects/beheer');
            }

            else{
                $request->session()->put('message', 'Er is iets mis gelopen, contacteer de webmaster');
                return redirect('/projects/beheer');

            }

    }

     public function manage(Request $request)
    {
        $projects = "";
        $message = "";

       
        $projects = Project::where('user_id', Auth()->user()->id)->orderBy('updated_at', 'desc')->simplePaginate(6);
        
        

        if($request->session()->get("message"))
        {
               $message = $request->session()->pull("message");

        }

        return view('/projects/manage', compact('projects', "message"));
    }

    public function edit(Project $project)
    {

        return view('projects/edit', compact('project'));
    }


    public function update(Project $project, Request $request)
    {
         $this->validate($request, [
            'title' => 'required|max:50',
            'description' => 'required | max:500',
            'address' => 'required | max:255',
            'foto' => 'max:50000000 | mimes:jpeg,bmp,png',
            'email' => 'email|max:50',
            'telephoneNumber' => 'required|min:11|numeric|max:50',
            'lat' => 'required',
            'lng' => 'required',
        ]);
       
        $user_id = $project->user_id;
        $path = $project->foto;
        $isPriority = 0;
        $isCompany = 0;

        if ( $user_id == Auth()->user()->id ) {

                if ($request->hasFile('foto')) {

                    $newName = rtrim(base64_encode(md5(microtime())), "=");
                    $uploader = new UploadPicture($request->foto, $newName);
                    $uploader->store();
                    $path = $newName;

                }

                if ($request->isPriority == 'on') {
                    $isPriority = 1;
                }
                if ($request->isCompany == 'on') {
                    $isCompany = 1;

                }

                
                try {
                    $project->update([

                        'title' => $request->title,
                        'description' => $request->description,
                        'address' => $request->address,
                        'lat' => $request->lat,
                        'lng' => $request->lng,
                        'foto' => $path,
                        'email' => $request->email,
                        'telephoneNumber' => $request->telephoneNumber,
                        'isPriority' => $isPriority,
                        'isCompany' => $isCompany,
                    ]);
                    $request->session()->put('message', 'Je oproep is succesvol geupdate');
                    return redirect('/projects/beheer');

                }catch(Exception $e){
                    $request->session()->put('message', 'Er is iets misgelopen, contacteer de webmaster');
                    return redirect('/projects/beheer');
                }

            } else {
                 $request->session()->put('message', 'Je bent niet geauthoriseerd om dit project te wijzigen.');
                return redirect('/projects/beheer');
            }
        
    }


   

    public function delete(Project $project, Request $request)
    {
        if((Auth()->user()->id == $project->user_id) || (Auth()->user()->isAdmin()))
        {
            try{

                $project->delete();
                $request->session()->put('message', 'Project succesvol verwijderd');
                return redirect('/projects/beheer');
            }catch (Exception $e)
            {
                return $e;
                //////////////error page ////////////////
            }

        }
        else{
            return redirect('/');
        }

    }


}
