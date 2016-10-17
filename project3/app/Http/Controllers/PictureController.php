<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Picture;
use App\User;

use App\UploadPicture;

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

            'foto' => 'required | max:5000 | mimes:jpeg,bmp,png'

        ]);

        if ($request->hasFile('foto')) {


            $newName = rtrim(base64_encode(md5(microtime())), "=");
            $uploader = new UploadPicture($request->foto, $newName);
            $uploader->store();
            $picture = new Picture;
            $picture->name = $newName;
            $picture->user_id = Auth()->user()->id;
            $picture->save();
        }

        return redirect("/");


    }
}
