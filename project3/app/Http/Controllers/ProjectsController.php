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


    public function manage( Request $request)
    {

        if(Auth()->user()->isAdmin())
        {
            $projects = Project::where('is_active', 1)->orderBy('updated_at', 'desc')->simplePaginate(6);;
        }
        else
        {
            $projects = Project::where('user_id', Auth()->user()->id)->where('is_active', 1)->orderBy('updated_at', 'desc')->simplePaginate(6);
        }

        $message = "";

       if($request->session()->get("message"))
       {
           $message = $request->session()->pull("message");

       }

        return view('projects/manage', compact('projects', 'message'));


    }


    public function store(Request $request)
    {


        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required | max:500',
            'address' => 'required | max:255',
            'foto' => 'max:50000000 | mimes:jpeg,bmp,png',
            'email' => 'email',
            'telephoneNumber' => 'required|min:11|numeric',
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


        if ($request->id) {
            $oldProject = Project::find($request->id);
            $user_id = $oldProject->user_id;

            if (($user_id == Auth()->user()->id) || (Auth()->user()->isAdmin()) ) {
                if ($path == "") {
                    $path = $oldProject->foto;
                }
                try {
                    $oldProject->update([

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

                }catch(Exception $e){
                    return $e;
                    //////////////error page ////////////////
                }





            } else {
                return "unauthorised";
            }
        } else {
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
            }

            else{
                ///////////////error page ////////////////
            }


        }


        return redirect('/projects/manage');


    }

    public function delete(Project $project, Request $request)
    {
        if((Auth()->user()->id == $project->user_id) || (Auth()->user()->isAdmin()))
        {
            try{

                $project->update([
                    'is_active' => 0,
                ]);
                $request->session()->put('message', 'Project succesvol verwijderd');
                return redirect('/projects/manage');
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
