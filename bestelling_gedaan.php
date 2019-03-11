<?php 

require_once 'Controller/EmailController.php';
require_once 'Controller/ItemController.php';
require_once 'Controller/OrderController.php';
require_once 'Controller/PersonController.php';
require_once 'Controller/OrderLineController.php';

$emailController = new EmailController();
$itemController = new ItemController();
$orderController = new OrderController();
$orderLineController = new orderLineController();
$personController = new PersonController();

$person = $personController->CreatePerson();
$order = $orderController->CreateOrder($person->id);
$itemArray = $itemController->GetItemAll();

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

$orderLineArray = array();
    foreach ($itemArray as $item) 
    {
        $amountstring = 'aantal_' . $item->id;
        if (isset($_POST[$amountstring]) && $_POST[$amountstring] > 0) 
        {
            $orderline = $orderLineController->CreateOrderLine($item, $_POST[$amountstring], $order->id);
            array_push($orderLineArray, $orderLine);
        }
    }
        
$orderController->UpdateOrder($order, $person->id, $totalNoVAT, $orderTotal);
$emailController->SendConfirmationEmail($emailController->CreateConfirmationEmail($person, $order, $orderController->CreateOrderTable($orderLineArray, $itemArray)));

$page = 'bestelling-gedaan';
$title = 'bestelling-gedaan';
$content = 
'<div class="page-title">
    <p>
        Bedankt voor je bestelling!
    </p>
</div>
<div class="main-content">
    <p>
        Mocht je binnen 5 minuten geen bevestiging in de email hebben dan is er iets mis gegaan en dan mag je nog een keer door alle koekjes heen <br> <br>
        Indien de bezorgtijden voor ons niet kunnen worden ingepland dan nemen wij telefonisch contact op <br> <br>
    </p> 
</div>
<script type="text/javascript">
    setTimeout(function(){sessvars.$.clearMem();updateCart()}, 500);
</script>';

include 'template.php';
