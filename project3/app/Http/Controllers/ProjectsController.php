<?php
namespace App\Http\Controllers;



use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Http\Request;

use Illuminate\Http\UploadedFile;

use App\Http\Requests;

use App\Project;

class ProjectsController extends Controller
{

    public function index()
    {
        return view('projects/index');
    }

    public function show(Project $project)
    {
        $project->load('reactions.user');
        return view('projects/show', compact('project'));

    }


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function manage()
    {
        $projects = Project::all()->where('user_id', Auth()->user()->id);

        return view('projects/manage', compact('projects'));

    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required | max:500',
            'address' => 'required | max:255',
            'foto' => 'max:5000 | mimes:jpeg,bmp,png'
        ]);


        $project = new Project;

        $path = "";

        if ($request->hasFile('foto')) {

//            $img = Image::make($request->foto)->resize(300, 200);
//
//            $path = $img->store('media/images');



            $img = Image::make($request->foto)->fit(150,150)->save('images/foo.jpg');

//            $project->foto = $path;
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

                ]);


            } else {
                return "unauthorised";
            }
        } else {
            if ($path == "") {
                $path = "media/images/default.jpeg";
                $project->foto = $path;
            }

            $project->user_id = Auth()->user()->id;
            $project->title = $request->title;
            $project->description = $request->description;
            $project->email = $request->email;
            $project->telephoneNumber = $request->telephoneNumber;
            $project->address = $request->address;
            $project->lat = $request->lat;
            $project->lng = $request->lng;
            $project->save();
        }


        return redirect('/projects/manage');


    }


}
