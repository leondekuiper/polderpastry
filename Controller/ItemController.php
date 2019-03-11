<?php

require ('Model/ItemModel.php');

class ItemController 
{
    function CreateItemOverviewAdmin()
    {
        $result = 
            "<table class ='overview-table'>"
            . "<tr class = 'table-header'>"
                . "<td>Position</td>"
                . "<td>Name</td>"
                . "<td>Price</td>"
                . "<td>Type</td>"
                . "<td>Minimum</td>"
                . "<td>Active</td>"
                . "<td>ImageURL</td>"
                . "<td></td>"
                . "<td></td>"
            . "</tr>";

        $itemArray = $this->GetItemAll();
        $URL = "itemoverview";
        
        foreach ($itemArray as $item)
        {
            $result = $result
                . "<tr>"
                    . "<td>$item->position</td>"
                    . "<td>$item->name</td>"
                    . "<td>$item->price</td>"
                    . "<td>$item->type</td>"
                    . "<td>$item->minimumOrder</td>"                    
                    . "<td>$item->isActive</td>"
                    . "<td>$item->image</td>"
                    . "<td><a href='item_newedit.php?edit=$item->id' class='overview-link'>Edit</a></td>"
                    . "<td><a href='#' onclick='ShowConfirmation(\"$URL\", $item->id)' class='overview-link'>Delete</a></td>"
                . "</tr>";
        };
        $result = $result . "</table>";
        
        return $result;
    }
    
    function CreateItemOverviewAssortment($types)
    {
        $itemModel = new ItemModel();
        $itemArray = $itemModel->GetItemByType($types);
        $result = "";
        
        foreach ($itemArray as $item)
        {
            $price = number_format((float)$item->price, 2, ',', '');
            $result = $result .
                "<li class='item'>
                    <img class = 'thumbnail' runat = 'server' src ='$item->image' width='320' height='240'/>
                    <span class = 'description'>
                        <h3 class = 'title'>$item->name</h3>
                        <h3 class = 'price' id='prijs_$item->id'>€ $price</h3>
                        <p class = 'text'>$item->description</p>
                        <ul class= 'tags'>
                        Label placeholder
                        </ul>
                        <p class = 'order'>
                            <input id='input_$item->id' type = 'number' name = 'item-amount' value = '$item->minimumOrder' class = 'item-amount' min = '$item->minimumOrder'>
                            <button data-id ='$item->id' class = 'add-to-cart'>Voeg Toe</button>
                        </p>
                    </span>
                    <div id = 'aantal_$item->id' class = 'shop-amount item-shop-amount'/>
                </li>";
        }
        return $result;
    }
            
    function CreateItemOverviewShoppingCart ()
    {
        $order = json_decode($_GET['o']);
        $itemModel = new ItemModel();
        $itemArray = $itemModel->GetItemByType('%');
        $totalItemPrice = 0;
        $totalPrice = 0;
        $result = '<table class = order-table>
                    <tr>
                        <th>Naam</th>
                        <th style= "text-align: center">Prijs €</th>
                        <th>Aantal</th>
                        <th id = "totaal">Totaal</th>
                    </tr>';
        foreach ($order as $id => $amount)
        {
            foreach ($itemArray as $item)
            {
                if ($item->id == $id && $amount > 0)
                { 
                    $itemPrice =  floatval($item->price * intval($amount));
                    $price = number_format($item->price,2);
                    $totalPrice += $itemPrice;
                    $result = $result . "<tr>
                    <td>$item->name</td>
                    <td style= 'text-align:center' id='prijs_$item->id'>$price</td>
                    <td><input class = 'item-amount-basket' id='input_$item->id' onChange='addValToCart($item->id,this.value,$item->price)' type='number' name = 'aantal_$item->id' min='$item->minimumOrder'></td>
                    <td class='rowTotal' id='totaal_$item->id'>NNB</td>
                    </tr>";
                }
            }
        }
        $deliveryFee = 2.50;
        $VAT = round($totalPrice / 109 * 9, 2);
        $subtotalPrice = $totalPrice - $VAT;
        $totalPrice = $totalPrice + $deliveryFee;
        $result = $result . "<tr><td id = 'heightfilling-20px'></td><td></td><td></td></tr>
        <tr><td></td><td></td><td>Excl. BTW:</td><td id='subtotalPrice'>$subtotalPrice</td></tr>
        <tr><td></td><td></td><td>BTW (9%):</td><td id='vat'>$VAT</td></tr>
        <tr><td></td><td></td><td>Bezorgkosten:</td><td id='deliveryFee'>$deliveryFee</td></tr>
        <tr><td></td><td></td><td>Totaal:</td><td id='totalPrice'>$totalPrice</td></tr></table>";
        return $result;
    }
    
    function CreateItem()
    {
        $name = $_POST["txtName"];
        $description = $_POST["txtDescription"];  
        $price = $_POST["txtPrice"];         
        $type = $_POST["dslType"];                
        $minimumOrder = $_POST["txtMinimumOrder"];              
        $image = $_POST["dslImage"];
        $position = $_POST["txtPosition"];
        if (isset($_POST["isActive"])) {
            $isActive = 1;
        }
        else {
            $isActive = 0;
        }
        $item = new ItemEntity('', $name, $description, $price, $type, $minimumOrder , $isActive , $image, $position);
        $itemModel = new ItemModel();
        $itemModel->CreateItem($item);
    }
    
    function UpdateItem($id)
    {
        $name = $_POST["txtName"];
        $description = $_POST["txtDescription"];  
        $price = $_POST["txtPrice"];         
        $type = $_POST["dslType"];                
        $minimumOrder = $_POST["txtMinimumOrder"];
        $image = $_POST["dslImage"];
        $position = $_POST["txtPosition"];
        if (isset($_POST["isActive"])) {
            $isActive = 1;
        }
        else {
            $isActive = 0;
        }

        $item = new ItemEntity($id, $name, $description, $price, $type, $minimumOrder , $isActive , $image, $position);
        $itemModel = new ItemModel();
        $itemModel->UpdateItem($item);
    }
    
    function DeleteItem($id)
    {
        $itemmodel = new ItemModel();
        $itemmodel->DeleteItem($id);
    }
    
    function GetItemById($id)
    {
        $itemModel = new ItemModel();
        return $itemModel->GetItemByID($id);
    }

    function GetItemAll()
    {
        $itemModel = new ItemModel();
        return $itemModel->GetItemAll();        
    }    
    
    function GetItemTypes()
    {
        $itemModel = new ItemModel();
        return $itemModel->GetItemTypes();     
    }
}