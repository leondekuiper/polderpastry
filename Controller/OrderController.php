<?php

require_once ("Model/OrderModel.php");
require_once ("Model/GenericModel.php");

class OrderController 
{
    function CreateOrderOverviewAdmin($orderArray, $personArray)
    {
        $GenericModel = new GenericModel();        
        $result = 
            "<table class ='overview-table'>"
            . "<tr class = 'table-header'>"
                . "<td>Order Date</td>"
                . "<td>Delivery Date</td>"
                . "<td>Comment</td>"
                . "<td>Delivery</td>"
                . "<td>Person</td>"
                . "<td>Adres</td>"
                . "<td>Excl. VAT</td>"
                . "<td>Total Price</td>"
                . "<td></td>"
                . "<td></td>"
            . "</tr>";

        $URL = "orderoverview";
        
        foreach ($orderArray as $order)
        {
            $person = $GenericModel->GetObjectFromArray($personArray, $order->PersonID);
            $result = $result
                . "<tr>"
                    . "<td>$order->orderDate</td>"
                    . "<td>$order->deliveryDate</td>"
                    . "<td>$order->comment</td>"
                    . "<td>$order->delivery</td>"
                    . "<td>$person->name</td>"                    
                    . "<td>$person->Street" . ", $person->Zipcode" . ", $person->City</td>"
                    . "<td>$order->totalNoVAT</td>"
                    . "<td>$order->orderTotal</td>"
                    . "<td><a href='order_view.php?edit=$order->id' class='overview-link'>Details</a></td>"
                . "</tr>";
        };
        $result = $result . "</table>";
        
        return $result;
    }
    
    function CreateOrder()
    {
        $delivery = 0;
        if($_POST['bezorgen'])
        {
            $delivery = 1;
        };
        //asdf
        //asdf
        //, date('Y/m/d'), $_POST['bezorgdag'], $_POST['opmerking'], $delivery        
        return $order;
    }

    function UpdateOrder()
    {
        
    }
    
    function CreateOrderTable($orderLineArray, $itemArray)
    {
        $GenericModel = new GenericModel();
        
        $orderTable = "<table class = order-table><tr><th style='text-align:left;'>Naam:</th><th style='text-align:left;'>Prijs:</th><th style='text-align:left;'>Aantal:</th><th style='text-align:left;'>Totaal:</th></tr>";
	$totalPrice = 0;
        $deliveryFee = 0;
        if($_POST['bezorgen'])
        {
            $deliveryFee = 2.50;
        };
        
	foreach ($orderLineArray as $orderLine)
        {
            $item = $GenericModel->GetObjectFromArray($itemArray, $orderline->ItemID);
            $itemPrice = floatval($item->price) * intval($orderLine->amount);
            $totalPrice += $itemPrice;
            $orderTable .= "<tr><td style='padding-right:24px;'>$item->name</td>
            <td style='padding-right:24px;'>€ $item->price</td>
            <td style='padding-right:24px;'>$orderLine->amount</td>
            <td style='padding-right:24px;'>€ $itemPrice</td></tr>";
        }

	$VAT = round($totalPrice / 109 * 9, 2);
	$subtotalPrice = $totalPrice - $VAT;
	$orderTable .= "<tr><td></td><td></td><td style='padding-right:24px;'>Excl. BTW:</td><td>€ $subtotalPrice</td></tr>
	<tr><td></td><td></td><td>BTW (9%):</td><td>€ $VAT</td></tr>
        <tr><td></td><td></td><td>Bezorgkosten:</td><td id='deliveryFee'>$deliveryFee</td></tr>    
	<tr><td></td><td></td><td>Totaal:</td><td>€ $totalPrice</td></tr></table>";
        return $orderTable;
    }
}

