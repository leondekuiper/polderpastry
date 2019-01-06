<?php 

require 'Controller/EmailController.php';
require 'Controller/ItemController.php';

$emailController = new EmailController();
$itemController = new ItemController();

$page = 'bestelling-gedaan';
$title = 'bestelling-gedaan';
$content = $EmailController->SendEmailConfirmation($itemController->GetItemAll()) .
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
