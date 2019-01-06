<?php

class ImageController
{
    function GetImages()
    {
        $handle = opendir("Images");
        while($image = readdir($handle))
        {
            $images[]= $image;
        }
        closedir($handle);
        
        $result = array();
        foreach($images as $image)
        {
            if(strlen($image)>2)
            {
                array_push($result, $image);
            }
        }
        return $result;
    }
    
    function CreateImageOverview()
    {
        
    }
    
    function DeleteImage()
    {
        
    }
}

