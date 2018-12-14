
var orderUrl = document.querySelector('.order-url');
var addButtons = document.querySelectorAll('.add-to-cart');

var euroFormatter = new Intl.NumberFormat('nl-NL', {
  style: 'currency',
  currency: 'EUR',
  minimumFractionDigits: 2,
  maximumFractionDigits: 2
});

for (var i = addButtons.length - 1; i >= 0; i--) 
{
	addButtons[i].addEventListener('click', addToCart, false);
}

function addToCart(e){
	var id = e.target.getAttribute('data-id');
	var amount = getAmount(id);
	addValToCart(id, amount);
}

function addValToCart(id, amount){

	if(amount > 0 && amount < 4)
        { 
		amount = 4;
	}
	sessvars[id] = amount;
	updateCart();
	updateTotal();
}

function getPrice(id)
{
	var price = $('#prijs_'+id).html();
	price = Number(price);
	return price;
}

function getAmount(id)
{
	var amount = $('#input_'+id).val();
	return amount;
}

function getTotal(id)
{
	var total = getPrice(id) * getAmount(id);
	return total;
}

function getDeliveryFee(totalAmount)
{
    var deliveryFee = 2.5; 
    deliveryFee = Number(deliveryFee);
    var radio = $("input:checked");
    var val = $("input:checked").val();
    if(val === "ophalen" )
    {
            deliveryFee = 0;
    }
    if(totalAmount >= 25)
    {
            deliveryFee = 0;
    }
    return deliveryFee;
}

function updateCart()
{
    var totalAmount = 0;
    for (var id in sessvars) 
    {
            var amount = parseInt(sessvars[id]);
            if(amount >= 0)
        {
            totalAmount += amount;
            $('#aantal_'+id).html(amount);
            $('#input_'+id).val(amount);
            var totalPriceItem = euroFormatter.format(getTotal(id));
            $('#totaal_'+id).html(totalPriceItem);
        }
    }
    $('#shop-amount').html(totalAmount);
    $( ".shop-amount" ).each(function()
    {
        if(this.innerHTML > 0)
        {
            $(this).css("visibility", "visible");
        } 
        else 
        {
            $(this).css("visibility", "hidden");
        }
    });
    var order = sessvars; 
    var sessvarsObject = sessvars.$;
    delete order.$; 
    var order = JSON.stringify(order);
    sessvars.$ = sessvarsObject;
    var newUrl = 'bestellen.php?o=' + order;
    orderUrl.setAttribute('href', newUrl);
}

function updateTotal()
{	
    var totalAmount = 0;
    $( ".rowTotal" ).each(function() 
    {
        var id = "" + this.id;
        id = id.replace("totaal_","");
        totalAmount += getTotal(id);
    });
    var deliveryFee = getDeliveryFee(totalAmount);
    totalAmount += deliveryFee;
    var VAT = Math.round(totalAmount /106 *6 *100)/100;
    var subtotalPrice = totalAmount - VAT;
    $('#deliveryFee').html(euroFormatter.format(deliveryFee)); 
    $('#totalPrice').html(euroFormatter.format(totalAmount)); 
    $('#vat').html(euroFormatter.format(VAT)); 
    $('#subtotalPrice').html(euroFormatter.format(subtotalPrice));  
}

jQuery(document).ready(function($) 
{
    updateCart();
    updateTotal();
});
