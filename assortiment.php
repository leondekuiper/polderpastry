<?php 

require 'Controller/ItemController.php';
require 'Controller/GenericController.php';

$genericController = new GenericController();
$itemController = new ItemController();

if(isset($_POST['types']))
{
    $itemTables = $itemController->CreateItemOverviewAssortment($_POST['types']);
}
else
{
    $itemTables = $itemController->CreateItemOverviewAssortment('%');
}

$page = 'assortiment'; 
$title = 'assortiment';
$content = "<form action = '' method = 'post' width = '200px'>"
                . "Pastry type:"
                    . "<select name = 'types' >"
                        . "<option selected = 'selected' value = '%'>Alle</option>"
                        . $genericController->CreateDropdown($itemController->GetItemTypes(), '')
                    . "</select>"
                . "<input type = 'submit' value = 'Search' />
            </form>" 
            . "<ul>" 
            . $itemTables 
            . "</ul>";

include 'template.php';