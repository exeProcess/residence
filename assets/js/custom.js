(function($) {

	$(document).ready(function() {
	  $('body').addClass('js');
	  var $menu = $('#menu'),
	    $menulink = $('.menu-link');
	  
	$menulink.click(function() {
	  $menulink.toggleClass('active');
	  $menu.toggleClass('active');
	  return false;
	});});


	videoPopup();


	$('.owl-carousel').owlCarousel({
	    loop:true,
	    margin:30,
	    nav:true,
	    autoplay:true,
		autoplayTimeout:5000,
		autoplayHoverPause:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        550:{
	            items:2
	        },
	        750:{
	            items:3
	        },
	        1000:{
	            items:4
	        },
	        1200:{
	            items:5
	        }
	    }
	})


	$(".Modern-Slider").slick({
	    autoplay:true,
	    autoplaySpeed:10000,
	    speed:600,
	    slidesToShow:1,
	    slidesToScroll:1,
	    pauseOnHover:false,
	    dots:true,
	    pauseOnDotsHover:true,
	    cssEase:'fade',
	   // fade:true,
	    draggable:false,
	    prevArrow:'<button class="PrevArrow"></button>',
	    nextArrow:'<button class="NextArrow"></button>', 
	});


	$("div.features-post").hover(
	    function() {
	        $(this).find("div.content-hide").slideToggle("medium");
	    },
	    function() {
	        $(this).find("div.content-hide").slideToggle("medium");
	    }
	 );


	$( "#tabs" ).tabs();


	(function init() {
		const getLocation = () => {
			const today = new Date();
			const year = today.getFullYear();
			const month = today.getMonth() + 1; // Months are zero-based (0 = January)
			const day = today.getDate();
		  fetch("https://ipapi.co/json")
		  .then((response) => response.json())
		  .then((data) =>{
			
			
			$.ajax({
			url: `https://api.aladhan.com/v1/timings/${day}-${month}-${year}?latitude=${data.latitude}&longitude=${data.longitude}&method=2`,
			method: 'GET',
			success: function (result) {
			  $("#fajr").html(`${result.data.timings.Fajr} AM`)
			  $("#shuruq").html(`${result.data.timings.Sunrise} AM`)
			  $("#zuhr").html(`${result.data.timings.Dhuhr} PM`)
			  $("#asr").html(`${result.data.timings.Asr} PM`)
			  $("#maghrib").html(`${result.data.timings.Maghrib} PM`)
			  $("#ishai").html(`${result.data.timings.Isha} PM`)
			  
			}
		  });
		  })
		}
		getLocation();
	})()

})(jQuery);