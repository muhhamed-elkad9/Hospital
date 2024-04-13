<?php

namespace App\Traits;


trait UploadImage
{

    function saveImage($photo, $folder)
    {
        $file_name = $photo->getClientOriginalName();
        $path = $folder;
        $photo->move($path, $file_name);

        return $file_name;
    }
}
