<?php

require ("Model/OrderModel.php");

class OrderController 
{
    function CreateOrderTables($active)
    {
        $OrderModel = new OrderModel();
        $OrderArray = $OrderModel->GetOrderListByActive($active);
        $result = "";
        
        foreach ($OrderArray as $Order)
        {
            $result = $result .
                    "<li class='Order'>
                        <img class = 'thumbnail' runat = 'server' src ='$Order->image' width='320' height='240'/>
                        <span class = 'description'>
                            <h3 class = 'title'>$Order->name</h3>
                            <p class = 'text'>$Order->description</p>
                        </span>
                    </li>";
        }
        return $result;
    }
}