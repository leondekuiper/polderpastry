<?php

require_once ("Model/TypeModel.php");

class TypeController 
{
    function CreateTypeOverviewAdmin()
    {
        $result = 
            "<table class ='overview-table'>"
            . "<tr class = 'table-header'>"
                . "<td>Name</td>"
                . "<td></td>"
                . "<td></td>"
            . "</tr>";

        $typeArray = $this->GetTypeAll();
        $typeModel = new TypeModel();
        $URL = "typeoverview";
        
        foreach ($typeArray as $type)
        {
            $result = $result
                . "<tr>"
                    . "<td>$type->name</td>"
                    . "<td><a href='type_newedit.php?edit=$type->id' class='overview-link'>Edit</a></td>"
                    . "<td><a href='#' onclick='ShowConfirmation(\"$URL\",$type->id)' class='overview-link'>Delete</a></td>"
                . "</tr>";
        };
        $result = $result . "</table>";
        
        return $result;
    }
    
    function GetTypeAll()
    {
        $typeModel = new TypeModel();
        return $typeModel->GetTypeAll();        
    } 

    function GetTypeById($id)
    {
        $typeModel = new TypeModel();
        return $typeModel->GetTypeByID($id);
    }
    
    function CreateType()
    {
        $name = $_POST["txtName"];
        
        $type = new TypeEntity('', $name);
        $typeModel = new TypeModel();
        $typeModel->CreateType($type);
    }
    
    function UpdateType($id)
    {
        $name = $_POST["txtName"];

        $type = new TypeEntity($id, $name);
        $typeModel = new TypeModel();
        $typeModel->UpdateType($type);
    }
    
    function DeleteType($id)
    {
        $typeModel = new TypeModel();
        $typeModel->DeleteType($id);
    }
}