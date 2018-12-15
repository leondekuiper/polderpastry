<?php

require 'Controller/ItemController.php';

$itemcontroller = new ItemController();

$page = 'itemoverview'; 
$title = 'itemoverview';
$content = '<a href="item_newedit.php" class=message-small>New item</a>'
        . '<a href="imageupload.php" class=message-small>Upload Image</a>'
        . '</br>'
        . '</br>'
        . $itemcontroller->CreateItemOverview()
        . '</br>';

include 'template_admin.php';

 
         