<?php

require ("Entities/EventEntity.php");

class EventModel 
{
    function GetEventTypes()
    {
        require 'Credentials.php';
        
        $link = mysqli_connect($host,$user,$password,$database);
        $query = "SELECT DISTINCT type FROM Event";
        $result = mysqli_query($link,$query);
        $types = array();
        
        while($row = mysqli_fetch_array($result))
        {
            array_push($types, $row[0]);
        }
        mysqli_close($link);
        return $types;
    }
    
    function GetEventByType($type)
    {
        require 'Credentials.php';
     
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "SELECT * FROM Event WHERE type LIKE ? AND isActive LIKE ?";
        $stmt = $mysqli->prepare($query);
        $yes = "Yes";
        $stmt->bind_param("ss", $type, $yes);
        $stmt->execute();
        $stmt->bind_result($id, $name, $description, $price, $type, $minimumOrder, $notused, $image);
        $EventArray = array();

        while($stmt->fetch())
        {
            $Event = new EventEntity($id, $name, $type, $price, $description, $image, $minimumOrder);
            array_push($EventArray, $Event);
        }    
        mysqli_close($mysqli);
        return $EventArray;
    }
    
    function GetEventByID($EventId)
    {
        require 'Credentials.php';
     
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "SELECT * FROM Event WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $EventId);
        $stmt->execute();
        $stmt->bind_result($id, $name, $description, $price, $type, $minimumOrder, $notused, $image);

        while($stmt->fetch())
        {
            $Event = new EventEntity($id, $name, $type, $price, $description, $image, $minimumOrder);
        }    
        mysqli_close($mysqli);
        return $Event;        
    }
    
    function InsertEvent(EventEntity $Event)
    {
        require 'Credentials.php';
        
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "INSERT INTO Event (name, description, price, type, minimumOrder, isActive, image) VALUES (?,?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $imageURL = "Images/". mysqli_real_escape_string($Event->image);  
        $stmt->bind_param("sssssss", $Event->name, $Event->description, $Event->price, $Event->type, $Event->minimumOrder, $Event->isActive, $imageURL);
        $stmt->execute();
        
        mysqli_close($mysqli);
    }
    
    function UpdateEvent($id, EventController $Event)
    {
        require 'Credentials.php';
        
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "UPDATE Event SET name=? description=? price=? type? minimumOrder=? isActive=? image=? WHERE id=?";
        $stmt = $mysqli->prepare($query);
        $imageURL = "Images/". mysqli_real_escape_string($Event->image);         
        $stmt->bind_param("sssssssi", $Event->name, $Event->description, $Event->price, $Event->type, $Event->minimumOrder, $Event->isActive, $imageURL, $Event->id);
        $stmt->execute();
        
        mysqli_close($mysqli);
    }
    
    function DropEvent($id)
    {
        require 'Credentials.php';

        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "DELETE from Event WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        mysqli_close($mysqli);
    }
}
