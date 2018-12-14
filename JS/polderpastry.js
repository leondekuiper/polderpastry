jQuery(document).ready(function($) {
  var alterClass = function() {
	if (window.matchMedia('(max-width: 440px)').matches) {
        $('#nav-1-a').addClass('fas fa-home col-3');
        $('#nav-2-a').addClass('fas fa-list col-3');
        $('#nav-3-a').addClass('fas fa-cart-arrow-down col-3');
        $('#nav-4-a').addClass('fas fa-info col-3');
    } else if (window.matchMedia('(min-width: 441px)').matches) {
        $('#nav-1-a').removeClass('fas fa-home col-3');
        $('#nav-2-a').removeClass('fas fa-list col-3');
        $('#nav-3-a').removeClass('fas fa-cart-arrow-down col-3');
        $('#nav-4-a').removeClass('fas fa-info col-3');
    };
  };
  $(window).resize(function(){
    alterClass();
  });
  //Fire it when the page first loads:
  alterClass();
});