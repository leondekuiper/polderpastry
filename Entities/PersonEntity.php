<?php

class PersonEntity
{
    public $id;
    public $name;
    public $street;
    public $zipcode;
    public $city;
    public $phoneNumber;
    public $email;
    
    function __construct($id, $name, $street, $zipcode, $city, $phoneNumber, $email) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->street = $street;
        $this->zipcode = $zipcode;
        $this->city = $city;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
    }
}
