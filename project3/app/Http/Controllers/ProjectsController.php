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
        $projects = Project::where('user_id', Auth()->user()->id)->where('is_active', 1)->get();

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

        $isPriority = 0;
        $isCompany = 0;

        if ($request->isPriority == 'on') {
            $isPriority = 1;
        }
        if ($request->isCompany == 'on') {
            $isCompany = 1;

        }

        if ($request->hasFile('foto')) {

            $newSmallHeight = "";
            $newSmallWidth = "";

            $newMediumHeight = "";
            $newMediumWidth = "";

            $newBigHeight = "";
            $newBigWidth = "";


            $size = getimagesize($request->foto);
            $oldHeight = $size{1};
            $oldWidth = $size{0};

            if ($oldHeight > $oldWidth) {
                $newSmallHeight = 108;
                $newSmallWidth = $oldWidth / $oldHeight * 108;

                $newMediumHeight = 216;
                $newMediumWidth = $oldWidth / $oldHeight * 216;

                $newBigHeight = 1080;
                $newBigWidth = $oldWidth / $oldHeight * 1080;

            } elseif ($oldWidth > $oldHeight) {
                $newSmallWidth = 162;
                $newSmallHeight = $oldHeight / $oldWidth * 162;

                $newMediumWidth = 384;
                $newMediumHeight = $oldHeight / $oldWidth * 384;

                $newBigWidth = 1920;
                $newBigHeight = $oldHeight / $oldWidth * 1920;
            } else {
                $newSmallHeight = 108;
                $newSmallWidth = $oldWidth / $oldHeight * 108;

                $newMediumHeight = 216;
                $newMediumWidth = $oldWidth / $oldHeight * 216;

                $newBigHeight = 1080;
                $newBigWidth = $oldWidth / $oldHeight * 1080;
            }


//

            $newName = rtrim(base64_encode(md5(microtime())), "=");

            $imgSmal = Image::make($request->foto)->resize($newSmallWidth, $newSmallHeight)->save('images/small/' . $newName . ".jpg");
            $imgMedium = Image::make($request->foto)->resize($newMediumWidth, $newMediumHeight)->save('images/medium/' . $newName . ".jpg");
            $imgBig = Image::make($request->foto)->resize($newBigWidth, $newBigHeight)->save('images/big/' . $newName . ".jpg");


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
