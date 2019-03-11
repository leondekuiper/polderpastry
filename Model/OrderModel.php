<?php

require_once ("Entities/OrderEntity.php");
require_once ("Entities/OrderLineEntity.php");
require_once ("Entities/PersonEntity.php");
require_once 'Credentials.php';

class OrderModel 
{
    function CreatePerson(personEntity $person)
    {
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "INSERT INTO person (name, street, zipcode, city, phoneNumber, email) VALUES (?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssssss", $person->name, $person->street, $person->zipcode, $person->city, $person->phoneNumber, $person->email);
        $stmt->execute();
        $id = mysql_insert_id($mysqli);
        mysqli_close($mysqli);
        return $id;
    }

    function GetPersonByID($personId)
    {
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "SELECT * FROM person WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $personId);
        $stmt->execute();
        $stmt->bind_result($id, $name, $street, $zipcode, $city, $phoneNumber, $email);

        while($stmt->fetch())
        {
            $person = new PersonEntity($id, $name, $street, $zipcode, $city, $phoneNumber, $email);
        }    
        mysqli_close($mysqli);
        return $person;
    }

    function GetPersonAll()
    {
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "SELECT * FROM person";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $name, $street, $zipcode, $city, $phoneNumber, $email);
        $personArray = array();

        while($stmt->fetch())
        {
            $person= new PersonEntity($id, $name, $street, $zipcode, $city, $phoneNumber, $email);
            array_push($personArray, $person);
        }    
        mysqli_close($mysqli);
        return $personArray;
    }

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
