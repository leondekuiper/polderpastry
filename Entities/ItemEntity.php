<?php

class ItemEntity 
{
    public $id;
    public $name;
    public $type;
    public $price;
    public $description;
    public $image;
    public $minimumOrder;
    
    function __construct($id, $name, $type, $price, $description, $image, $minimumOrder) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
        $this->description = $description;
        $this->image = $image;
        $this->minimumOrder = $minimumOrder;
    }
}
