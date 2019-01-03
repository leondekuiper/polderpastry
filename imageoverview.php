<?php

require 'Controller/ItemController.php';

$imagecontroller = new ImageController();

$page = 'imageoverview'; 
$title = 'imageoverview';
$content = '<a href="neweditimage.php" class=message-small>New Image</a></br>'
        . '</br>'
        . $imagecontroller->CreateImageOverview()
        . '</br>';

include 'template_admin.php';

 
         