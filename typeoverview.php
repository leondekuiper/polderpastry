<?php

require 'Controller/TypeController.php';

$typeController = new TypeController();

if(isset($_GET['delete']))
{
    $typeController->DeleteType($_GET['delete']);
}

$page = 'typeoverview'; 
$title = 'typeoverview';
$content = '<a href="type_newedit.php" class="message-small button-admin">New type</a>'
        . '</br>'
        . '</br>'
        . $typeController->CreateTypeOverviewAdmin()
        . '</br>';

include 'template_admin.php';

 
         