/*
*****************************************************
*	CUSTOM JS DOCUMENT                              *
*	Single window load event                        *
*   "use strict" mode on                            *
*****************************************************
*/
$(window).on("load", function() {
	
	"use strict";
		   
	
    var countNumber= $(".count-number");
	var fancybox =  $('.fancybox');
	var preLoader = $('.preloader');
	var faq = $('.faqs');
	var comingSoonTimer = $('#coming-soon-timer');
	var fancyboxIframe = $('.fancybox-iframe');
    var tabLinks = $('.tablinks');
    var rangeSliderOne = $( "#slider-range-one" );
    var rangeSliderTwo = $( "#slider-range-two" );
    var rangeSliderThree = $( "#slider-range-three" );
	

	countNumber.appear(function() {
		$(this).each(function() {
			var datacount = $(this).attr('data-count');
			$(this).find('.counter').delay(6000).countTo({
				from: 10,
				to: datacount,
				speed: 3000,
				refreshInterval: 50,
			});
		});
	});	
	
// ============================================
// PreLoader On window Load
// =============================================
		if(preLoader.length) {	 
		 preLoader.addClass('loaderout');
	    }
         

//========================================
// LightBox / Fancybox
//======================================== 	
	
	if(fancybox.length) {
		 fancybox.fancybox();
	}


	if(fancyboxIframe.length) {
		fancyboxIframe.fancybox({
			type: "iframe",
			// other API options
		});
}
//========================================
// Accordion functions Calling
//======================================== 	
 
 	if(faq.length){   
		faq.accordion();
	}


//========================================
// Coming Soon Setting
//======================================== 	

    if (comingSoonTimer.length) {
        comingsoonInt();
    }
	
//========================================
// Owl Carousel functions Calling
//======================================== 	
 
	owlCarouselInit();  	
	
	
    //========================================
    // Tabs Settings
    //======================================== 	

    tabLinks.on('click', function() {
        var dataId = $(this).attr('data-id');
        tabCustom(event, dataId);
    });
	
	if(rangeSliderOne.length){
	 rangeSliderOne.slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( "#amount1" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount1" ).val( "$" + rangeSliderOne.slider( "values", 0 ) +
      " - $" + rangeSliderOne.slider( "values", 1 ) );
	 
	}
	
	if(rangeSliderTwo.length){
	 $( "#slider-range-two" ).slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( "#amount2" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount2" ).val( "$" + rangeSliderTwo.slider( "values", 0 ) +
      " - $" + rangeSliderTwo.slider( "values", 1 ) );

	}
	  
	  
	  if(rangeSliderThree.length){
	   rangeSliderThree.slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( "#amount3" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount3" ).val( "$" + rangeSliderThree.slider( "values", 0 ) +
      " - $" + rangeSliderThree.slider( "values", 1 ) );
	  }
	  
	  
});




//========================================
// Owl Carousel functions
//======================================== 	

function owlCarouselInit() {
	
	"use strict";	
	
//========================================
// owl carousels settings
//======================================== 		
	var mainSlider = $('#main-slider');
	var collectionSlider = $('#collection-slider');
	var customerSlider = $('#customer-slider');
	var teamSlider = $('#team-slider');
	var blogSlider = $('#blog-slider');
	var partnerSlider = $('#partner-slider');
	var nextNav = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
    var prevNav = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
	
		if(mainSlider.length) {	
		 mainSlider.owlCarousel({
				loop:true,
				margin:0,
				nav:false,
				dots:true,
				autoplay:true,
				autoplayTimeout:3000,
				autoplayHoverPause:true,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:1
					},
					1000:{
						items:1
					}
				}
			});
		}
		
		if(collectionSlider.length) {	
		 collectionSlider.owlCarousel({
				 loop:true,
				margin:0,
				nav:true,
				navText: [prevNav, nextNav],
				dots:false,
				autoplay:false,
				autoplayTimeout:3000,
				autoplayHoverPause:true,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:3
					},
					1000:{
						items:4
					}
				}
			});
		}
		
		if(teamSlider.length) {	
		 teamSlider.owlCarousel({
				loop:true,
				margin:0,
				nav:false,
				navText: [prevNav, nextNav],
				dots:false,
				autoplay:true,
				autoplayTimeout:3000,
				autoplayHoverPause:true,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:2
					},
					1000:{
						items:4
					}
				}
			});
		}
		
		if(customerSlider.length) {	
		 customerSlider.owlCarousel({
				loop:true,
				margin:0,
				nav:false,
				dots:true,
				autoplay:true,
				autoplayTimeout:3000,
				autoplayHoverPause:true,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:1
					},
					1000:{
						items:2
					}
				}
			});
		}
		if(blogSlider.length) {	
		 blogSlider.owlCarousel({
				loop:true,
				margin:0,
				nav:true,
				navText: [prevNav, nextNav],
				dots:false,
				autoplay:false,
				autoplayTimeout:3000,
				autoplayHoverPause:true,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:2
					},
					1000:{
						items:2
					}
				}
			});
		}
		
		if(partnerSlider.length) {	
		 partnerSlider.owlCarousel({
				loop:true,
				margin:0,
				nav:false,
				navText: [prevNav, nextNav],
				dots:false,
				autoplay:true,
				autoplayTimeout:3000,
				autoplayHoverPause:true,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:2
					},
					1000:{
						items:4
					}
				}
			});
		}

	
}

//========================================
// Tabs function settings
//======================================== 
function tabCustom(evt, dataId) {

    "use strict";

    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(dataId).style.display = "block";
    evt.currentTarget.className += " active";


}


function comingsoonInt() {
    "use strict";


    // Set the date we're counting down to
    var countDownDate = new Date("Dec 24, 2017 15:37:25").getTime();
   
    var x = setInterval(function() {

      
        var now = new Date().getTime();    
        var distance = countDownDate - now;
        
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        
        document.getElementById("days").innerHTML = days;

        document.getElementById("hours").innerHTML = hours;

        document.getElementById("seconds").innerHTML = seconds;

        document.getElementById("minutes").innerHTML = minutes;


    }, 1000);

}




/*
*****************************************************
*	END OF THE JS 									*
*	DOCUMENT                       					*
*****************************************************
*/

