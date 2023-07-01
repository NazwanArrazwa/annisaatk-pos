(function ($) {
	"use strict";
  
	$(document).ready(function () {
  
	  // PRE LOADER
	  $(window).on('load', function () {
		$('.preloader').fadeOut(1000); // set duration in milliseconds    
	  });
  
	  $(window).scroll(function () {
		var scroll = $(window).scrollTop();
		var box = $('.header-text').height();
		var header = $('header').height();
  
		if (scroll >= box - header) {
		  $("header").addClass("background-header");
		} else {
		  $("header").removeClass("background-header");
		}
	  });
  
	  $('.filters ul li').click(function () {
		$('.filters ul li').removeClass('active');
		$(this).addClass('active');
  
		var data = $(this).attr('data-filter');
		$grid.isotope({
		  filter: data
		});
	  });
  
	  var $grid = $(".grid").isotope({
		itemSelector: ".all",
		percentPosition: true,
		masonry: {
		  columnWidth: ".all"
		}
	  });
  
	  const Accordion = {
		settings: {
		  // Expand the first item by default
		  first_expanded: false,
		  // Allow items to be toggled independently
		  toggle: false
		},
  
		openAccordion: function (toggle, content) {
		  if (content.children.length) {
			toggle.classList.add("is-open");
			let final_height = Math.floor(content.children[0].offsetHeight);
			content.style.height = final_height + "px";
		  }
		},
  
		closeAccordion: function (toggle, content) {
		  toggle.classList.remove("is-open");
		  content.style.height = 0;
		},
  
		init: function (el) {
		  const _this = this;
  
		  // Override default settings with classes
		  let is_first_expanded = _this.settings.first_expanded;
		  if (el.classList.contains("is-first-expanded")) is_first_expanded = true;
		  let is_toggle = _this.settings.toggle;
		  if (el.classList.contains("is-toggle")) is_toggle = true;
  
		  // Loop through the accordion's sections and set up the click behavior
		  const sections = el.getElementsByClassName("accordion");
		  const all_toggles = el.getElementsByClassName("accordion-head");
		  const all_contents = el.getElementsByClassName("accordion-body");
		  for (let i = 0; i < sections.length; i++) {
			const section = sections[i];
			const toggle = all_toggles[i];
			const content = all_contents[i];
  
			// Click behavior
			toggle.addEventListener("click", function (e) {
			  if (!is_toggle) {
				// Hide all content areas first
				for (let a = 0; a < all_contents.length; a++) {
				  _this.closeAccordion(all_toggles[a], all_contents[a]);
				}
  
				// Expand the clicked item
				_this.openAccordion(toggle, content);
			  } else {
				// Toggle the clicked item
				if (toggle.classList.contains("is-open")) {
				  _this.closeAccordion(toggle, content);
				} else {
				  _this.openAccordion(toggle, content);
				}
			  }
			});
  
			// Expand the first item
			if (i === 0 && is_first_expanded) {
			  _this.openAccordion(toggle, content);
			}
		  }
		}
	  };
  
	  (function () {
		// Initiate all instances on the page
		const accordions = document.getElementsByClassName("accordions");
		for (let i = 0; i < accordions.length; i++) {
		  Accordion.init(accordions[i]);
		}
	  })();
  
	  $(document).on("click", ".naccs .menu div", function () {
		var numberIndex = $(this).index();
  
		if (!$(this).hasClass("active")) {
		  $(".naccs .menu div").removeClass("active");
		  $(".naccs ul li").removeClass("active");
  
		  $(this).addClass("active");
		  $(".naccs ul").find("li:eq(" + numberIndex + ")").addClass("active");
  
		  var listItemHeight = $(".naccs ul")
			.find("li:eq(" + numberIndex + ")")
			.innerHeight();
		  $(".naccs ul").height(listItemHeight + "px");
		}
	  });
  
	  $('.owl-testimonials').owlCarousel({
		items: 1,
		loop: true,
		dots: true,
		nav: false,
		autoplay: true,
		margin: 15,
		responsive: {
		  0: {
			items: 1
		  },
		  600: {
			items: 1
		  },
		  1000: {
			items: 1
		  }
		}
	  });
  
	  // Menu Dropdown Toggle
	  if ($('.menu-trigger').length) {
		$(".menu-trigger").on('click', function () {
		  $(this).toggleClass('active');
		  $('.header-area .nav').slideToggle(200);
		});
	  }
  
	  // Menu elevator animation
	  $('.scroll-to-section a[href*=\\#]:not([href=\\#])').on('click', function () {
		if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
		  var target = $(this.hash);
		  target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
		  if (target.length) {
			var width = $(window).width();
			if (width < 991) {
			  $('.menu-trigger').removeClass('active');
			  $('.header-area .nav').slideUp(200);
			}
			$('html,body').animate({
			  scrollTop: (target.offset().top) - 80
			}, 700);
			return false;
		  }
		}
	  });
  
	  $(document).on("scroll", onScroll);
  
	  //smoothscroll
	  $('.scroll-to-section a[href^="#"]').on('click', function (e) {
		e.preventDefault();
		$(document).off("scroll");
  
		$('.scroll-to-section a').each(function () {
		  $(this).removeClass('active');
		});
		$(this).addClass('active');
  
		var target = this.hash,
		  menu = target;
		var target = $(this.hash);
		$('html, body').stop().animate({
		  scrollTop: (target.offset().top) - 79
		}, 500, 'swing', function () {
		  window.location.hash = target;
		  $(document).on("scroll", onScroll);
		});
	  });
  
	  function onScroll(event) {
		var scrollPos = $(document).scrollTop();
		var navLinks = $('.nav a');
	
		navLinks.each(function () {
			var currLink = $(this);
			var refElement = $(currLink.attr("href"));
	
			if (refElement.length && refElement.position()) {
				var refElementTop = refElement.position().top;
				var refElementBottom = refElementTop + refElement.outerHeight();
	
				if (scrollPos >= refElementTop && scrollPos < refElementBottom) {
					navLinks.removeClass("active");
					currLink.addClass("active");
				}
			}
		});
	}
	
	  // Page loading animation
	  $(window).on('load', function () {
		if ($('.cover').length) {
		  $('.cover').parallax({
			imageSrc: $('.cover').data('image'),
			zIndex: '1'
		  });
		}
  
		$("#preloader").animate({
		  'opacity': '0'
		}, 600, function () {
		  setTimeout(function () {
			$("#preloader").css("visibility", "hidden").fadeOut();
		  }, 300);
		});
	  });
  
	//   // CounterUp
	//   $('.counter').counterUp({
	// 	delay: 10,
	// 	time: 1000
	//   });
  
	  // WOW
	  $(document).on('scroll', function () {
		if ($(document).scrollTop() > 50) {
		  $('.main-header').addClass('fixed-top');
		} else {
		  $('.main-header').removeClass('fixed-top');
		}
	  });
  
	  // Window Resize Mobile Menu Fix
	  function mobileNav() {
		var width = $(window).width();
		$('.submenu').on('click', function () {
		  if (width < 992) {
			$('.submenu ul').removeClass('active');
			$(this).find('ul').toggleClass('active');
		  }
		});
	  }
  
	  mobileNav();
	  $(window).on('resize', mobileNav);
  
	  // Search Toggle
	  $('#search-input-box').hide();
	  $('#search').on('click', function () {
		$('#search-input-box').slideToggle();
		$('#search-input').focus();
	  });
	  $('#close-search').on('click', function () {
		$('#search-input-box').slideUp(500);
	  });
  
	//   // Page Scroll to id 
	//   $("#navigation-menu a").mPageScroll2id({
	// 	offset: 79
	//   });
  
	//   // Mixitup
	//   $(function () {
	// 	$("#portfolio").mixItUp();
	//   });
  
	  // Video Lightbox
	  $(document).on('click', '.lightbox', function (event) {
		event.preventDefault();
		$(this).ekkoLightbox();
	  });
  
	  // Back to Top
	  $(window).scroll(function () {
		if ($(this).scrollTop() >= 500) {
		  $('.back-to-top').fadeIn();
		} else {
		  $('.back-to-top').fadeOut();
		}
	  });
	  $('.back-to-top').click(function () {
		$('body,html').animate({
		  scrollTop: 0
		}, 800);
	  });
  
	  // jQuery sticky Menu
  
	//   $(".mainmenu-area").sticky({
	// 	topSpacing: 0
	//   });
  
	  // Tooltip
	  $(document).ready(function () {
		$('[data-toggle="tooltip"]').tooltip();
	  });
  
	  // Preventing URL update on navigation link click
	  $(".navbar-nav li a").click(function (event) {
		if (!$(this).parent().hasClass('dropdown'))
		  $(".navbar-collapse").collapse('hide');
	  });
  
	//   // WOW
	//   $(document).ready(function () {
	// 	new WOW().init();
	//   });
  
	  // Preloader
	  jQuery(window).on('load', function () {
		$('.preloader').fadeOut(700);
	  });
	});
  
  }(jQuery));
  