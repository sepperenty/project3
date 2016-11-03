<?php

namespace App;

use Intervention\Image\ImageManagerStatic as Image;

    /*
        Deze klasse wordt gebruikt bij het uploaden van een foto.
        De resolutie blijft hierbij in verhouding hetzelfde met de oorspronkelijke foto.
        De foto's orden opgeslagen in 3 afmetingen.
        Klein, medium, orgineel.
        Op het einde worden de fotos in de bijhorende map geplaatst met de naam die is meegegeven.
        Hierbij wordt gebruik gemaakt van Image Intervention.
    */

class uploadPicture
{

        private $originalHeight = "";
        private $originalWidth = "";
        private $newSmallHeight = "";
        private  $newSmallWidth = "";

        private $newMediumHeight = "";
        private  $newMediumWidth = "";

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
        $extension = $this->file->extension();
        $oldHeight = $size{1};
        $oldWidth = $size{0};

        $originalHeight = $oldHeight;
        $originalWidth = $oldWidth;

        if ($oldHeight > $oldWidth) {
            $this->newSmallHeight = 108;
            $this->newSmallWidth = $oldWidth / $oldHeight * 108;

            $this->newMediumHeight = 216;
            $this->newMediumWidth = $oldWidth / $oldHeight * 216;

        } elseif ($oldWidth > $oldHeight) {
            $this->newSmallWidth = 162;
            $this->newSmallHeight = $oldHeight / $oldWidth * 162;

            $this->newMediumWidth = 384;
            $this->newMediumHeight = $oldHeight / $oldWidth * 384;

        } else{
            if($oldWidth<162)
            {
            $this->newSmallHeight = 108;
            $this->newSmallWidth = 108;
            }
            else
            {
            $this->newSmallHeight = 162;
            $this->newSmallWidth = 162;
            }
            if($oldWidth<384)
            {
            $this->newMediumHeight = 216;
            $this->newMediumWidth = 216;
            }
            else
            {
            $this->newMediumHeight = 384;
            $this->newMediumWidth = 384; 
            }
        }



        $imgSmal = Image::make($this->file)->resize($this->newSmallWidth, $this->newSmallHeight)->save('images/small/' . $this->name . "." . $extension);
        $imgMedium = Image::make($this->file)->resize($this->newMediumWidth, $this->newMediumHeight)->save('images/medium/' .  $this->name . "." . $extension);
        $imgBig = Image::make($this->file)->resize($this->originalWidth, $this->originalHeight)->save('images/big/' .  $this->name . "." . $extension);



    }

}