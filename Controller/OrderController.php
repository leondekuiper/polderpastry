<?php

require ("Model/OrderModel.php");
require ("Controller/Itemcontroller.php");

class OrderController 
{
    function CreateOrderOverviewAdmin()
    {
        $result = 
            "<table class ='overview-table'>"
            . "<tr class = 'table-header'>"
                . "<td>Order Date</td>"
                . "<td>Delivery Date</td>"
                . "<td>Comment</td>"
                . "<td>Delivery</td>"
                . "<td>Person</td>"
                . "<td>Adres</td>"
                . "<td>Excl. VAT</td>"
                . "<td>Total Price</td>"
                . "<td></td>"
                . "<td></td>"
            . "</tr>";

        $orderArray = $this->GetOrderAll();
        $personArray = $this->GetPersonAll();
        $URL = "orderoverview";
        
        foreach ($orderArray as $order)
        {
            $person = GetPersonFromArray($personArray, $order->PersonID);
            $result = $result
                . "<tr>"
                    . "<td>$order->orderDate</td>"
                    . "<td>$order->deliveryDate</td>"
                    . "<td>$order->comment</td>"
                    . "<td>$order->delivery</td>"
                    . "<td>$person->name</td>"                    
                    . "<td>$person->Street" . ", $person->Zipcode" . ", $person->City</td>"
                    . "<td>$order->totalNoVAT</td>"
                    . "<td>$order->orderTotal</td>"
                    . "<td><a href='order_view.php?edit=$order->id' class='overview-link'>Details</a></td>"
                . "</tr>";
        };
        $result = $result . "</table>";
        
        return $result;
    }
    
    function GetPersonFromArray($personArray, $PersonID)
    {
        foreach($personArray as $person) 
        {
            if ($personID == $person->ID)
            {
                return $person;
            }
        }
        return;
    }
    
    function CreateOrder($personID, $orderDate, $deliveryDate, $comment, $delivery)
    {
        //asdf
        //asdf
        
        return $order;
    }
    
    function CreatePerson($name, $street, $zipcode, $city, $phoneNumber, $email)
    {
        $person = new personEntity('', $name, $street, $zipcode, $city, $phoneNumber, $email);
        
        return $person;
    }
    
    function CreateOrderLines($itemArray, $orderID)
    {
        $orderLineArray = array();
	foreach ($itemArray as $item) 
        {
            $amountstring = 'aantal_' . $item->id;
            if (isset($_POST[$amountstring]) && $_POST[$amountstring] > 0) 
            {
                $orderline = CreateOrderLine($item, $_POST[$amountstring], $orderID);
                array_push($orderLineArray, $orderLine);
            }
	}
        return $orderLineArray;         
    }
    
    function CreateOrderLine(ItemEntity $item, $amount, $orderID)
    {
        $lineTotal = floatval($item->price) * intval($amount);
        $VAT = round($lineTotal / 109 * 9, 2);
        $totalNoVAT = $lineTotal-$VAT;        
        $orderLine = new orderEntity('', $orderID, $item->id, $amount, $totalNoVAT, $lineTotal);
        return $orderline;
    }
    
    function UpdateOrder($order, $personID, $totalNoVAT, $orderTotal)
    {
        
    }
    
    function SendEmailConfirmation($person, $order, $orderLineArray)
    {
	$orderTable = "<table class = order-table><tr><th style='text-align:left;'>Naam:</th><th style='text-align:left;'>Prijs:</th><th style='text-align:left;'>Aantal:</th><th style='text-align:left;'>Totaal:</th></tr>";
	$totalPrice = 0;
        
	foreach ($orderLineArray as $orderLine)
        {
            $item = itemController->GetItemByID($orderline->ItemID);
            $itemPrice = floatval($item->price) * intval($orderLine->amount);
            $totalPrice += $itemPrice;
            $orderTable .= "<tr><td style='padding-right:24px;'>$item->name</td>
            <td style='padding-right:24px;'>€ $item->price</td>
            <td style='padding-right:24px;'>$orderLine->amount</td>
            <td style='padding-right:24px;'>€ $itemPrice</td></tr>";
        }

	$VAT = round($totalPrice / 109 * 9, 2);
	$subtotalPrice = $totalPrice - $VAT;
        $deliveryFee = 2.50;  //(if then else on the delivery boolean)
	$orderTable .= "<tr><td></td><td></td><td style='padding-right:24px;'>Excl. BTW:</td><td>€ $subtotalPrice</td></tr>
	<tr><td></td><td></td><td>BTW (9%):</td><td>€ $VAT</td></tr>
        <tr><td></td><td></td><td>Bezorgkosten:</td><td id='deliveryFee'>$deliveryFee</td></tr>    
	<tr><td></td><td></td><td>Totaal:</td><td>€ $totalPrice</td></tr></table>";

	$subject = 'Bedankt voor je bestelling bij Polder Pastry';
	$headers = 'From: info@polderpastry.nl' . "\r\n" .
			   'Reply-To: info@polderpastry.nl' . "\r\n" .
			   'Content-type: text/html; charset=UTF-8' . "\r\n" .
			   'X-Mailer: PHP/' . phpversion();
	$messageUser = "Beste " . $person->name . ",<br><br>Bedankt voor je bestelling. Deze zal " . $order->deliveryDay . " worden bezorgd op:<br><br>" . $person->street . "<br>" . $person->zipcode . "<br>" . $person->city . "<br> <br>Jouw bestelling:<br><br>" . $orderTable . "<br><br> Met opmerking: <br><br>" . $order->comment . "<br><br> Je kunt de bestelling nog wijzigen tot 2 dagen voor bovenstaande datum door te reply'en op deze mail.<br><br>Het totaalbedrag kan overgemaakt worden op rekening nummer NL81INGB0008775510 t.n.v. Polder Pastry met als referentie uw naam en postcode.<br>U kunt ook met cash betalen bij bezorging, zorg dan wel dat u het gepast heeft.<br><br>Met vriendelijke groet,<br><br>Polder Pastry <br><br> info@polderpastry.nl <br> tel. 0640544028 <br> instagram.com/polderpastry <br> facebook.com/polderpastry";
	$message = "Beste " . $person->name . ",<br> <br>Bedankt voor je bestelling. Deze zal " . $order->deliveryDay . " worden bezorgd op: <br> <br> " . $person->street . "<br>" . $person->zipcode . "<br>" . $person->city . "<br> <br>Uw kunt de bestelling nog wijzigen tot 2 dagen voor bovenstaande datum. Je kan gewoon reply'en op deze mail <br> <br> Klantgegevens: <br> <br>" . $person->email . "<br><br>" . $person->phoneNumber . "<br><br>" . $orderTable . "<br><br>" . $order->comment;

	mail($person->email, $subject, $messageUser, $headers);
	mail('info@polderpastry.nl', $subject, $message, $headers);
    }
}

