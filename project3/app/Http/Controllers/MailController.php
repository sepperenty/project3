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
         $this->validate($request, [
            'subject' => 'required | max:50',
            'message' => 'required | max:500',
        ]);


    	$data = (object) null;
    	$data->subject = $request->subject;
    	$data->message = $request->message;
    	$data->user = Auth()->user();
    	$data->receiverEmail = $project->user->email;
    	$data->project = $project;
    	$data->request = $request;

    	if(!empty($project->email))
    	{
    		$data->receiverEmail = $project->email;
    	}

    	try{
    		Mail::send('mails.projectMail', ['data' => $data], function ($m) use ($data) {

            $m->from('GraagGedaan@web.be', 'Graag Gedaan');

            $m->to($data->receiverEmail, $data->project->user->name)->subject($data->request->subject);
        	});

        	$request->session()->put('message', 'Je bericht is verzonden! Controleer je mail voor een antwoord.');
            return redirect('/projects/' . $project->id . '/show'); 
    	}catch(Exception $e)
    	{
    		$request->session()->put('message', 'Er is iets misgelopen. We lossen het zo snel mogelijk op.');
            return redirect('/projects/' . $project->id . '/show'); 
    	}

  
    }

   
}
