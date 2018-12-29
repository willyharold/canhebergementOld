$(document).ready(function(){

    $('#price-range-submit').hide();

    $(function () {

        $("#slider-range-filter").slider({
            range: true,
            orientation: "horizontal",
            min: 0,
            max: 200000,
            values: [0, 100000],
            step: 50,
            change: function( event, ui ) {sendFilter()},

            slide: function (event, ui) {
                if (ui.values[0] == ui.values[1]) {
                    return false;
                }

                $("#min_pric").text(ui.values[0]);
                $("#max_pric").text(ui.values[1]);
            }
        });

        $("#min_pric").text($("#slider-range-filter").slider("values", 0));
        $("#max_pric").text($("#slider-range-filter").slider("values", 1));
        $("#prix_mini").val(parseInt($("#slider-range-filter").slider("values", 0)));
        $("#prix_maxi").val(parseInt($("#slider-range-filter").slider("values", 1)));

        function sendFilter(){
            $("#prix_mini").val(parseInt($("#slider-range-filter").slider("values", 0)));
            $("#prix_maxi").val(parseInt($("#slider-range-filter").slider("values", 1)));
            requette();
        };

    });

});