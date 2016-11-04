<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Project;
use App\Picture;
use App\Reaction;
use App\RandomPictures;
use Mail;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $amountRegistered = User::count();
        $amountProjectCompanys = Project::where('isCompany', 1)->count();
        $amountProjectUsers = Project::where('isCompany', 0)->count();

        $pictureCount = Picture::count();
        $maxAmount = 8;

        if($pictureCount < $maxAmount)
        {
            $maxAmount = $pictureCount;
        }

        $randomPictures = Picture::orderByRaw('RAND()')->take($maxAmount)->get();


        if($request->session()->get("message"))
        {
               $message = $request->session()->pull("message");

        }



        return view('welcome', compact("amountRegistered", "amountProjectCompanys", "amountProjectUsers", "randomPictures", "message"));
    }

    public function show(Project $project, Request $request)
    {

        if($request->session()->get("message"))
        {
               $message = $request->session()->pull("message");

        }
        $project->load('reactions.user');
        return view('projects/show', compact('project', 'message'));

    }

    public function info()
    {
        return view("info");
    }

    public function contact()
    {
        return view('contact');
    }

     public function sendContactMail(Request $request)
    {
        $data = (object) null;
        
        $this->validate($request, [
            'bericht' => 'required | max:500',
            'onderwerp' => 'required | max:50',
            ]);
        if(Auth()->check())
        {
            $data->name = Auth()->user()->name;
            $data->email = Auth()->user()->email;
        }
        else{
            $this->validate($request, [
             'naam' => 'required | max:50',
            'email' => 'required | email | max:50',
            ]);
            $data->name = $request->naam;
            $data->email = $request->email;

        }
                
        $data->subject = $request->onderwerp;
        $data->message = $request->bericht;
        
        $data->receiverEmail = "sepperenty@hotmail.com";

        try{
            Mail::send('mails.contactMail', ['data' => $data], function ($m) use ($data) {

            $m->from('GraagGedaan@web.be', 'Graag Gedaan');

            $m->to($data->receiverEmail, "Graag Gedaan")->subject($data->subject);
            });

            $request->session()->put('message', 'Je contact forulier is verzonden. Bedankt.');
            return redirect('/'); 
        }catch(Exception $e)
        {
            $request->session()->put('message', 'Er is iets misgegaan. We proberen het zo snel mogelijk op te lossen.');
            return redirect('/'); 
        }


    }
}
