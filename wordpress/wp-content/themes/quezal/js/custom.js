// JavaScript Document for Quezal
jQuery(document).ready(function($) {
	
	// Use strict 
	"use strict";

	// Tooltip
	$('[data-toggle="tooltip"]').tooltip({trigger: 'hover'});

	// Owl carousel for recent posts
	$(".recentpost-carousel").owlCarousel({
		transitionStyle : false, // fade, backSlide, goDown
		navigation: false, // Show next and prev buttons
		navigationText : false,
		pagination: true,
		slideSpeed: 300,
    	paginationSpeed: 400,
    	items: 3, // Increase this if need more than 3 items
 	 // itemsDesktop : false,
 	 // itemsDesktopSmall : false,
 	 // itemsTablet: false,
 	 // itemsMobile : false,
	 	theme: 'tcsn-theme',
	});
	
	// Owl carousel for testimonial
	$(".testimonial-carousel").owlCarousel({
		transitionStyle : "fade", // fade, backSlide, goDown
		navigation: false, // Show next and prev buttons
		pagination: false,
		slideSpeed: 100,
		paginationSpeed: 400,
		singleItem:true,
		// items: 1, // Increase this if need more than 1 items
		autoPlay : 6000,
		stopOnHover: true,
		theme: 'tcsn-theme',
		autoHeight: true, // Use it only for one item per page setting.
	});
		
	// Take to top
	$('#take-me-top').click(function(){
		$('body,html').animate({
			scrollTop: 0
		}, 500);
		return false;
	});	

	// Fitvids
	$(".video-wrapper").fitVids();
	
	// Top sliding panel
	$(".slide-panel-btn").click(function(e){
		e.preventDefault();
		$('#slide-top  .slide-top-inner').slideToggle();
		$('#slide-top').toggleClass('active');
	});
	
	// Isotope - Portfolio
	$('.portfolio_wrapper').isotope({
		itemSelector	: '.portfolio-item',
	  	layoutMode		: 'fitRows',
	  	resizable		: true
	});
	
	// Isotope - Portfolio 	
	$(function(){	
		var $container = $('.filter-content');
		$container.imagesLoaded(function () {
			$container.isotope({
				itemSelector: '.isotope-item',
				layoutMode : 'fitRows',
				//  masonry: {}
			});
		});
		$('.filter_nav li a').click(function () {
			$('.filter_nav li a').removeClass('active');
			$(this).addClass('active');
			var selector = $(this).attr('data-filter');
			$container.isotope({
				filter: selector
			});
			return false;
		});
	});
	
	// Isotope - Search
	$(function(){	
		var $container_search = $('.mssearch-content');
		$container_search.imagesLoaded(function () {
			$container_search.isotope({
				itemSelector: '.mssearch-item',
				// layoutMode : 'fitRows',
				 masonry: {}
			});
		});
	});
	
	// Responsive menu
	$('#menu').slicknav({
		label:"",
		prependTo:'#responsive-menu'
	});

	//prettyPhoto
	$('a[data-rel]').each(function () {
		$(this).attr('rel', $(this).data('rel'));
	});
	$("a[rel^='prettyPhoto'],a[rel^='prettyPhoto[gallery]']").prettyPhoto({
		animation_speed: 'fast',
		slideshow: 5000,
		autoplay_slideshow: false,
		opacity: 0.80,
		show_title: true,
		theme: 'pp_default',
		/* light_rounded / dark_rounded / light_square / dark_square / facebook */
		overlay_gallery: false,
		social_tools: false,
		changepicturecallback: function () {
			var $pp = $('.pp_default');
			if (parseInt($pp.css('left')) < 0) {
				$pp.css('left', 0);
			}
		}
	});

	// Split Sitemap list into columns	
	var pagesArray = new Array(),
	$pagesList = $('ul.list-sitemap');
	
	$pagesList.find('li').each(function(){
		pagesArray.push($(this).html());
	})
	var firstList = pagesArray.splice(0, Math.round(pagesArray.length / 2)),
		secondList = pagesArray,
		ListHTML = '';
	
	function createHTML(list){
		ListHTML = '';
		for (var i = 0; i < list.length; i++) {
			ListHTML += '<li>' + list[i] + '</li>'
		};
	}
	createHTML(firstList);
	$pagesList.html(ListHTML);
	createHTML(secondList);
	$pagesList.after('<ul class="list-sitemap"></ul>').next().html(ListHTML);
	
}); // Close document ready



