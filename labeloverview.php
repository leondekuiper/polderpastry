<?php

require 'Controller/LabelController.php';

$labelController = new LabelController();

if(isset($_GET['delete']))
{
    $labelController->DeleteLabel($_GET['delete']);
}

$page = 'labeloverview'; 
$title = 'labeloverview';
$content = '<a href="label_newedit.php" class="message-small button-admin">New label</a>'
        . '</br>'
        . '</br>'
        . $labelController->CreateLabelOverviewAdmin()
        . '</br>';

include 'template_admin.php';