<?php

require 'Controller/ItemController.php';

$itemcontroller = new ItemController();

$page = 'itemoverview'; 
$title = 'itemoverview';
$content = '<a href="newedititem.php" class=message-small>New item</a></br>'
        . '</br>'
        . $itemcontroller->CreateOverview()
        . '</br>';

include 'template_admin.php';