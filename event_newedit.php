<?php

require 'Controller/EventController.php';
require 'Controller/ImageController.php';
require 'Controller/GenericController.php';

$eventController = new EventController();
$imageController = new ImageController();
$genericController = new GenericController();

$page = 'NewEdit Event';
$title = 'NewEdit Event';

if(isset($_GET["edit"]))
{
    $event = $eventController->GetEventById($_GET["edit"]);
    $name = $event->name;
    $description = $event->description;
    $image = $event->image;
    if ($event->isActive === 1)
    {
        $isActive = "checked = 'checked'";
    }
    else
    {
        $isActive = "";
    }
}

else {
    $name = '';
    $description = '';
    $image = '';
    $isActive = "checked = 'checked'";
}

$content = "
    <a href='eventoverview.php' class='message-small button-admin'>back to Overview</a>
    </br>
    <form class= 'newedit-form' method='post' action=''>
        <fieldset>
            <legend>New/Edit Event</legend>
            <img class='thumbnail-admin' runat='server' src ='$image' id='image-thumbnail' width='320' height='240'/>
                
            <label for='name'>Name:</label>
            <input value = '$name' type='text' class='newedit-inputfield' name ='txtName' />
            <br/>
            <label for='description'>Description:</label>
            <textarea cols='70' rows='10' class='newedit-inputfield' name ='txtDescription'>$description</textarea>
            <br/>
            <label for='image'>Image:</label>
            <select class='newedit-inputfield' name ='dslImage' onChange='ChangeImage(this.value)'>"
            . "<option value=''> </option>"
            . $genericController->CreateDropdown($imageController->GetImages(), substr($image, 7)) . "</select>
            <br/>
            <label for='isActive'>Active:</label>
            <input type='checkbox' class='newedit-inputfield checkbox' value='1' name='isActive' $isActive/>
            <br/>
            <input type='submit' value='Save' class='button-save'>
        </fieldset>
    </form>";

if (isset($_GET["edit"]))
{
    if (isset($_POST["txtName"]))
    {
        $eventController->UpdateEvent($_GET["edit"]);
        header("Location: eventoverview.php");
        exit;
    }
}
else
{
    if (isset($_POST["txtName"]))
    {
        $eventController->CreateEvent();
        header("Location: eventoverview.php");
        exit;
    }
}

include 'template_admin.php';
