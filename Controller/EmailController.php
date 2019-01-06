<?php

Class EmailController
{
    function SendEmailConfirmation($itemArray)
    {
	$itemController = new ItemController();
        
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

	$VAT = round($totalPrice / 109 * 9, 2);
	$subtotalPrice = $totalPrice - $VAT;
        $deliveryFee = 2.50;
	$bestelling .= "<tr><td></td><td></td><td style='padding-right:24px;'>Excl. BTW:</td><td>€ $subtotalPrice</td></tr>
	<tr><td></td><td></td><td>BTW (9%):</td><td>€ $VAT</td></tr>
        <tr><td></td><td></td><td>Bezorgkosten:</td><td id='deliveryFee'>$deliveryFee</td></tr>    
	<tr><td></td><td></td><td>Totaal:</td><td>€ $totalPrice</td></tr></table>";

	$subject = 'Bedankt voor je bestelling bij Polder Pastry';
	$headers = 'From: info@polderpastry.nl' . "\r\n" .
			   'Reply-To: info@polderpastry.nl' . "\r\n" .
			   'Content-type: text/html; charset=UTF-8' . "\r\n" .
			   'X-Mailer: PHP/' . phpversion();
	$messageUser = "Beste " . $naam . ",<br><br>Bedankt voor je bestelling. Deze zal " . $bezorgdag . " worden bezorgd op:<br><br>" . $straat . "<br>" . $postcode . "<br>" . $woonplaats . "<br> <br>Jouw bestelling:<br><br>" . $bestelling . "<br><br> Met opmerking: <br><br>" . $opmerking . "<br><br> Je kunt de bestelling nog wijzigen tot 2 dagen voor bovenstaande datum door te reply'en op deze mail.<br><br>Het totaalbedrag kan overgemaakt worden op rekening nummer NL81INGB0008775510 t.n.v. Polder Pastry met als referentie uw naam en postcode.<br>U kunt ook met cash betalen bij bezorging, zorg dan wel dat u het gepast heeft.<br><br>Met vriendelijke groet,<br><br>Polder Pastry <br><br> info@polderpastry.nl <br> tel. 0640544028 <br> instagram.com/polderpastry <br> facebook.com/polderpastry";
	$message = "Beste " . $naam . ",<br> <br>Bedankt voor je bestelling. Deze zal " . $bezorgdag . " worden bezorgd op: <br> <br> " . $straat . "<br>" . $postcode . "<br>" . $woonplaats . "<br> <br>Uw kunt de bestelling nog wijzigen tot 2 dagen voor bovenstaande datum. Je kan gewoon reply'en op deze mail <br> <br> Klantgegevens: <br> <br>" . $mailaddress . "<br><br>" . $telefoonnummer . "<br><br>" . $bestelling . "<br><br>" . $opmerking;

	mail($mailaddress, $subject, $messageUser, $headers);
	mail('info@polderpastry.nl', $subject, $message, $headers);
    }
}

