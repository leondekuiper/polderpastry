<?php

require ("Model/ImageModel.php");

class ImageController 
{
    function CreateImageTables($active)
    {
        $ImageModel = new ImageModel();
        $ImageArray = $ImageModel->GetImageListByActive($active);
        $result = "";
        
        foreach ($ImageArray as $Image)
        {
            $result = $result .
                    "<li class='Image'>
                        <img class = 'thumbnail' runat = 'server' src ='$Image->image' width='320' height='240'/>
                        <span class = 'description'>
                            <h3 class = 'title'>$Image->name</h3>
                            <p class = 'text'>$Image->description</p>
                        </span>
                    </li>";
        }
        return $result;
    }
}