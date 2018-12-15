<?php

require ("Entities/ItemEntity.php");

class ItemModel 
{
    function GetItemTypes()
    {
        require 'Credentials.php';
        
        $link = mysqli_connect($host,$user,$password,$database);
        $query = "SELECT DISTINCT type FROM item";
        $result = mysqli_query($link,$query);
        $types = array();
        
        while($row = mysqli_fetch_array($result))
        {
            array_push($types, $row[0]);
        }
        mysqli_close($link);
        return $types;
    }
    
    function GetItemByType($type)
    {
        require 'Credentials.php';
     
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "SELECT * FROM item WHERE type LIKE ? AND isActive LIKE ?";
        $stmt = $mysqli->prepare($query);
        $yes = "Yes";
        $stmt->bind_param("ss", $type, $yes);
        $stmt->execute();
        $stmt->bind_result($id, $name, $description, $price, $type, $minimumOrder, $isActive, $image);
        $itemArray = array();

        while($stmt->fetch())
        {
            $item = new ItemEntity($id, $name, $description, $price, $type, $minimumOrder, $isActive, $image);
            array_push($itemArray, $item);
        }    
        mysqli_close($mysqli);
        return $itemArray;
    }
    
    function GetItemByID($itemId)
    {
        require 'Credentials.php';
     
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "SELECT * FROM item WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $itemId);
        $stmt->execute();
        $stmt->bind_result($id, $name, $description, $price, $type, $minimumOrder, $isActive, $image);

        while($stmt->fetch())
        {
            $item = new ItemEntity($id, $name, $type, $price, $description, $image, $isActive, $minimumOrder);
        }    
        mysqli_close($mysqli);
        return $item;        
    }
    
    function CreateItem(ItemEntity $item)
    {
        require 'Credentials.php';
        
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "INSERT INTO item(name, description, price, type, minimumOrder, isActive, image) VALUES (?,?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $imageURL = "Images/". mysqli_real_escape_string($mysqli, $item->image);  
        $stmt->bind_param("ssdsiss", $item->name, $item->description, $item->price, $item->type, $item->minimumOrder, $item->isActive, $imageURL);
        $stmt->execute();

        mysqli_close($mysqli);
    }
    
    function UpdateItem($id, ItemController $item)
    {
        require 'Credentials.php';
        
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "UPDATE item SET name=? description=? price=? type? minimumOrder=? isActive=? image=? WHERE id=?";
        $stmt = $mysqli->prepare($query);
        $imageURL = "Images/". mysqli_real_escape_string($item->image);         
        $stmt->bind_param("ssdsissi", $item->name, $item->description, $item->price, $item->type, $item->minimumOrder, $item->isActive, $imageURL, $item->id);
        $stmt->execute();
        
        mysqli_close($mysqli);
    }
    
    function DeleteItem($id)
    {
        require 'Credentials.php';

        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "DELETE FROM item WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        mysqli_close($mysqli);
    }
}