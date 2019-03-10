<?php

class OrderEntity
{
    public $id;
    public $orderDate;
    public $deliveryDate;
    public $comment;
    public $isDelivery;
    public $personID;
    public $totalNoVAT;
    public $orderTotal;
    
    function __construct($id, $orderDate, $deliveryDate, $comment, $isDelivery, $personID, $totalNoVAT, $orderTotal) 
    {
        $this->id = $id;
        $this->orderDate = $orderDate;
        $this->deliveryDate = $deliveryDate;
        $this->comment = $comment;
        $this->isDelivery = $isDelivery;
        $this->personID = $personID;
        $this->totalNoVAT = $totalNoVAT;
        $this->orderTotal = $orderTotal;
    }
}
