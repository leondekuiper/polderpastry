<?php

class ItemEntity 
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $type;
    public $minimumOrder;
    public $isActive;
    public $image;
    public $position;
    
    function __construct($id, $name, $description, $price, $type, $minimumOrder, $isActive, $image, $position) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;        
        $this->price = $price;
        $this->type = $type;
        $this->minimumOrder = $minimumOrder;
        $this->isActive = $isActive;
        $this->image = $image;
        $this->position = $position;
    }
}
