<?php
namespace App\Http\Controllers;

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
        'category' => 'required | max: 100',
        'goal' => 'required | max:255',
        'address' => 'required | max:255',
        'foto' 	=> 'max:5000 | mimes:jpeg,bmp,png' 
   			 ]);


    	$project = new Project;

    	$path = "";
    	
        if($request->hasFile('foto'))
    	{
    		$path = $request->foto->store('media/images');
    		$project->foto = $path;
    	}


   		if($request->id)
    	{
    		$oldProject = Project::find($request->id);
    		$user_id = $oldProject->user_id;

    		if( $user_id == Auth()->user()->id )
    		{
    			if($path == "")
    			{
    				$path = $oldProject->foto;
    			}

    			$oldProject->update([

    						'title'			=>	$request->title,
    						'description'	=>	$request->description,
    						'goal'			=>	$request->goal,
    						'category'		=>	$request->category,
    						'address'		=>	$request->address,
    						'lat'			=>	$request->lat,
    						'lng'			=>	$request->lng,
    						'foto'			=> 	$path,

    				]);
    		}

    		else
    		{
    			return "unauthorised";
    		}
    	}

    	else
    	{
    		if($path == "")
    		{
    			$path = "media/images/default.jpeg";
    			$project->foto = $path;
    		}
    		
	    	$project->user_id = Auth()->user()->id;
	    	$project->title = $request->title;
	    	$project->description = $request->description;
	    	$project->goal = $request->goal;
	    	$project->category = $request->category;
	    	$project->address = $request->address;
	    	$project->lat = $request->lat;
	    	$project->lng = $request->lng;
    		$project->save();
    	}

    	
    	return redirect('/projects/manage');

    	
    	
    	
    	

    	

    }




}
