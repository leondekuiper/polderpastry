<?php

require 'Controller/ItemController.php';
require 'Controller/ImageController.php';
require 'Controller/GenericController.php';

$itemController = new ItemController();
$imageController = new ImageController();
$genericController = new GenericController();

$page = 'NewEdit Item';
$title = 'NewEdit Item';

if(isset($_GET["edit"]))
{
    $item = $itemController->GetItemById($_GET["edit"]);
    $name = $item->name;
    $type = $item->type;
    $price = $item->price;
    $description = $item->description;
    $image = $item->image;
    $minimumOrder = $item->minimumOrder;
    $position = $item->position;
    if ($item->isActive === 1)
    {
        $isActive = "checked = 'checked'";
    }
    else
    {
        $isActive = "";
    }
}

else {
    $name = '';
    $type = '';
    $price = '';
    $description = '';
    $image = '';
    $minimumOrder = '';
    $position = '';
    $isActive = "checked = 'checked'";
}

$content = "
    <a href='itemoverview.php' class='message-small button-admin'>back to Overview</a>
    </br>
    <form class= 'newedit-form' method='post' action=''>
        <fieldset>
            <legend>New/Edit Item</legend>

            <img class='thumbnail-admin' runat='server' src ='$image' id='image-thumbnail' width='320' height='240'/>

            <label for='name'>Name:</label>
            <input value = '$name' type='text' class='newedit-inputfield' name ='txtName' />
            <br/>
            <label for='type'>Type:</label>
            <select class='newedit-inputfield' name ='dslType'>"
            . "<option value=''> </option>"
            . $genericController->CreateDropdown($itemController->GetItemTypes(), $type) ."</select>
            <br/>
            <label for='price'>Price:</label>
            <input value = '$price' type='text' class='newedit-inputfield' name ='txtPrice' />
            <br/>        
            <label for='description'>Description:</label>
            <textarea cols='70' rows='10' class='newedit-inputfield' name ='txtDescription'>$description</textarea>
            <br/>
            <label for='image'>Image:</label>
            <select class='newedit-inputfield' name ='dslImage' onChange='ChangeImage(this.value)'>"
            . "<option value=''> </option>"
            . $genericController->CreateDropdown($imageController->GetImages(), substr($image, 7)) . "</select>
            <br/>        
            <label for='minimumorder'>Minimum Order:</label>
            <input value = '$minimumOrder' type='text' class='newedit-inputfield' name ='txtMinimumOrder' />
            <br/>
            <label for='position'>Position:</label>
            <input value = '$position' type='text' class='newedit-inputfield' name ='txtPosition' />
            <br/>       
            <label for='isActive'>Active:</label>
            <input type='checkbox' class='newedit-inputfield checkbox' value='1' name='isActive' $isActive/>
            <br/>     
            <input type='submit' value='Save' class='button-save'>
        </fieldset>
    </form>";

if (isset($_GET["edit"]))
{
    if (isset($_POST["txtName"]))
    {
        $itemController->UpdateItem($_GET["edit"]);
        header("Location: itemoverview.php");
        exit;
    }
}
else
{
    if (isset($_POST["txtName"]))
    {
        $itemController->CreateItem();
        header("Location: itemoverview.php");
        exit;
    }
}

include 'template_admin.php';
