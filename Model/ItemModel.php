<?php

require ("Entities/ItemEntity.php");

class ItemModel 
{
    function GetItemTypes()
    {
        require 'Credentials.php';
        
        $link = mysqli_connect($host,$user,$password,$database);
        $query = "SELECT COLUMN_TYPE FROM information_schema.COLUMNS
                 WHERE TABLE_NAME = 'item' AND COLUMN_NAME = 'type'";
        $result = mysqli_query($link,$query);
        $types = array();        
        while($row = mysqli_fetch_array($result))
        {
            $types = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));
        };

        mysqli_close($link);
        return $types;
    }
    
    function GetItemByType($type)
    {
        require 'Credentials.php';
     
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "SELECT * FROM item WHERE type LIKE ? AND isActive = ? ORDER BY position ASC";
        $stmt = $mysqli->prepare($query);
        $yes = "1";
        $stmt->bind_param("si", $type, $yes);
        $stmt->execute();
        $stmt->bind_result($id, $name, $description, $price, $type, $minimumOrder, $isActive, $image, $position);
        $itemArray = array();

        while($stmt->fetch())
        {
            $item = new ItemEntity($id, $name, $description, $price, $type, $minimumOrder, $isActive, $image, $position);
            array_push($itemArray, $item);
        }    
        mysqli_close($mysqli);
        return $itemArray;
    }

    function GetItemAll()
    {
        require 'Credentials.php';
     
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "SELECT * FROM item ORDER BY position ASC";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $name, $description, $price, $type, $minimumOrder, $isActive, $image, $position);
        $itemArray = array();

        while($stmt->fetch())
        {
            $item = new ItemEntity($id, $name, $description, $price, $type, $minimumOrder, $isActive, $image, $position);
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
        $stmt->bind_result($id, $name, $description, $price, $type, $minimumOrder, $isActive, $image, $position);

        while($stmt->fetch())
        {
            $item = new ItemEntity($id, $name, $description, $price, $type, $minimumOrder, $isActive, $image, $position);
        }    
        mysqli_close($mysqli);
        return $item;
    }
    
    function CreateItem(ItemEntity $item)
    {
        require 'Credentials.php';
        
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "INSERT INTO item(name, description, price, type, minimumOrder, isActive, image, position) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $imageURL = "Images/". mysqli_real_escape_string($mysqli, $item->image);  
        $stmt->bind_param("ssdsiis", $item->name, $item->description, $item->price, $item->type, $item->minimumOrder, $item->isActive, $imageURL, $item->position);
        $stmt->execute();

        mysqli_close($mysqli);
    }
    
    function UpdateItem(ItemEntity $item)
    {
        require 'Credentials.php';
        
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "UPDATE item SET name=?, description=?, price=?, type=?, minimumOrder=?, isActive=?, image=?, position=? WHERE id=?";
        $stmt = $mysqli->prepare($query);
        $imageURL = "Images/". mysqli_real_escape_string($mysqli, $item->image);         
        $stmt->bind_param("ssdsiisi", $item->name, $item->description, $item->price, $item->type, $item->minimumOrder, $item->isActive, $imageURL, $item->position, $item->id);
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