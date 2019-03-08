<?php 

require 'Controller/ItemController.php';
$itemController = new ItemController();

$page = 'bestellen'; 
$title = 'bestellen';
$content =
'<div class= "order">
    <form action="bestelling_gedaan.php" method="POST">
        <div class = "order-left">
            <div class="page-title">
		<p>
			Winkelwagen
		</p>
            </div>
            <div id="receiptContainer">
		'
		. $itemController->CreateItemOverviewShoppingCart() .
		'
            <p> Let op! Wij bezorgen alleen in de regio Amstelland, Abcoude, Amstelveen & Amsterdam-Zuid! Indien u voor een andere regio patiserie wil bestellen en wil laten bezorgen neem dan eerst even contact op. Anders zullen wij uw bestelling annuleren en bij een reeds geschiede betaling uw geld terug storten. Vanaf &euro; 25 is de bezorging gratis!</p>
            </div>
        </div>
        <div class = order-right>
            <div class="page-title">
		<p>
			Bestelgegevens
		</p>
            </div>
            <table class = order-table>
		<tr><td><label for="naam">Naam</label></td><td id = "widthfilling-20px"><input name="naam" required id="naam"/></td></tr>
		<tr><td><label for="straat">Straat & Huisnummer</label></td><td><input name="straat" required id="straat"/></td></tr>
		<tr><td><label for="postcode">Postcode</label></td><td><input name="postcode" required id="postcode"/></td></tr>
		<tr><td><label for="woonplaats">Woonplaats</label></td><td><input name="woonplaats" required id="woonplaats"/></td></tr>
		<tr><td><label for="telefoonnummer">Telefoonnummer</label></td><td><input type="number" required name="telefoonnummer" id="telefoonnummer"/></td></tr>
		<tr><td><label for="email">E-mailadres:</label></td><td><input type="email" name="mailaddress" id="email"/></td></tr>
		<tr><td>
        	<label for="ophalen">Ophalen </label>
            </td><td>
        	<input type="radio" id="ophalen" name="bezorging" value="ophalen" onChange="updateTotal()" />
            </td></tr>
            <tr><td>
        	<label for="bezorgen">Bezorgen </label>
            </td><td>
        	<input type="radio" id="bezorgen" name="bezorging" value="bezorgen" onChange="updateTotal()" checked/>
            </td></tr>
		<tr><td><label for="bezorgdag">Bezorgdag</label></td><td><input type="date" name="bezorgdag" required id="bezorgdag"/></td></tr>
		<tr><td><label for="opmerking">Opmerking</label></td><td><textarea style= "height:51px;" name="opmerking" id="opmerking"></textarea></td></tr>
		<tr><td><label for="terms">Alg. Voorwaarden</label></td><td><input type="checkbox" name="terms" required id="terms"/></td></tr>
            </table>
        </div>
        <button type="">Bestellen</button>
    </form>
</div>';

include 'template.php';