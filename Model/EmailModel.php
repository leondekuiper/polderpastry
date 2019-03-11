<?php

require_once ("Entities/EmailEntity.php");
require_once ("Credentials.php");

class EmailModel
{
    function GetEmailAll()
    {
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "SELECT * FROM email ORDER BY sendDate DESC";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $sendDate, $emailAddress, $message);
        $emailArray = array();

        while($stmt->fetch())
        {
            $email = new EmailEntity($id, $sendDate, $emailAddress, $message);
            array_push($emailArray, $email);
        }    
        mysqli_close($mysqli);
        return $emailArray;
    }
    
    function GetEmailByID($emailId)
    {
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "SELECT * FROM email WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $emailId);
        $stmt->execute();
        $stmt->bind_result($id, $sendDate, $emailAddress, $message);

        while($stmt->fetch())
        {
            $label = new LabelEntity($id, $sendDate, $emailAddress, $message);
        }    
        mysqli_close($mysqli);
        return $email;
    }
    
    function CreateEmail(EmailEntity $email)
    {
        $mysqli = new mysqli($host,$user,$password,$database);
        $query = "INSERT INTO email (sendDate, emailAddress, message) VALUES (?,?,?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sss", $email->sendDate, $email->emailAddress, $email->message);
        $stmt->execute();

        mysqli_close($mysqli);
    }
}