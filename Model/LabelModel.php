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
            $item = new LabelEntity($id, $name);
        }    
        mysqli_close($mysqli);
        return $item;
    }
    
    function CreateLabel(LabelEntity $label)
    {
        require 'Credentials.php';
        
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "INSERT INTO item(name, description, price, type, minimumOrder, isActive, image, position) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $imageURL = "Images/". mysqli_real_escape_string($mysqli, $item->image);  
        $stmt->bind_param("ssdsiiss", $item->name, $item->description, $item->price, $item->type, $item->minimumOrder, $item->isActive, $imageURL, $item->position);
        $stmt->execute();

        mysqli_close($mysqli);
    }
    
    function UpdateItem(LabelEntity $label)
    {
        require 'Credentials.php';
        
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "UPDATE item SET name=?, description=?, price=?, type=?, minimumOrder=?, isActive=?, image=?, position=? WHERE id=?";
        $stmt = $mysqli->prepare($query);
        $imageURL = "Images/". mysqli_real_escape_string($mysqli, $item->image);         
        $stmt->bind_param("ssdsiissi", $item->name, $item->description, $item->price, $item->type, $item->minimumOrder, $item->isActive, $imageURL, $item->position, $item->id);
        $stmt->execute();
        
        mysqli_close($mysqli);
    }
    
    function DeleteLabel($id)
    {
        require 'Credentials.php';

        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "DELETE FROM item WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        mysqli_close($mysqli);
    }
}