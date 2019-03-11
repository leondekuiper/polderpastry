<?php

require_once ("Entities/OrderLineEntity.php");
require_once ("Credentials.php");

class OrderLineModel 
{
    function CreateOrderLine(orderLineEntity $orderLine)
    {
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "INSERT INTO orderLine (orderID, itemID, amount, totalNoVAT, lineTotal) VALUES (?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("iiidd", $orderLine->orderID, $orderLine->itemID, $orderLine->amount, $orderLine->totalNoVAT, $orderLine->lineTotal);
        $stmt->execute();
        mysqli_close($mysqli);      
    }    
    
    function GetOrderLinesByOrderID($orderId)
    {
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "SELECT * FROM orderLine WHERE orderID = ? ORDER BY itemID ASC";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $stmt->bind_result($id, $orderID, $itemID, $amount, $totalNoVAT, $lineTotal);
        $orderLineArray = array();

        while($stmt->fetch())
        {
            $orderLine = new orderEntity($id, $orderID, $itemID, $amount, $totalNoVAT, $lineTotal);
            array_push($orderLineArray, $orderLine);
        }    
        mysqli_close($mysqli);
        return $orderLineArray;        
    }
}
