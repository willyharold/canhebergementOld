$(function(){
	$('.srv').tooltip();
	$('.gtof').tooltip();
	$('.srve').tooltip();
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
            var pta = document.getElementById("pta").offsetTop;
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

});