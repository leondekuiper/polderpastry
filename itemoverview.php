<?php

require 'Controller/ItemController.php';

$itemcontroller = new ItemController();

$page = 'itemoverview'; 
$title = 'itemoverview';
$content = '<a href="item_newedit.php" class=message-small style="padding-right: 20px;" >New item</a>'
        . '<a href="imageupload.php" class=message-small>Upload Image</a>'
        . '</br>'
        . '</br>'
        . $itemcontroller->CreateItemOverview()
        . '</br>';

if(isset($_GET['delete']))
{
    $itemcontroller->DeleteItem($_GET['delete']);
}

include 'template_admin.php';

 
         