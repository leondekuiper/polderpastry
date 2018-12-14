<?php 

require 'Controller/ItemController.php';
$itemController = new ItemController();

if(isset($_POST['types']))
{
    $itemTables = $itemController->CreateItemTables($_POST['types']);
}
else
{
    $itemTables = $itemController->CreateItemTables('%');
}

$page = 'assortiment'; 
$title = 'assortiment';
$content = $itemController->CreateItemDropdown() . '<ul>' . $itemTables . '</ul>';

include 'template.php';