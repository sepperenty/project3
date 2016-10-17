<?php
/**
 * Created by PhpStorm.
 * User: seppe
 * Date: 17/10/2016
 * Time: 13:38
 */

namespace App;




class uploadPicture
{
        private $newSmallHeight = "";
        private  $newSmallWidth = "";

        private $newMediumHeight = "";
        private  $newMediumWidth = "";

        private $newBigHeight = "";
        private $newBigWidth = "";

        public $file;


    public function __construct($initFile)
    {
        $this->file = $initFile;


    }

    public function store()
    {

        $size = getimagesize($this->file);
        $oldHeight = $size{1};
        $oldWidth = $size{0};

        if ($oldHeight > $oldWidth) {
            $this->newSmallHeight = 108;
            $this->newSmallWidth = $oldWidth / $oldHeight * 108;

            $this->newMediumHeight = 216;
            $this->newMediumWidth = $oldWidth / $oldHeight * 216;

            $this->newBigHeight = 1080;
            $this->newBigWidth = $oldWidth / $oldHeight * 1080;

        } elseif ($oldWidth > $oldHeight) {
            $this->newSmallWidth = 162;
            $this->newSmallHeight = $oldHeight / $oldWidth * 162;

            $this->newMediumWidth = 384;
            $this->newMediumHeight = $oldHeight / $oldWidth * 384;

            $this->newBigWidth = 1920;
            $this->newBigHeight = $oldHeight / $oldWidth * 1920;
        } else {
            $this->newSmallHeight = 108;
            $this->newSmallWidth = $oldWidth / $oldHeight * 108;

            $this->newMediumHeight = 216;
            $this->newMediumWidth = $oldWidth / $oldHeight * 216;

            $this->newBigHeight = 1080;
            $this->newBigWidth = $oldWidth / $oldHeight * 1080;
        }

        $newName = rtrim(base64_encode(md5(microtime())), "=");

        $imgSmal = Image::make($request->foto)->resize($this->newSmallWidth, $this->newSmallHeight)->save('images/small/' . $newName . ".jpg");
        $imgMedium = Image::make($request->foto)->resize($this->newMediumWidth, $this->newMediumHeight)->save('images/medium/' . $newName . ".jpg");
        $imgBig = Image::make($request->foto)->resize($this->newBigWidth, $this->newBigHeight)->save('images/big/' . $newName . ".jpg");


        $path = $newName;

    }

}