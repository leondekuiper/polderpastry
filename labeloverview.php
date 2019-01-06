<?php

require 'Controller/LabelController.php';

$labelcontroller = new LabelController();

$page = 'labeloverview'; 
$title = 'labeloverview';
$content = '<a href="label_newedit.php" class="message-small button-admin">New label</a>'
        . '</br>'
        . '</br>'
        . $labelcontroller->CreateLabelOverview()
        . '</br>';

if(isset($_GET['delete']))
{
    $labelcontroller->DeleteLabel($_GET['delete']);
}

include 'template_admin.php';