<?php

require 'Model/OrderRowModel.php';

class OrderRowController 
{
    function CreateOrderRowTables($active)
    {
        $OrderRowModel = new OrderRowModel();
        $OrderRowArray = $OrderRowModel->GetOrderRowListByActive($active);
        $result = "";
        
        foreach ($OrderRowArray as $OrderRow)
        {
            $result = $result .
                    "<li class='OrderRow'>
                        <img class = 'thumbnail' runat = 'server' src ='$OrderRow->image' width='320' height='240'/>
                        <span class = 'description'>
                            <h3 class = 'title'>$OrderRow->name</h3>
                            <p class = 'text'>$OrderRow->description</p>
                        </span>
                    </li>";
        }
        return $result;
    }
}