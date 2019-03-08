<?php

require 'Controller/EventController.php';

$eventController = new EventController();

if(isset($_GET['delete']))
{
    $eventController->DeleteEvent($_GET['delete']);
}

$page = 'eventoverview'; 
$title = 'eventoverview';
$content = '<a href="event_newedit.php" class="message-small button-admin">New Event</a>'
        . '</br>'
        . '</br>'
        . $eventController->CreateEventOverviewAdmin()
        . '</br>';

include 'template_admin.php';

 
         