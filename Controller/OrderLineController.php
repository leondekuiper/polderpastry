<?php

require_once ("Model/OrderLineModel.php");

class OrderLineController 
{
    function CreateOrderLines($itemArray, $orderID)
    {
        $orderLineArray = array();
	foreach ($itemArray as $item) 
        {
            $amountstring = 'aantal_' . $item->id;
            if (isset($_POST[$amountstring]) && $_POST[$amountstring] > 0) 
            {
                $orderline = CreateOrderLine($item, $_POST[$amountstring], $orderID);
                array_push($orderLineArray, $orderLine);
            }
	}
        return $orderLineArray;         
    }
    
    function CreateOrderLine(ItemEntity $item, $amount, $orderID)
    {
        $lineTotal = floatval($item->price) * intval($amount);
        $VAT = round($lineTotal / 109 * 9, 2);
        $totalNoVAT = $lineTotal-$VAT;        
        $orderLine = new orderEntity('', $orderID, $item->id, $amount, $totalNoVAT, $lineTotal);
        $orderLineModel = new OrderLineModel();
        $orderLineModel->CreateOrderLine($orderLine);        
        return $orderline;
    }
    
    function GetOrderLinesByOrderID($id)
    {
        $orderLineModel = new OrderLineModel();
        return $orderLineModel->GetOrderLinesByOrderID($id);        
    }
    
    
}

