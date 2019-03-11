<?php

class GenericModel
{
    function GetObjectFromArray($array, $objectID)
    {
        foreach($array as $object) 
        {
            if ($objectID == $object->ID)
            {
                return $object;
            }
        }
        return;
    }    
}