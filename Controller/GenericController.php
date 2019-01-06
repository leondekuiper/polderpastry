<?php

class GenericController 
{
    function CreateDropdown(array $valueArray, $activeValue)
    {
        $result = "";
        foreach ($valueArray as $value)
        {
            if ($value == $activeValue)
            {
                $selected = "selected = 'selected'";
            }
            else
            {
                $selected = "";
            }
            $result = $result . "<option $selected value='$value'>$value</option>";
        }
        return $result;
    }
}