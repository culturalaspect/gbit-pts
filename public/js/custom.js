$('.count_counter').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});

//---------------------------------
$(document).ready(function(){
	$('#search_expander_btn').click(function(){
		$checkVal = false;
		var div = $("#search_form");
        startAnimation();
        function startAnimation(){
        	$checkVal = true;
        	$('#search_expander_btn').hide();
        	div.removeClass('hidden');
        	div.show();
        }

        function endAnimation(){
        	if($checkVal == true)
        	{
        		$('#search_expander_btn').show();
	            div.hide('slow');
	            $checkVal = false;
	            clearInterval(staringTimer);
        	}
        }
        $('#search_form input').on('focusin', function(){
        	clearInterval(staringTimer);
        	var selectedElem = $('#search_form');
        	selectedElem.show();
        	selectedElem.removeClass('hidden');
        });
        $('#search_form input').on('focusout', function(){
        	clearInterval(staringTimer);
        	staringTimer = setInterval(endAnimation, 10000);
        });
        var staringTimer = setInterval(endAnimation, 10000);
	});
});


/*$(document).ready(function(){
	
	$(window).scroll(function(){
		
		$scroll_pos = $(window).scrollTop();
		if($scroll_pos > 10)
		{
			$('#bottom_fixed_header').slideUp();
			$('#bottom_moveable_header').slideDown();
		}
		else
		{
			$('#bottom_moveable_header').slideUp();
			$('#bottom_fixed_header').slideDown();
		}
	});
});*/

/*$(document).ready(function(){
	$scroll_pos = $(window).scrollTop();
	if($scroll_pos > 10)
	{
		$('#bottom_fixed_header').hide();
		$('#bottom_moveable_header').show();
	}
	else
	{
		$('#bottom_moveable_header').hide();
		$('#bottom_fixed_header').show();
	}
});*/


$(document).ready(function(){
	$('.slider_content').slick({
          dots: false,
		  infinite: false,
		  speed: 300,
		  slidesToShow: 3,
		  slidesToScroll: 3,
		  adaptiveHeight: true,
		  variableWidth: true,
		  autoplay: true,
  		  autoplaySpeed: 2000,
  		  prevArrow:'<button type="button" class="hidden" id="prevBtn_slider_vendor_hidden" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button">Previous</button>',
		  nextArrow:'<button type="button" class="hidden" id="nextBtn_slider_vendor_hidden" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button">Next</button>',
		  responsive: [
		  	{
		      breakpoint: 1200,
		      settings: {
		        slidesToShow: 4,
		        slidesToScroll: 4,
		        infinite: true
		      }
		    },
		    {
		      breakpoint: 960,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 3,
		        infinite: true
		      }
		    },
		    {
		      breakpoint: 768,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 2
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    },
		    {
		      breakpoint: 320,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		    // You can unslick at a given breakpoint now by adding:
		    // settings: "unslick"
		    // instead of a settings object
		  ]
    });

    $('#prevBtn_slider_vendor').click(function(){
		$('#prevBtn_slider_vendor_hidden').click();
	});

	$('#nextBtn_slider_vendor').click(function(){
		$('#nextBtn_slider_vendor_hidden').click();
	});
});




$(document).ready(function(){
	$('.slider_content_bottom').slick({
          dots: false,
		  infinite: false,
		  speed: 300,
		  slidesToShow: 5,
		  slidesToScroll: 4,
		  adaptiveHeight: true,
		  variableWidth: true,
		  prevArrow:'<button type="button" class="hidden" id="prevBtn_slider_hidden" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button">Previous</button>',
		  nextArrow:'<button type="button" class="hidden" id="nextBtn_slider_hidden" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button">Next</button>',
		  autoplay: true,
  		  autoplaySpeed: 2000,
		  responsive: [
		    {
		      breakpoint: 1200,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 3,
		        infinite: true
		      }
		    },
		    {
		      breakpoint: 960,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 3,
		        infinite: true
		      }
		    },
		    {
		      breakpoint: 768,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 2
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    },
		    {
		      breakpoint: 320,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		    // You can unslick at a given breakpoint now by adding:
		    // settings: "unslick"
		    // instead of a settings object
		  ]
    });

	$('#prevBtn_slider').click(function(){
		$('#prevBtn_slider_hidden').click();
	});

	$('#nextBtn_slider').click(function(){
		$('#nextBtn_slider_hidden').click();
	});
});

$(document).ready(function(){
	$('.slider_content_bottom_vendor').slick({
          dots: false,
		  infinite: false,
		  speed: 300,
		  slidesToShow: 2,
		  slidesToScroll: 1,
		  adaptiveHeight: true,
		  variableWidth: true,
		  prevArrow:'<button type="button" class="hidden" id="prevBtn_slider_vendor_hidden" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button">Previous</button>',
		  nextArrow:'<button type="button" class="hidden" id="nextBtn_slider_vendor_hidden" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button">Next</button>',
		  autoplay: true,
  		  autoplaySpeed: 2000,
		  responsive: [
		    {
		      breakpoint: 1200,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 3,
		        infinite: true,
		        dots:true
		      }
		    },
		    {
		      breakpoint: 960,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 3,
		        infinite: true,
		        dots:true
		      }
		    },
		    {
		      breakpoint: 768,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 2,
		        dots:true
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    },
		    {
		      breakpoint: 320,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		    // You can unslick at a given breakpoint now by adding:
		    // settings: "unslick"
		    // instead of a settings object
		  ]
    });

	$('#prevBtn_slider_vendor').click(function(){
		$('#prevBtn_slider_vendor_hidden').click();
	});

	$('#nextBtn_slider_vendor').click(function(){
		$('#nextBtn_slider_vendor_hidden').click();
	});
});

$(document).ready(function(){
	$('.slider_content_bottom_partner').slick({
          dots: false,
		  infinite: false,
		  speed: 300,
		  slidesToShow: 2,
		  slidesToScroll: 1,
		  adaptiveHeight: true,
		  variableWidth: true,
		  prevArrow:'<button type="button" class="hidden" id="prevBtn_slider_partner_hidden" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button">Previous</button>',
		  nextArrow:'<button type="button" class="hidden" id="nextBtn_slider_partner_hidden" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button">Next</button>',
		  autoplay: true,
  		  autoplaySpeed: 2000,
		  responsive: [
		    {
		      breakpoint: 1200,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 3,
		        infinite: true,
		        dots:true
		      }
		    },
		    {
		      breakpoint: 960,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 3,
		        infinite: true,
		        dots:true
		      }
		    },
		    {
		      breakpoint: 768,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 2,
		        dots:true
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    },
		    {
		      breakpoint: 320,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		    // You can unslick at a given breakpoint now by adding:
		    // settings: "unslick"
		    // instead of a settings object
		  ]
    });

	$('#prevBtn_slider_partner').click(function(){
		$('#prevBtn_slider_partner_hidden').click();
	});

	$('#nextBtn_slider_partner').click(function(){
		$('#nextBtn_slider_partner_hidden').click();
	});
});


$(document).ready(function(){
	$('.slider_content1').slick({
          dots: false,
		  infinite: false,
		  speed: 300,
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  adaptiveHeight: true,
		  variableWidth: true,
		  autoplay: true,
  		  autoplaySpeed: 2000,
  		  responsive: [
		  	{
		      breakpoint: 1200,
		      settings: {
		        slidesToShow: 4,
		        slidesToScroll: 4,
		        infinite: true
		      }
		    },
		    {
		      breakpoint: 960,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 3,
		        infinite: true
		      }
		    },
		    {
		      breakpoint: 768,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 2
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    },
		    {
		      breakpoint: 320,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		    // You can unslick at a given breakpoint now by adding:
		    // settings: "unslick"
		    // instead of a settings object
		  ]
    });
});