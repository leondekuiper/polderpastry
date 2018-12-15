<?php

require ('Model/ItemModel.php');

class ItemController 
{
    
    function CreateItemOverview()
    {
        $result = 
            "<table class ='overview-table'>"
            . "<tr class = 'table-header'>"
                . "<td>Name</td>"
                . "<td>Price</td>"
                . "<td>Type</td>"
                . "<td>Minimum</td>"
                . "<td>Active</td>"
                . "<td>ImageURL</td>"
                . "<td></td>"
                . "<td></td>"
            . "</tr>";

        $itemArray = $this->GetItemByType('%');
        
        foreach ($itemArray as $item)
        {
            $result = $result
                . "<tr>"
                    . "<td>$item->name</td>"
                    . "<td>$item->price</td>"
                    . "<td>$item->type</td>"
                    . "<td>$item->minimumOrder</td>"                    
                    . "<td>$item->isActive</td>"
                    . "<td>$item->image</td>"
                    . "<td><a href='' class='overview-link'>Update</a></td>"
                    . "<td><a href='' class='overview-link'>Delete</a></td>"
                . "</tr>";
        };
        $result = $result . "</table>";
        
        return $result;
    }

    function CreateItemDropdown()
    {
        $itemModel = new ItemModel();
        $result = "<form action = '' method = 'post' width = '200px'>
                    Pastry type:
                    <select name = 'types' >
                    <option value = '%'>Alle</option>
                    ".$this->CreateItemValues($itemModel->GetItemTypes()).
                    "</select>
                    <input type = 'submit' value = 'Search' />
                    </form>";
        return $result;
    }
    
    function CreateItemValues(array $valueArray)
    {
        $result = "";
        foreach ($valueArray as $value)
        {
            $result = $result . "<option value = '$value'>$value</option>";
        }
        return $result;
    }
    
    function CreateItemTables($types)
    {
        $itemModel = new ItemModel();
        $itemArray = $itemModel->GetItemByType($types);
        $result = "";
        
        foreach ($itemArray as $item)
        {
            $price = number_format((float)$item->price, 2, ',', '');
            $result = $result .
                    "<li class='item'>
                        <img class = 'thumbnail' runat = 'server' src ='$item->image' width='320' height='240'/>
                        <span class = 'description'>
                            <h3 class = 'title'>$item->name</h3>
                            <h3 class = 'price' id='prijs_$item->id'>€ $price</h3>
                            <p class = 'text'>$item->description</p>
                            <ul class= 'tags'>
                            Label placeholder
                            </ul>
                            <p class = 'order'>
                                <input id='input_$item->id' type = 'number' name = 'item-amount' value = '$item->minimumOrder' class = 'item-amount' min = '$item->minimumOrder'>
                                <button data-id ='$item->id' class = 'add-to-cart'>Voeg Toe</button>
                            </p>
                        </span>
                        <div id = 'aantal_$item->id' class = 'shop-amount item-shop-amount'/>
                    </li>";
        }
        return $result;
    }
    
    function CreateItem()
    {
        $name = $_POST["txtName"];
        $description = $_POST["txtDescription"];  
        $price = $_POST["txtPrice"];         
        $type = $_POST["dslType"];                
        $minimumOrder = $_POST["txtMinimumOrder"];       
        $isactive = $_POST["isActive"];             
        $image = $_POST["dslImage"];

        $item = new ItemEntity('', $name, $description, $price, $type, $minimumOrder , $isactive , $image);
        $itemModel = new ItemModel();
        $itemModel->CreateItem($item);
    }
    
    function UpdateItem($id)
    {
        
    }
    
    function DeleteItem($id)
    {
        
    }
    
    function GetItemById($id)
    {
        $itemModel = new ItemModel();
        return $itemModel->GetItemByID($itemId);
    }
    
    function GetItemByType($type)
    {
        $itemModel = new ItemModel();
        return $itemModel->GetItemByType($type);        
    }
    
    function GetItemTypes()
    {
        $itemModel = new ItemModel();
        return $itemModel->GetItemTypes();     
    }
    
    function GetImages()
    {
        $handle = opendir("Images");
        while($image = readdir($handle))
        {
            $images[]= $image;
        }
        closedir($handle);
        
        $imageArray = array();
        foreach($images as $image)
        {
            if(strlen($image)>2)
            {
                array_push($imageArray, $image);
            }
        }
        
        $result = $this->CreateItemValues($imageArray);
        return $result;
    }
    
    function CreateShoppingCart ()
    {
        $order = json_decode($_GET['o']);
        $itemModel = new ItemModel();
        $itemArray = $itemModel->GetItemByType('%');
        $totalItemPrice = 0;
        $totalPrice = 0;
        $result = '<table class = order-table>
                    <tr>
                        <th>Naam</th>
                        <th style= "text-align: center">Prijs €</th>
                        <th>Aantal</th>
                        <th id = "totaal">Totaal</th>
                    </tr>';
        foreach ($order as $id => $amount)
        {
            foreach ($itemArray as $item)
            {
                if ($item->id == $id && $amount > 0)
                { 
                    $itemPrice =  floatval($item->price * intval($amount));
                    $price = number_format($item->price,2);
                    $totalPrice += $itemPrice;
                    $result = $result . "<tr>
                    <td>$item->name</td>
                    <td style= 'text-align:center' id='prijs_$item->id'>$price</td>
                    <td><input class = 'item-amount-basket' id='input_$item->id' onChange='addValToCart($item->id,this.value,$item->price)' type='number' name = 'aantal_$item->id' min='$item->minimumOrder'></td>
                    <td class='rowTotal' id='totaal_$item->id'>NNB</td>
                    </tr>";
                }
            }
        }
        $DeliveryFee = 2.50;
        $totalPrice = $totalPrice+$DeliveryFee;
        $VAT = round($totalPrice / 106 * 6, 2);
        $subtotalPrice = $totalPrice - $VAT;
        $result = $result . "<tr><td id = 'heightfilling-20px'></td><td></td><td></td></tr>
        <tr><td></td><td></td><td>Bezorgkosten:</td><td id='deliveryFee'>$DeliveryFee</td></tr>
        <tr><td></td><td></td><td>Excl. BTW:</td><td id='subtotalPrice'>$subtotalPrice</td></tr>
        <tr><td></td><td></td><td>BTW (6%):</td><td id='vat'>$VAT</td></tr>
        <tr><td></td><td></td><td>Totaal:</td><td id='totalPrice'>$totalPrice</td></tr></table>";
        return $result;
    }
    
    function SendEmailWithItems()
    {
	$naam = $_POST['naam'];
	$bezorgdag = $_POST['bezorgdag'];
	$straat = $_POST['straat'];
	$postcode = $_POST['postcode'];
	$woonplaats = $_POST['woonplaats'];
	$telefoonnummer = $_POST['telefoonnummer'];
	$mailaddress = $_POST['mailaddress'];
	$bestelling = "<table class = order-table><tr><th style='text-align:left;'>Naam:</th><th style='text-align:left;'>Prijs:</th><th style='text-align:left;'>Aantal:</th><th style='text-align:left;'>Totaal:</th></tr>";
        $opmerking = $_POST['opmerking'];

	unset($_POST['naam']);
	unset($_POST['bezorgdag']);
	unset($_POST['straat']);
	unset($_POST['postcode']);
	unset($_POST['woonplaats']);
	unset($_POST['telefoonnummer']);
	unset($_POST['mailaddress']);
	unset($_POST['terms']);
	unset($_POST['opmerking']);
	unset($_POST['ophalen']);
	unset($_POST['bezorgen']);

	$totalPrice = 0;
        $itemModel = new ItemModel();
        $itemArray = $itemModel->GetItemByType('%');
        
	foreach ($itemArray as $item) 
        {
            $amountstring = 'aantal_' . $item->id;
            if (isset($_POST[$amountstring]) && $_POST[$amountstring] > 0) 
            {
                $amount = $_POST[$amountstring];
                $itemPrice = floatval($item->price) * intval($amount);
                $totalPrice += $itemPrice;
                $bestelling .= "<tr><td style='padding-right:24px;'>$item->name</td>
                <td style='padding-right:24px;'>€ $item->price</td>
                <td style='padding-right:24px;'>$amount</td>
                <td style='padding-right:24px;'>€ $itemPrice</td></tr>";
            }
	}

	$VAT = round($totalPrice / 106 * 6, 2);
	$subtotalPrice = $totalPrice - $VAT;
	$bestelling .= "<tr><td></td><td></td><td style='padding-right:24px;'>Excl. BTW:</td><td>€ $subtotalPrice</td></tr>
	<tr><td></td><td></td><td>BTW (6%):</td><td>€ $VAT</td></tr>
	<tr><td></td><td></td><td>Totaal:</td><td>€ $totalPrice</td></tr></table>";

	$subject = 'Bedankt voor je bestelling bij Polder Pastry';
	$headers = 'From: info@polderpastry.nl' . "\r\n" .
			   'Reply-To: info@polderpastry.nl' . "\r\n" .
			   'Content-type: text/html; charset=UTF-8' . "\r\n" .
			   'X-Mailer: PHP/' . phpversion();
	$messageUser = "Beste " . $naam . ",<br><br>Bedankt voor je bestelling. Deze zal " . $bezorgdag . " worden bezorgd op:<br><br>" . $straat . "<br>" . $postcode . "<br>" . $woonplaats . "<br> <br>Jouw bestelling:<br><br>" . $bestelling . "<br><br>Je kunt de bestelling nog wijzigen tot 2 dagen voor bovenstaande datum door te reply'en op deze mail.<br><br>Het totaalbedrag kan overgemaakt worden op rekening nummer NL81INGB0008775510 t.n.v. Polder Pastry met als referentie uw naam en postcode.<br>U kunt ook met cash betalen bij bezorging, zorg dan wel dat u het gepast heeft.<br><br>Met vriendelijke groet,<br><br>Polder Pastry <br><br> info@polderpastry.nl <br> tel. 0640544028 <br> instagram.com/polderpastry <br> facebook.com/polderpastry";
	$message = "Beste " . $naam . ",<br> <br>Bedankt voor je bestelling. Deze zal " . $bezorgdag . " worden bezorgd op: <br> <br> " . $straat . "<br>" . $postcode . "<br>" . $woonplaats . "<br> <br>Uw kunt de bestelling nog wijzigen tot 2 dagen voor bovenstaande datum. Je kan gewoon reply'en op deze mail <br> <br> Klantgegevens: <br> <br>" . $mailaddress . "<br><br>" . $telefoonnummer . "<br><br>" . $bestelling . "<br><br>" . $opmerking;

	mail($mailaddress, $subject, $messageUser, $headers);
	mail('info@polderpastry.nl', $subject, $message, $headers);
    }
}
