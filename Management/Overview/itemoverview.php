<?php

require '/PolderPastry/Controller/ItemController.php';

$itemcontroller = new ItemController();

$page = 'itemoverview'; 
$title = 'itemoverview';
$content = '<a href="newedititem.php" class=message-small>New item</a></br>'
        . '</br>'
        . $itemcontroller->CreateItemOverview()
        . '</br>';

include 'template_admin.php';

 
         