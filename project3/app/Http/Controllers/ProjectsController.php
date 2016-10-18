<?php
namespace App\Http\Controllers;


use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Http\Request;

use Illuminate\Http\UploadedFile;

use App\Http\Requests;

use App\Project;

use App\User;

use App\UploadPicture;

class ProjectsController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
    }


    public function manage()
    {
        $projects = Project::where('user_id', Auth()->user()->id)->where('is_active', 1)->get();

        return view('projects/manage', compact('projects'));

    }


    public function store(Request $request)
    {


        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required | max:500',
            'address' => 'required | max:255',
            'foto' => 'max:50000000 | mimes:jpeg,bmp,png'
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

            if ($user_id == Auth()->user()->id) {
                if ($path == "") {
                    $path = $oldProject->foto;
                }

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
            $project->save();
        }


        return redirect('/projects/manage');


    }

    public function delete(Project $project)
    {
        $project->update([
            'is_active' => 0,
        ]);

        return redirect('/projects/manage');
    }


}
