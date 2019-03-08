<?php

require ("Entities/EventEntity.php");

class EventModel
{
    function GetEventAll()
    {
        require 'Credentials.php';
     
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "SELECT * FROM event ORDER BY name ASC";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $name, $description, $image, $isActive);
        $eventArray = array();

        while($stmt->fetch())
        {
            $event = new EventEntity($id, $name, $description, $image, $isActive);
            array_push($eventArray, $event);
        }    
        mysqli_close($mysqli);
        return $eventArray;
    }
    
    function GetEventByID($eventId)
    {
        require 'Credentials.php';
     
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "SELECT * FROM event WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $eventId);
        $stmt->execute();
        $stmt->bind_result($id, $name, $description, $image, $isActive);

        while($stmt->fetch())
        {
            $event = new EventEntity($id, $name, $description, $image, $isActive);
        }    
        mysqli_close($mysqli);
        return $event;
    }
    
    function CreateEvent(EventEntity $event)
    {
        require 'Credentials.php';
        
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "INSERT INTO event(name, description, imageURL, isActive) VALUES (?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $imageURL = "Images/". mysqli_real_escape_string($mysqli, $event->image);
        $stmt->bind_param("sssi", $event->name, $event->description, $imageURL, $event->isActive);
        $stmt->execute();

        mysqli_close($mysqli);
    }
    
    function UpdateEvent(EventEntity $event)
    {
        require 'Credentials.php';
        
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "UPDATE event SET name=?, description=?, imageURL=?, isActive=? WHERE id=?";
        $stmt = $mysqli->prepare($query);
        $imageURL = "Images/". mysqli_real_escape_string($mysqli, $event->image);
        $stmt->bind_param("sssii", $event->name, $event->description, $imageURL, $event->isActive, $event->id);
        $stmt->execute();
        
        mysqli_close($mysqli);
    }
    
    function DeleteEvent($id)
    {
        require 'Credentials.php';

        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "DELETE FROM event WHERE id =?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        mysqli_close($mysqli);
    }
}

