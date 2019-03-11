<?php

require_once ("Entities/OrderEntity.php");
require_once ("Credentials.php");

class OrderModel 
{
    function CreateOrder(orderEntity $order)
    {
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "INSERT INTO order (orderDate, deliveryDate, comment, delivery, personID, totalNoVAT, orderTotal) VALUES (?,?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sssiidd", $order->orderDate, $order->deliveryDate, $order->comment, $order->delivery, $order->personID, $order->totalNoVAT, $order->orderTotal);
        $stmt->execute();
        $id = mysql_insert_id($mysqli);
        mysqli_close($mysqli);
        return $id;        
    }
    
    function UpdateOrder(orderEntity $order)
    {
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "UPDATE order SET orderDate =? deliveryDate=? comment=? delivery=? personID=? totalNoVAT=? orderTotal=? WHERE id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sssiidd", $order->orderDate, $order->deliveryDate, $order->comment, $order->delivery, $order->personID, $order->totalNoVAT, $order->orderTotal, $order->id);
        $stmt->execute();
        mysqli_close($mysqli);
    }    
    
    
    function GetOrderByID($orderId)
    {
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "SELECT * FROM order WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $stmt->bind_result($id, $orderDate, $deliveryDate, $comment, $delivery, $personID, $totalNoVAT, $orderTotal);

        while($stmt->fetch())
        {
            $order = new OrderEntity($id, $orderDate, $deliveryDate, $comment, $delivery, $personID, $totalNoVAT, $orderTotal);
        }    
        mysqli_close($mysqli);
        return $order;        
    }
    
    function GetOrderAll()
    {
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "SELECT * FROM order ORDER BY orderDate DESC";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $orderDate, $deliveryDate, $comment, $delivery, $personID, $totalNoVAT, $orderTotal);
        $orderArray = array();

        while($stmt->fetch())
        {
            $order= new OrderEntity($id, $orderDate, $deliveryDate, $comment, $delivery, $personID, $totalNoVAT, $orderTotal);
            array_push($orderArray, $order);
        }    
        mysqli_close($mysqli);
        return $orderArray;        
    }
}
