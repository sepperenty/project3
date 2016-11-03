<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Picture;
use App\User;
use App\uploadPicture;

class PictureController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add()
    {
        return view('pictures.addPicture');

    }

    public function store(Request $request)
    {

        $this->validate($request, [

            'foto' => 'required | max:5000 | mimes:jpeg,bmp,png',
            'picture_info' => 'required | max:50',

        ]);

        if ($request->hasFile('foto')) {

            try{
                    $newName = rtrim(base64_encode(md5(microtime())), "=");
                    $uploader = new UploadPicture($request->foto, $newName);
                    $uploader->store();
                    $picture = new Picture;
                    $picture->name = $newName . "." . $request->foto->extension();
                    $picture->user_id = Auth()->user()->id;
                    $picture->picture_info = $request->picture_info;
                    $picture->save();
                    $request->session()->put('message', 'je foto is upgeload.');
                    return redirect("/");

            }catch(Exception $e)
            {       
                    $request->session()->put('message', 'Er is iets misgelopen. We lossen het zo snel mogelijk op.');
                    return redirect("/");
            }
        

        }

        else
        {
            $request->session()->put('message', 'Er is iets misgelopen. We lossen het zo snel mogelijk op.');
             return redirect("/pictures/add");
        }
       


    }
}
