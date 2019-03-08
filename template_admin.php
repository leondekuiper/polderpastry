<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <title> Polder Pastry - <?= ucWords($page); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="Styles/CSS/bootstrap.css">
    <link rel="stylesheet" href="Styles/CSS/stylesheet.css">
    <link rel="icon" type="image/x-icon" href="/favicon.ico"/>
    </head>
    <body class = "bootstrap-wrapper">
        <header class ="page-head-admin">
            <div class="nav-admin-logo">
                <img src="styles/CSS/logo/logo.jpg" alt="PolderPastry Logo">
            </div>
            <ul class= "main-nav-admin">
                <li class="nav-button-admin <?php if ($page == "itemoverview") { echo "current-nav"; } ?>">
                    <a href="itemoverview.php"><span>Items</span></a>
                </li>
                <li class="nav-button-admin <?php if ($page == "labeloverview") { echo "current-nav"; } ?>">
                    <a href="labeloverview.php"><span>Labels</span></a>
                </li>
                <li class="nav-button-admin <?php if ($page == "typeoverview") { echo "current-nav"; } ?>">
                    <a href="typeoverview.php"><span>Types</span></a>
                </li>
                <li class="nav-button-admin <?php if ($page == "imageoverview") { echo "current-nav"; } ?>">
                    <a href="imageoverview.php"><span>Images</span></a>
                </li>                            
                <li class="nav-button-admin <?php if ($page == "eventoverview") { echo "current-nav"; } ?>">
                    <a href="eventoverview.php"><span>Events</span></a>
                </li>	
                <li class="nav-button-admin <?php if ($page == "orderoverview") { echo "current-nav"; } ?>">
                    <a href="orderoverview.php"><span>Orders</span></a>
                </li>
                <li class="nav-button-admin <?php if ($page == "invoiceoverview") { echo "current-nav"; } ?>">
                    <a href="invoiceoverview.php"><span>Invoices</span></a>
                </li>
                <li class="nav-button-admin <?php if ($page == "emailoverview") { echo "current-nav"; } ?>">
                    <a href="emailoverview.php"><span>Emails</span></a>
                </li>
                <li class="nav-button-admin <?php if ($page == "purchaseoverview") { echo "current-nav"; } ?>">
                    <a href="purchaseoverview.php"><span>Purchases</span></a>
                </li>
            </ul>
        </header>
        <div class="wrapper container <?php echo $title;?>" id="content-area">
        <?php echo $content; ?>
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="JS/polderpastry.js" language= "Javascript" type="text/javascript"></script>
    <script src="JS/sessionvars.js" type="text/javascript" ></script>
    <script src="JS/shopping-cart.js" type="text/javascript" ></script>
    <script src="JS/admin.js" type="text/javascript" ></script>    
    </body>
</html>