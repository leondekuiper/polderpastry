<?php

require ("Model/EventModel.php");

class EventController 
{
    function CreateEventOverviewAdmin()
    {
        $result = 
            "<table class ='overview-table'>"
            . "<tr class = 'table-header'>"
                . "<td>Name</td>"
                . "<td>Description</td>"
                . "<td>Active</td>"
                . "<td>ImageURL</td>"
                . "<td></td>"
                . "<td></td>"
            . "</tr>";

        $eventArray = $this->GetEventAll();
        $EventModel = new EventModel();
        $URL = "eventoverview";
        
        foreach ($eventArray as $event)
        {
            $result = $result
                . "<tr>"
                    . "<td>$event->name</td>"
                    . "<td>$event->description</td>"
                    . "<td>$event->isActive</td>"
                    . "<td>$event->image</td>"              
                    . "<td><a href='event_newedit.php?edit=$event->id' class='overview-link'>Edit</a></td>"
                    . "<td><a href='#' onclick='ShowConfirmation(\"$URL\",$event->id)' class='overview-link'>Delete</a></td>"
                . "</tr>";
        };
        $result = $result . "</table>";     
        
        return $result;
    }
    
    function GetEventAll()
    {
        $eventModel = new EventModel();
        return $eventModel->GetEventAll();        
    } 

    function GetEventById($id)
    {
        $eventModel = new EventModel();
        return $eventModel->GetEventByID($id);
    }
    
    function CreateEvent()
    {
        $name = $_POST["txtName"];
        $description = $_POST["txtDescription"];
        $image = $_POST["dslImage"];
        if (isset($_POST["isActive"])) {
            $isActive = 1;
        }
        else {
            $isActive = 0;
        }
        
        $event = new EventEntity('', $name, $description, $image, $isActive);
        $eventModel = new EventModel();
        $eventModel->CreateEvent($event);
    } 
    
    function UpdateEvent($id)
    {
        $name = $_POST["txtName"];
        $description = $_POST["txtDescription"];
        $image = $_POST["dslImage"];
        if (isset($_POST["isActive"])) {
            $isActive = 1;
        }
        else {
            $isActive = 0;
        }

        $event = new EventEntity($id, $name, $description, $image, $isActive);
        $eventModel = new EventModel();
        $eventModel->UpdateEvent($event);
    }
    
    function DeleteEvent($id)
    {
        $eventModel = new EventModel();
        $eventModel->DeleteEvent($id);
    }
}