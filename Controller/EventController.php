<?php

require ("Model/EventModel.php");

class EventController 
{
    function CreateEventTables($active)
    {
        $eventModel = new EventModel();
        $eventArray = $eventModel->GetEventListByActive($active);
        $result = "";
        
        foreach ($eventArray as $event)
        {
            $result = $result .
                    "<li class='event'>
                        <img class = 'thumbnail' runat = 'server' src ='$event->image' width='320' height='240'/>
                        <span class = 'description'>
                            <h3 class = 'title'>$event->name</h3>
                            <p class = 'text'>$event->description</p>
                        </span>
                    </li>";
        }
        return $result;
    }
}