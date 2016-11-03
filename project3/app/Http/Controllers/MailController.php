<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Project;

class MailController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendProjectMail(Project $project, Request $request)
    {
    	$data={};
    	$data->subject = $request->subject;
    	$data->message = $request->subject;
    	$data->user = Auth()->user;

    	$receiverEmail = $project->user->email;
    	if(!empty($project->email))
    	{
    		$receiverEmail = $project->email;
    	}

    	try{
    		Mail::send('mails.projectMail', ['data' => $data], function ($m) use ($data) {

            $m->from('GraagGedaan@web.be', 'Graag Gedaan');

            $m->to($receiverEmail, $project->user->name)->subject($request->subject);
        	});

        	$request->session()->put('message', 'Je formulier is verzonden! Hou je email in het oog voor een antwoord.');
            return redirect('/projects/$project->id/show'); 
    	}catch(Exception $e)
    	{
    		$request->session()->put('message', 'Er is iets misgegaan. We proberen het zo snel mogelijk op te lossen.');
            return redirect('/projects/$project->id/show'); 
    	}

  
    }
}
