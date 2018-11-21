$(document).ready(function(){
	
	$('#price-range-submit').hide();

	$(function () {
	  $("#slider-range").slider({
		range: true,
		orientation: "horizontal",
		min: 0,
		max: 500000,
		values: [100000, 350000],
		step: 50,
		change: function( event, ui ) {send()},

		slide: function (event, ui) {
		  if (ui.values[0] == ui.values[1]) {
			  return false;
		  }

		  $("#min_pric").text(ui.values[0]);
		  $("#max_pric").text(ui.values[1]);
		}
	  });

	  $("#min_pric").text($("#slider-range").slider("values", 0));
	  $("#max_pric").text($("#slider-range").slider("values", 1));
	  
	  // nir mod
	  function send(){
	  		// alert('Min: '+parseInt($("#slider-range").slider("values", 0))+'--- Max: '+parseInt($("#slider-range").slider("values", 1)));
	  	};

	});

});