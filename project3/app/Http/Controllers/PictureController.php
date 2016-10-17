<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


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

}
