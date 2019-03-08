<?php

require ("Model/LabelModel.php");

class LabelController 
{
    function CreateLabelOverviewAdmin()
    {
        $result = 
            "<table class ='overview-table'>"
            . "<tr class = 'table-header'>"
                . "<td>Name</td>"
                . "<td></td>"
                . "<td></td>"
            . "</tr>";

        $labelArray = $this->GetLabelAll();
        $LabelModel = new LabelModel();
        
        foreach ($labelArray as $label)
        {
            $result = $result
                . "<tr>"
                    . "<td>$label->name</td>"
                    . "<td><a href='item_newedit.php?edit=$label->id' class='overview-link'>Edit</a></td>"
                    . "<td><a href='#' onclick='ShowConfirmation($label->id)' class='overview-link'>Delete</a></td>"
                . "</tr>";
        };
        $result = $result . "</table>";
        
        return $result;
    }
    
    function GetLabelAll()
    {
        $labelModel = new LabelModel();
        return $labelModel->GetLabelAll();        
    } 

    function GetLabelById($id)
    {
        $labelModel = new LabelModel();
        return $labelModel->GetLabelByID($id);
    }
    
    function CreateLabel()
    {
        $name = $_POST["txtName"];
        
        $label = new LabelEntity('', $name);
        $labelModel = new LabelModel();
        $labelModel->CreateLabel($item);
    }
    
    function UpdateLabel($id)
    {
        $name = $_POST["txtName"];

        $label = new LabelEntity($id, $name);
        $labelModel = new LabelModel();
        $labelModel->UpdateLabel($item);
    }
    
    function DeleteLabel($id)
    {
        $labelModel = new LabelModel();
        $labelModel->DeleteLabel($id);
    }
}
