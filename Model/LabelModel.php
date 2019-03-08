<?php

require ("Entities/LabelEntity.php");

class LabelModel
{
    function GetlabelAll()
    {
        require 'Credentials.php';
     
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "SELECT * FROM label ORDER BY name ASC";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $name);
        $labelArray = array();

        while($stmt->fetch())
        {
            $label = new LabelEntity($id, $name);
            array_push($labelArray, $label);
        }    
        mysqli_close($mysqli);
        return $labelArray;
    }
    
    function GetLabelByID($labelId)
    {
        require 'Credentials.php';
     
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "SELECT * FROM label WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $labelId);
        $stmt->execute();
        $stmt->bind_result($id, $name);

        while($stmt->fetch())
        {
            $label = new LabelEntity($id, $name);
        }    
        mysqli_close($mysqli);
        return $label;
    }
    
    function CreateLabel(LabelEntity $label)
    {
        require 'Credentials.php';
        
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "INSERT INTO label (name) VALUES (?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $label->name);
        $stmt->execute();

        mysqli_close($mysqli);
    }
    
    function UpdateLabel(LabelEntity $label)
    {
        require 'Credentials.php';
        
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "UPDATE label SET name=? WHERE id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("si", $label->name, $label->id);
        $stmt->execute();
        
        mysqli_close($mysqli);
    }
    
    function DeleteLabel($id)
    {
        require 'Credentials.php';

        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "DELETE FROM label WHERE id =?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        mysqli_close($mysqli);
    }
}