<?php

require 'Controller/ItemController.php';

$itemcontroller = new ItemController();

if(isset($_GET['delete']))
{
    $itemcontroller->DeleteItem($_GET['delete']);
}

$page = 'itemoverview'; 
$title = 'itemoverview';
$content = '<a href="item_newedit.php" class="message-small button-admin">New item</a>'
        . '</br>'
        . '</br>'
        . $itemcontroller->CreateItemOverviewAdmin()
        . '</br>';

include 'template_admin.php';

 
         