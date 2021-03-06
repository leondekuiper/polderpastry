<?php

require_once ("Entities/TypeEntity.php");
require_once ("Credentials.php");

class TypeModel
{
    function GetTypeAll()
    {
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "SELECT * FROM type ORDER BY name ASC";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $name);
        $typeArray = array();

        while($stmt->fetch())
        {
            $type = new TypeEntity($id, $name);
            array_push($typeArray, $type);
        }    
        mysqli_close($mysqli);
        return $typeArray;
    }

    function GetTypeByID($typeId)
    {
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "SELECT * FROM type WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $typeId);
        $stmt->execute();
        $stmt->bind_result($id, $name);

        while($stmt->fetch())
        {
            $type = new TypeEntity($id, $name);
        }    
        mysqli_close($mysqli);
        return $type;
    }
    
    function CreateType(TypeEntity $type)
    {
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "INSERT INTO type (name) VALUES (?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $type->name);
        $stmt->execute();

        mysqli_close($mysqli);
    }
    
    function UpdateType(TypeEntity $type)
    {
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "UPDATE type SET name=? WHERE id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("si", $type->name, $type->id);
        $stmt->execute();
        
        mysqli_close($mysqli);
    }
    
    function DeleteType($id)
    {
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "DELETE FROM type WHERE id =?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        mysqli_close($mysqli);
    }
}