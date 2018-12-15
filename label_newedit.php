<?php

require 'Controller/ItemController.php';
$itemController = new ItemController();

$page = 'NewEdit Item';
$title = 'NewEdit Item';
$content = "
    <a href='itemoverview.php' class=message-small>back to Overview</a>
    </br>
    <form class= newedit-form action = '' method='post'>
    <fieldset >
        <legend>New/Edit Item</legend>
        
        <label for='name'>Name:</label>
        <input type='text' class='newedit-inputfield' name ='txtName' /><br/>
        
        <label for='type'>Type:</label>
        <select class='newedit-inputfield' name ='dslType'>
            <option value='%'>All</option>"
        . $itemController->CreateItemValues($itemController->GetItemTypes()) .
        "</select><br/>
        
        <label for='price'>Price:</label>
        <input type='text' class='newedit-inputfield' name ='txtPrice' /><br/>        
        
        <label for='description'>Description:</label>
        <textarea cols='70' rows='10' class='newedit-inputfield' name ='txtDescription'></textarea><br/>

        <label for='image'>Image:</label>
        <select class='newedit-inputfield' name ='dslImage'>"
        . $itemController->GetImages() . 
        "</select><br/>        
        
        <label for='minimumorder'>Minimum Order:</label>
        <input type='text' class='newedit-inputfield' name ='txtMinimumOrder' /><br/>
        
        <label for='isActive'>Actief:</label>
        <input type='checkbox' class='newedit-inputfield' name='isActive'/>
        
        <input type='submit' value='Save'>
    </fieldset>
</form>";  

if (isset($_POST["txtName"]))
{
    $itemController->CreateItem();
}

include 'template_admin.php';
