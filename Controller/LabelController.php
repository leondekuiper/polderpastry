<?php

require ("Model/LabelModel.php");

class LabelController 
{
    function CreateLabelTables($active)
    {
        $LabelModel = new LabelModel();
        $LabelArray = $LabelModel->GetLabelListByActive($active);
        $result = "";
        
        foreach ($LabelArray as $Label)
        {
            $result = $result .
                    "<li class='Label'>
                        <img class = 'thumbnail' runat = 'server' src ='$Label->image' width='320' height='240'/>
                        <span class = 'description'>
                            <h3 class = 'title'>$Label->name</h3>
                            <p class = 'text'>$Label->description</p>
                        </span>
                    </li>";
        }
        return $result;
    }
}