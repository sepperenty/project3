<?php
/**
 * Created by PhpStorm.
 * User: seppe
 * Date: 17/10/2016
 * Time: 13:38
 */

namespace App;



use Intervention\Image\ImageManagerStatic as Image;


class uploadPicture
{
        private $newSmallHeight = "";
        private  $newSmallWidth = "";

        private $newMediumHeight = "";
        private  $newMediumWidth = "";

        private $newBigHeight = "";
        private $newBigWidth = "";

        private $file;
        private $name;


    public function __construct($initFile, $initName)
    {
        $this->file = $initFile;
        $this->name = $initName;

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



        $imgSmal = Image::make($this->file)->resize($this->newSmallWidth, $this->newSmallHeight)->save('images/small/' . $this->name . ".jpg");
        $imgMedium = Image::make($this->file)->resize($this->newMediumWidth, $this->newMediumHeight)->save('images/medium/' .  $this->name . ".jpg");
        $imgBig = Image::make($this->file)->resize($this->newBigWidth, $this->newBigHeight)->save('images/big/' .  $this->name . ".jpg");



    }

}