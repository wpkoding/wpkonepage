jQuery("document").ready(function($){

	$('a[href*="#"]')
	  .not('[href="#"]')
	  .not('[href="#0"]')
	  .click(function(event) {
	    if (
	      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
	      && 
	      location.hostname == this.hostname
	    ) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
	      if (target.length) {
	        event.preventDefault();
	        $('html, body').animate({
	          scrollTop: target.offset().top
	        }, 700, function() {
	          var $target = $(target);
	          $target.focus();
	          if ($target.is(":focus")) {
	            return false;
	          } else {
	            $target.attr('tabindex','-1');
	            $target.focus();
	          };
	        });
	      }
	    }
	  });

	var nav = $('#navigation');

	$(window).scroll(function () {
		if ($(this).scrollTop() > 653) {
			nav.addClass("fixed-top");
			$('#about-us').css('padding-top','171px');
		} else {
			nav.removeClass("fixed-top");
			$('#about-us').css('padding-top','115px');
		}
	});

	$('#filter')
		.prepend( "<span id='filter-reset'>All</span>" )
		.tagSort({
			items:'.item-to-filter',
			reset:'#filter-reset'
		});

	$('#contact-form').validator({
		feedback: {
			success: 'fa-check',
			error: 'fa-times'
		}
	}).on('submit', function (e) {
		$('#contact-form .alert').css('display','none');
		if (!e.isDefaultPrevented()) {
		  	e.preventDefault();

		  	dt = $(this).serialize();

		  	$.ajax({
				method: "POST",
				url: wpkonepage.ajaxurl,
				data: { action: "wpkonepage_contact_form", nonce: wpkonepage.ajaxnonce, dt: dt },
				beforeSend: function( xhr ) {
					$('#contact-form .fa-spinner').css('display','inline-block');
					$('#contact-form .btn').prop( "disabled", true );
				}
			})
			.done(function( response ) {
				$('#contact-form .fa-spinner').css('display','none');
				$('#contact-form .btn').prop( "disabled", false );
				if (response) {
					$('#contact-form').trigger("reset");
					$('#contact-form .alert-success').css('display','block');
				} else {
					$('#contact-form .alert-danger').css('display','block');
				}
			});
		}
	});

	$(".navbar-collapse ul li a").on("click", function () {
		$('.collapse').collapse('hide');
	});
});
