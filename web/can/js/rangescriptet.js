$(document).ready(function(){
	
	$(function () {
	  $("#etoile-range").slider({
		min: 1,
		max: 7,
		range: "min",
		value:4,
		step: 1,
		change: function( event, ui ) {send()},

		slide: function (event, ui) {
		  $("#etoile").text(ui.value);
		}
	  });

	  $("#etoile").text($("#etoile-range").slider("values", 1));
	  
	  // nir mod
	  function send(){
	  		// alert('Min: '+parseInt($("#slider-range").slider("values", 0))+'--- Max: '+parseInt($("#slider-range").slider("values", 1)));
	  	};

	});

});