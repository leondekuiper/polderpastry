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
        <header class ="page-head">
	<div class="container header-body">
            <div class="container header-body">
		<ul class= "main-nav">
                    <li class="left-nav">
                        <ul>
                            <li class="nav-button <?php if ($page == "itemoverview") { echo "current-nav"; } ?>" id="nav-1">
                                    <a href="itemoverview.php" id="nav-1-a"><span class="hidden">Items</span></a>
                            </li>
                            <li class="nav-button <?php if ($page == "labeloverview") { echo "current-nav"; } ?>" id="nav-2">
                                    <a href="labeloverview.php" id="nav-2-a"><span class="hidden">Labels</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="right-nav">
                            <ul>
                                    <li class="nav-button <?php if ($page == "eventoverview") { echo "current-nav"; } ?>" id="nav-3">
                                            <a href="eventoverview.php" id="nav-3-a" class="order-url"><span class="hidden">Events</span></a>
                                    </li>	
                                    <li class="nav-button <?php if ($page == "orderoverview") { echo "current-nav"; } ?>" id="nav-4">
                                            <a href="orderoverview.php" id="nav-4-a"><span class="hidden">Orders</span></a>
                                    </li>
                            </ul>
                    </li>
		</ul>
            </div>
        </div>
        </header>
        <div class="wrapper container <?php echo $title;?>" id="content-area">
        <?php echo $content; ?>
        </div>
        <footer>
	<div class="container">
		<div class="row">
			<div class="footer-section footer-contact col-xs-12 col-sm-6 col-md-4 col-lg-4">
				<div class="footer-header">
					Contact
				</div>
				<p class="footer-item">
					Polder Pastry <br>
					Botshol 11 <br>
					1391HN Abcoude <br>
					T: 0622578071 <br>
					Telefonisch bereikaar <br>
					Ma - Zo van 10.00 tot 18.00 <br>
					info@polderpastry.nl <br>
				</p>
			</div>
			<div class="footer-section footer-info col-xs-12 col-sm-6 col-md-4 col-lg-4">
				<div class="footer-header">
				Bedrijfsinformatie 
				</div>
				<p class="footer-item">
                                    <a href="home.php">Website</a> <br>	
                                    <a href="algemenevoorwaarden.php">Algemene voorwaarden</a> <br>
                                    <a href="privacyverklaring.php">Privacy verklaring</a> <br>
                                    <a href="disclaimer.php">Disclaimer</a> <br> <br>
                                    KvK Nummer: 72156686 <br>
                                    Rekening Nummer: NL81INGB0008775510
				</p>
			</div>
			<div class="footer-section footer-social col-xs-12 col-sm-6 col-md-4 col-lg-4">
				<div class="footer-header">
					Social Media
				</div>
					<ul class = "social-menu">
						<li> 
							<a href="https://www.facebook.com/polderpastry" target="_blank" class="fab fa-facebook">
                                                        </a>
						</li>
						<li> 
							<a href="https://www.instagram.com/polderpastry" target="_blank" class="fab fa-instagram">
                                                        </a>
						</li>
					</ul>
			</div>
		</div>
	</div>
        </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="JS/polderpastry.js" language= "Javascript" type="text/javascript"></script>
    <script src="JS/sessionvars.js" type="text/javascript" ></script>
    <script src="JS/shopping-cart.js" type="text/javascript" ></script>
    <script src="JS/admin.js" type="text/javascript" ></script>    
    </body>
</html>