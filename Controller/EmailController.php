<?php

require_once ("Model/EmailModel.php");

class EmailController 
{
    function CreateEmailOverviewAdmin()
    {
        $result = 
            "<table class ='overview-table'>"
            . "<tr class = 'table-header'>"
                . "<td>Send Date</td>"
                . "<td>Email Address</td>"
                . "<td></td>"
                . "<td></td>"
            . "</tr>";

        $emailArray = $this->GetEmailAll();
        $EmailModel = new EmailModel();
        $URL = "emailoverview";
        
        foreach ($emailArray as $email)
        {
            $result = $result
                . "<tr>"
                    . "<td>$email->sendDate</td>"
                    . "<td>$email->emailAddress</td>"
                    . "<td><a href='email_view.php?edit=$email->id' class='overview-link'>View</a></td>"
                . "</tr>";
        };
        $result = $result . "</table>";
        
        return $result;
    }
    
    function GetEmailAll()
    {
        $emailModel = new EmailModel();
        return $emailModel->GetEmailAll();        
    } 

    function GetEmailById($id)
    {
        $emailModel = new EmailModel();
        return $emailModel->GetEmailByID($id);
    }
    
    function CreateConfirmationEmail($person, $order, $orderTable)
    {
	$message = "Beste " . $person->name . ",<br><br>Bedankt voor je bestelling. Deze zal " . $order->deliveryDay . " worden bezorgd op:<br><br>" . $person->street . "<br>" . $person->zipcode . "<br>" . $person->city . "<br> <br>Jouw bestelling:<br><br>" . $orderTable . "<br><br> Met opmerking: <br><br>" . $order->comment . "<br><br> Je kunt de bestelling nog wijzigen tot 2 dagen voor bovenstaande datum door te reply'en op deze mail.<br><br>Het totaalbedrag kan overgemaakt worden op rekening nummer NL81INGB0008775510 t.n.v. Polder Pastry met als referentie uw naam en postcode.<br>U kunt ook met cash betalen bij bezorging, zorg dan wel dat u het gepast heeft.<br><br>Met vriendelijke groet,<br><br>Polder Pastry <br><br> info@polderpastry.nl <br> tel. 0640544028 <br> instagram.com/polderpastry <br> facebook.com/polderpastry";
	$email = new EmailEntity('', $order->deliveryDay, $person->email, $message);
        $emailModel = new EmailModel();
        $emailModel->CreateEmail($email);
        return $email;
    }
    
    function SendConfirmationEmail($email)
    {
        $subject = 'Bedankt voor je bestelling bij Polder Pastry';
	$headers = 'From: info@polderpastry.nl' . "\r\n" .
			   'Reply-To: info@polderpastry.nl' . "\r\n" .
			   'Content-type: text/html; charset=UTF-8' . "\r\n" .
			   'X-Mailer: PHP/' . phpversion();

	mail($email->emailAddress, $subject, $email->message, $headers);
	mail('info@polderpastry.nl', $subject, $email->message, $headers);        
    }
}