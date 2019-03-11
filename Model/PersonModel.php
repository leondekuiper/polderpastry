<?php

require_once ("Entities/PersonEntity.php");
require_once ("Credentials.php");

class PersonModel 
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
}
