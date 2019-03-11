<?php

require_once ("Model/PersonModel.php");

class PersonController
{
    function CreatePerson()
    {
        $name = $_POST['naam'];
        $street = $_POST['straat'];
        $zipcode = $_POST['postcode'];
        $city = $_POST['woonplaats'];
        $phoneNumber = $_POST['telefoonnummer'];
        $email = $_POST['mailaddress'];
        
        $person = new personEntity('', $name, $street, $zipcode, $city, $phoneNumber, $email);
        $personModel = new PersonModel();
        $personModel->CreatePerson($person);        
        
        return $person;
    }
    
    function GetPerson($id)
    {
        $personModel = new PersonModel();
        return $personModel->GetPersonByID($id);        
    }
    
    function GetPersonAll()
    {
        $personModel = new PersonModel();
        return $personModel->GetPersonAll();           
    }
    
    
}

