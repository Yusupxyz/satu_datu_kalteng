/*================================================================================
	Item Name: Pongo - Simple & Clean Admin Template
	Version: 1.0
	Author: Native Theme
	Author URL: http://www.themeforest.net/user/native-theme
================================================================================*/

"use strict";

$(function () {

	// Mobile nav
	var main_nav = $('.main-nav')
	$(main_nav).find('.mobile-nav').on('click', function() {
		$(main_nav).find('.menu').fadeToggle()
	})

	// On window resized
	var responsive_mobile_nav = function() {
		if ($(window).width() >= 920) {
			$('.main-nav').find('.menu').removeAttr('style')
		}
	}

	responsive_mobile_nav()
	$(window).resize(function() {
		responsive_mobile_nav()
	})

	// Main menu
	$('.main-nav').find('a').each(function() {
		$(this).on('click', function() {
			var link = $(this).attr('data-link')
			if ($(link).length) {
				$('html, body').animate({
					scrollTop: $(link).offset().top
				}, 700);
			}
		})
	})

	// Move top
	var move_top = function() {
		if ($(window).scrollTop() > 0) {
			$(".move-top").show();
		} else {
			$(".move-top").hide();
		}
	}

	move_top()
	$(window).scroll(function() {
		move_top()
	});

	$('.move-top').click(function() {
		$('html, body').animate({
			scrollTop: $('body').offset().top
		}, 700);
	});
})