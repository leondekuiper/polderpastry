<?php

require 'Controller/TypeController.php';
require 'Controller/GenericController.php';

$typeController = new TypeController();
$genericController = new GenericController();

$page = 'NewEdit Type';
$title = 'NewEdit Type';

if(isset($_GET["edit"]))
{
    $type = $typeController->GetTypeById($_GET["edit"]);
    $name = $type->name;
}

else {
    $name = '';
}

$content = "
    <a href='typeoverview.php' class='message-small button-admin'>back to Overview</a>
    </br>
    <form class= 'newedit-form' method='post' action=''>
        <fieldset>
            <legend>New/Edit Type</legend>
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
        $typeController->UpdateType($_GET["edit"]);
        header("Location: typeoverview.php");
        exit;
    }
}
else
{
    if (isset($_POST["txtName"]))
    {
        $typeController->CreateType();
        header("Location: typeoverview.php");
        exit;
    }
}

include 'template_admin.php';
