<?php

require 'Controller/OrderController.php';

$itemController = new OrderController();

$page = 'itemoverview'; 
$title = 'itemoverview';
$content = '<a href="newedititem.php" class=message-small>New item</a></br>'
        . '</br>'
        . $orderController->CreateOrderOverviewAdmin()
        . '</br>';

include 'template_admin.php';

 
         