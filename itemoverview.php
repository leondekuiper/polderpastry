<?php

require 'Controller/ItemController.php';

$itemcontroller = new ItemController();

$page = 'itemoverview'; 
$title = 'itemoverview';
$content = '<a href="item_newedit.php" class="message-small button-admin">New item</a>'
        . '</br>'
        . '</br>'
        . $itemcontroller->CreateItemOverviewAdmin()
        . '</br>';

if(isset($_GET['delete']))
{
    $itemcontroller->DeleteItem($_GET['delete']);
}

include 'template_admin.php';

 
         