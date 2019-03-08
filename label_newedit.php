<?php

require 'Controller/LabelController.php';
require 'Controller/GenericController.php';

$page = 'NewEdit Label';
$title = 'NewEdit Label';

if(isset($_GET["edit"]))
{
    $label = $LabelController->GetLabelById($_GET["edit"]);
    $name = $label->name;
}

else {
    $name = '';
}

$content = "
    <a href='labeloverview.php' class='message-small button-admin'>back to Overview</a>
    </br>
    <form class= 'newedit-form' method='post' action=''>
        <fieldset>
            <legend>New/Edit Label</legend>
            <label for='name'>Name:</label>
            <input value = '$name' type='text' class='newedit-inputfield' name ='txtName' />
            <br/>
            <input type='submit' value='Save' class='button-save'>
        </fieldset>
    </form>";

if (isset($_GET["edit"]))
{
    if (isset($_POST["txtName"]))
    {
        $labelController->UpdateLabel($_GET["edit"]);
        header("Location: labeloverview.php");
        exit;
    }
}
else
{
    if (isset($_POST["txtName"]))
    {
        $labelController->CreateLabel();
        header("Location: labeloverview.php");
        exit;
    }
}

include 'template_admin.php';
