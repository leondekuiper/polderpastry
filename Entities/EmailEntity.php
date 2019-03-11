<?php

class EmailEntity
{
    public $id;
    public $sendDate;
    public $emailAddress;    
    public $message;

    function __construct($id, $sendDate, $emailAddress, $message) 
    {
        $this->id = $id;
        $this->sendDate = $sendDate;
        $this->emailAddress = $emailAddress;
        $this->message = $message;        
    }
}
