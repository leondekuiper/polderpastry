<?php

class OrderLineEntity
{
    public $id;
    public $orderID;
    public $itemID;
    public $amount;
    public $totalNoVAT;
    public $lineTotal;    
    
    function __construct($id, $orderID, $itemID, $amount, $totalNoVAT, $lineTotal) 
    {
        $this->id = $id;
        $this->orderID = $orderID;
        $this->itemID = $itemID;
        $this->amount = $amount;
        $this->totalNoVAT = $totalNoVAT;
        $this->lineTotal = $lineTotal;
    }
}
