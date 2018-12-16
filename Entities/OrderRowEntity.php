<?php

class OrderRowEntity
{
    public $id;
    public $name;
    public $description;
    public $image;
    public $isActive;
    
    function __construct($id, $name, $description, $image, $isActive) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->isActive = $isActive;
    }
}
