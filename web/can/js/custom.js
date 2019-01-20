var geolocation;
var local = false;
var equipement = [];
var proximite = [];
var service = [];

$(function(){
    $('.srv').tooltip();
    $('.gtof').tooltip();
    $('.srve').tooltip();
    var otherSrv = [];
    var otherSrva=[];

    $('.close-carte').click(function(e){
        e.preventDefault();
        $(this).parent('.carte-clo-cont').parent('.desc').removeClass('this-opa').addClass('this-nopa');
    });
    $('.open-carte').click(function(e){
        e.preventDefault();
        $(this).parent().find('.desc').removeClass('this-nopa').addClass('this-opa');
    });

    $("#rechBtn").click(function(e){

        if($('#longitude').val()=="" || !local){
            e.preventDefault();
            $("#autocomplete").focus();
            $('#autocomplete').addClass('brd-help')
        }
    });

    $('#autocomplete').on('change',function(){
        local = false;
    });

    $('.rsvt').click(function(e){
        e.preventDefault();
        $(".logn").fadeIn(500);
        $('.lognc').delay(500).fadeIn();
    });
    $('.clsl').click(function(){
        $(".lognc").fadeOut();
        $(".logn").delay(200).fadeOut();
    });
    $('.srvcs').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        $(this).next('.lss').velocity({
            top:[160,115],
            opacity:[1,0]
        },{
            duration:350,
            display:'block',
            easing:[70,8]
        });
    });
    $('.lss').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        $(this).velocity({
            top:[115,150],
            opacity:[0,1]
        },{
            duration:300,
            display:'none',
            easing:[70,8]
        });
    });
    scroll();
    scrolli();
    $(window).scroll(function(){
        scroll();
        scrolli();
    });
    console.log($('.ui-slider-handle'));
    $(".ui-slider-handle").click(function(){
        alert('bo');
    });
    $('.toTop').click(function(){
        $('html, body').stop().animate({
            scrollTop: 0
        }, 350, 'swing');
        return false;
    });
    $(".cls-mn").click(function(){
        $('.flo').removeClass('menlatflo');
        $('.menlatX').removeClass('menlat').addClass('menlat0');
    });
    $(".flo").click(function(){
        $(this).removeClass('menlatflo');
        $('.menlatX').removeClass('menlat').addClass('menlat0');
    });
    $(".openm").click(function(){
        $('.menlatX').removeClass('menlat0').addClass('menlat');
        $('.flo').addClass('menlatflo');
    });
    $(".lgmt").click(function(e){
        e.preventDefault();
        // $('.smcnt').show().removeClass('sousmenuz').addClass('sousmenu');
        $('.smcnt').velocity({top:[50,64],opacity:[1,0]},{display:'block',duration: 100,easing: "ease-out"});
    });
    $(".lgmt").focusout(function(e){
        // $('.smcnt').removeClass('sousmenu').addClass('sousmenuz');
        $('.smcnt').velocity({top:[64,50],opacity:[0,1]},{duration: 100,easing: "ease-in",display:'none',});
    });
    $("#etoile").focus(function(e){
        $('.etoile').velocity({top:[50,64],opacity:[1,0]},{display:'block',duration: 100,easing: "ease-out"});
    });
    $("#etoile").focusout(function(e){
        $('.etoile').velocity({top:[64,50],opacity:[0,1]},{duration: 100,easing: "ease-in",complete:function(){if($('.et:focus').text() != ""){$('#etoile').val($('.et:focus').attr('val'));};},display:'none',});
    });
    $(".et").click(function(e){
        e.preventDefault();
    });
    $("#flt-etl").focus(function(e){
        $('.flt-etl').velocity({top:[50,64],opacity:[1,0]},{display:'block',duration: 100,easing: "ease-out"});
    });
    $("#flt-etl").focusout(function(e){
        $('.flt-etl').velocity({top:[64,50],opacity:[0,1]},{duration: 100,easing: "ease-in",complete:function(){if($('.flt-et:focus').text() != ""){$('#flt-etl').val($('.flt-et:focus').attr('val'));requette()};},display:'none',});
    });
    $(".flt-et").click(function(e){
        e.preventDefault();
    });
    $("#ville").focus(function(e){
        $('.ville').velocity({top:[50,64],opacity:[1,0]},{display:'block',duration: 100,easing: "ease-out"});
    });
    $("#ville").focusout(function(e){
        $('.ville').velocity({top:[64,50],opacity:[0,1]},{duration: 100,easing: "ease-in",complete:function(){if($('.vl:focus').text() != ""){$('#ville').val($('.vl:focus').text().toLowerCase());};},display:'none',});
    });
    $(".vl").click(function(e){
        e.preventDefault();
        // $('#ville').val($(this).text());
    });
    $("#flt-type").focus(function(e){
        $('.flt-type').velocity({top:[50,64],opacity:[1,0]},{display:'block',duration: 100,easing: "ease-out"});
    });
    $("#flt-type").focusout(function(e){
        $('.flt-type').velocity({top:[64,50],opacity:[0,1]},{duration: 100,easing: "ease-in",complete:function(){if($('.flt-ty:focus').text() != ""){$('#flt-type').val($('.flt-ty:focus').text().toLowerCase());requette();};},display:'none',});
    });
    $(".flt-ty").click(function(e){
        e.preventDefault();
    });
    $("#direct").focus(function(e){
        $('.direct').velocity({top:[50,64],opacity:[1,0]},{display:'block',duration: 100,easing: "ease-out"});
    });
    $("#direct").focusout(function(e){
        $('.direct').velocity({top:[64,50],opacity:[0,1]},{duration: 100,easing: "ease-in",complete:function(){if($('.dt:focus').text() != ""){$('#direct').val($('.dt:focus').text().toLowerCase());};},display:'none',});
    });
    $(".dt").click(function(e){
        e.preventDefault();
    });
    // hotel click
    $('.conthtl').click(function(){
        var lien= $(this).attr('id');
        window.location = lien;
    });
    $('.vsht').click(function(){
        var lien= $(this).find('a.lien[href]').attr('href');
        window.location = lien;
    });
    $(".slider").bxSlider({
        mode: 'fade',
        auto:true,
        controls:true,
        pager:false,
        pause: 9000,
        autoHover:true,
        responsive:false,
        speed:900,
        slideSelector:'div.sl',
    });
    $(".slp").bxSlider({
        mode: 'horizontal',
        auto:true,
        moveSlides: 1,
        infiniteLoop: true,
        slideWidth: 1800,
        minSlides: 3,
        maxSlides: 4,
        speed: 500,
        controls:false,
        pager:false,
    });
    $('.lgc').click(function(){
        $('.mltsm').toggleClass('mltsmno');
    });
    var scrolli = function() {
        $(window).scroll(function() {
            if ($(this).scrollTop()>600) {
                $('.toTop').fadeIn();
            } else {
                $('.toTop').fadeOut();
            }
        });

        $('.toTop').on('click', function(){
            $('html, body').stop().animate({
                scrollTop: 0
            }, 650, 'swing');
            return false;
        });
    };

    $('.tris').mouseover(function(){
        $(this).find('.txs').addClass('cl3');
    }).mouseout(function(){
        $(this).find('.txs').removeClass('cl3');
    }).click(function(){
        $(this).find('.chk').trigger('click');

    });
    $('.chk').click(function(e){
        e.stopPropagation();
        if(!local){$("#autocomplete").focus();$('#autocomplete').addClass('brd-help');}
        else{$('#autocomplete').removeClass('brd-help');}
        checkfiltre($(this));
        requette();
    });
    $('.critaire').click(function(){
        $(this).next().toggle('fast');
        if($(this).find('.drl').text()=='add'){
            $(this).find('.drl').text('remove');
            return 0;
        }
        $(this).find('.drl').text('add');
    }).mouseover(function(){
        $(this).addClass('cl3');
    }).mouseout(function(){
        $(this).removeClass('cl3');
    });

    function scrolli(){
        if ($(window).scrollTop()>500) {
            $('.toTop').fadeIn();
        } else {
            $('.toTop').fadeOut();
        }
    }
    function scroll(){
        var scroll=document.documentElement.scrollTop || document.body.scrollTop;
        //var pta = (document.getElementById("pta").offsetTop) ;
        if(scroll >= 30){
            $('.headTop2').addClass("headTop");
            $('.headTop').removeClass('headTop2');
        }else{
            $('.headTop').addClass("headTop2");
            $('.headTop2').removeClass('headTop');
        }
        var v= $(".couv2").height()-$("#pta").height();
        if(scroll >= (v-100)){
            // var tail = $('.headTop').height();
            $('#pta').addClass("ptaf").css({'top':60})
                .removeClass('ptab');
        }else{
            $('#pta').removeClass('ptaf').css({'top':0}).
            addClass('ptab');
        }
    }


    $(".add-srv").click(function(e){
        e.preventDefault();
        if($("#other").val()){
            if(otherSrv.indexOf($("#other").val()) == -1){

                var serviceName = '';
                var v = $("#other").val().length;
                if(v > 12)
                    serviceName = $("#other").val().substr(0,12)+'...';
                else
                    serviceName = $("#other").val();

                otherSrv.push($("#other").val());
                var aword= $("#other").val().replace(/ /g,"");


                $('#lst-srv').append('<div class=" mt-2 mb-2 col-md-4">'+
                    '<input class="point chk"  type="checkbox" checked="checked" value="" name="'+aword+'-s" id="'+aword+'-s">'+
                    '<label class="point txs pl-2" for="'+aword+'-s">'+serviceName+'</label>'+
                    '<div ><input type="file" onchange="vari(event);" name="'+aword+'-p" id="'+aword+'-p" class="inputfiles" data-multiple-caption="{count} fichier selectionné" multiple />'+
                    '<label for="'+aword+'-p" class="point fchr cl8"><svg xmlns="http://www.w3.org/2000/svg" width="13" height="10" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg>'+
                    '<span class="ml-2 dpb2">Photos&hellip;</span></label></div></div> ');
            }
            $("#other").val('');
        }
    });
    $(".add-srv-a").click(function(e){
        e.preventDefault();
        if($("#other-a").val()){
            if(otherSrva.indexOf($("#other-a").val()) == -1){

                var serviceName = '';
                var v = $("#other-a").val().length;
                if(v > 12)
                    serviceName = $("#other-a").val().substr(0,12)+'...';
                else
                    serviceName = $("#other-a").val();

                otherSrva.push($("#other-a").val());
                var aword= $("#other-a").val().replace(/ /g,"");

                $('#lst-srv-a').append('<div class=" mt-2 mb-2 col-md-4">'+
                    '<input class="point chk"  type="checkbox" checked="checked" value="" name="'+aword+'-s" id="'+aword+'-s">'+
                    '<label class="point txs pl-2" for="'+aword+'-s">'+serviceName+'</label></div>');
            }
            $("#other-a").val('');
        }
    });
    $( '.inputfile' ).each( function()
    {
        var $input	 = $( this ),
            $label	 = $input.next( 'label' ),
            labelVal = $label.html();

        $input.on( 'change', function( e )
        {
            var fileName = '';

            if( e.target.value ){
                var v= e.target.value.length;
                if(v > 18){
                    var ext = e.target.value.split( '\\' ).pop().split( '.' ).pop();
                    fileName = e.target.value.split( '\\' ).pop().substr(0,18).split( '.' )+' ... '+ext;
                }
                else
                    fileName = e.target.value.split( '\\' ).pop();
            }

            if( fileName )
                $label.find( 'span' ).html( fileName );
            else
                $label.html( labelVal );
        });
    });
    $( '.inputfiles' ).each( function()
    {
        var $input	 = $( this ),
            $label	 = $input.next( 'label' ),
            labelVal = $label.html();


        $input.on( 'change', function( e )
        {
            var fileName = '';
            if( this.files && this.files.length > 1 )
                fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
            else if( e.target.value ){
                var v= e.target.value.length;
                if(v > 18){
                    var ext = e.target.value.split( '\\' ).pop().split( '.' ).pop();
                    fileName = e.target.value.split( '\\' ).pop().substr(0,18).split( '.' )+' ... '+ext;
                }
                else
                    fileName = e.target.value.split( '\\' ).pop();
            }

            if( fileName )
                $label.find( 'span' ).html( fileName );
            else
                $label.html( labelVal );
        });
    });
    $("#type-eta").focus(function(e){
        $('.type-eta').velocity({top:[80,90],opacity:[1,0]},{display:'block',duration: 100,easing: "ease-in"});
    });

    $("#type-eta").focusout(function(e){
        $('.type-eta').velocity({top:[90,80],opacity:[0,1]},{duration: 100,easing: "ease-out",complete:function(){if($('.typ-eta:focus').text() != ""){$('#type-eta').val($('.typ-eta:focus').text().toLowerCase());};},display:'none',});
    });
    $(".typ-eta").click(function(e){
        e.preventDefault();
    });
    $("#etoile-eta").focus(function(e){
        $('.etoile-eta').velocity({top:[80,90],opacity:[1,0]},{display:'block',duration: 100,easing: "ease-out"});
    });
    $("#etoile-eta").focusout(function(e){
        $('.etoile-eta').velocity({top:[90,80],opacity:[0,1]},{duration: 100,easing: "ease-in",complete:function(){if($('.et-eta:focus').text() != ""){$('#etoile-eta').val($('.et-eta:focus').attr('val'));};},display:'none',});
    });
    $(".et-eta").click(function(e){
        e.preventDefault();
    });

    $('.js-datepicker1,.js-datepicker2').datepicker({
        weekStart: 1,
        format:'mm/dd/yyyy',
        autoclose: true,
        todayHighlight: true,
        language:'fr',
    });


});

function vari(e){
    var $input = $('#'+e.target.id),
        $label	 = $input.next( 'label' ),
        labelVal = $label.html();
    var fileName = '';
    if( e.target.files && e.target.files.length > 1 )
        fileName = ( e.target.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', e.target.files.length );
    else if( e.target.value ){
        var v= e.target.value.length;
        if(v > 18){
            var ext = e.target.value.split( '\\' ).pop().split( '.' ).pop();
            fileName = e.target.value.split( '\\' ).pop().substr(0,18).split( '.' )+' ... '+ext;
        }
        else
            fileName = e.target.value.split( '\\' ).pop();
    }

    if( fileName )
        $label.find( 'span' ).html( fileName );
    else
        $label.html( labelVal );
}
function initAutocomplete() {
    var autocomplete = new google.maps.places.Autocomplete(
        (document.getElementById('autocomplete')),{types: ['(regions)']});

    autocomplete.addListener('place_changed', function(){
        var place = autocomplete.getPlace();

        local = true;

        geolocation = {
            lat: place.geometry.location.lng(),
            lng: place.geometry.location.lat()
        };

        requette();

    });
}
function initAutocomplete2() {
    var autocomplete = new google.maps.places.Autocomplete(
        (document.getElementById('autocomplete')),{types: ['(regions)']});

    autocomplete.addListener('place_changed', function(){
        var place = autocomplete.getPlace();

        local = true;
        $('#autocomplete').removeClass('brd-help')

        $("#latitude").val(place.geometry.location.lat());
        $("#longitude").val(place.geometry.location.lng());


    });
}

function checkfiltre(elm){

    var chkattr = elm.attr('chkattr');

    if(elm.is(':checked'))
    {
        if(chkattr == 'eq'){
            equipement.push(elm.val());
        }
        if(chkattr == 'prx'){
            proximite.push(elm.val());
        }
        if(chkattr == 'svc'){
            service.push(elm.val());
        }

    }else{
        var pos;
        if(chkattr == 'eq'){
            pos = equipement.indexOf(chkattr);
            equipement.splice(pos,1);
        }
        if(chkattr == 'prx'){
            pos = proximite.indexOf(chkattr);
            proximite.splice(pos,1);
        }
        if(chkattr == 'svc'){
            pos = service.indexOf(chkattr);
            service.splice(pos,1);
        }

    }
}

