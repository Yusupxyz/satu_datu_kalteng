/*================================================================================
	Item Name: Pongo - Simple & Clean Admin Template
	Version: 1.0
	Author: Native Theme
	Author URL: http://www.themeforest.net/user/native-theme
================================================================================*/

"use strict";

$(function () {

	// Top menu quick link
	if ($('.quick-link').length) {
		$('.quick-link').on('click', function() {
			if (!$(this).hasClass('active')) {
				$(this).addClass('active')
			} else {
				$(this).removeClass('active')
			}
		})
	}

	// Top menu notification
	if ($('.top-notification').length) {
		$('.top-notification').find('.notification-icon').each(function() {
			var notification_icon = this;
			$(notification_icon).on('click', function() {
				var show = $(notification_icon).hasClass('active')
				$('.notification-icon').removeClass('active')
				$('.user-top-profile').removeClass('active')

				if (!show) {
					$(notification_icon).addClass('active')
				} else {
					$(notification_icon).removeClass('active')
				}
			})
		})
	}

	// Top notification scroll
	if ($('.notification-body').length) {
		$('.notification-body').each(function() {
			$(this).slimScroll({
				color: 'rgb(142, 142, 142)',
	    		height: 260
			})
			var height = $(this).parent().height()
			$(this).parent().css({
				'height': 'auto',
				'max-height': height + 'px'
			})
			$(this).css({
				'height': 'auto',
				'max-height': height + 'px'
			})
		})
	}

	// Top menu profile
	if ($('.user-top-profile').length) {
		$('.user-top-profile').on('click', function() {
			if ($(this).hasClass('active')) {
				$(this).removeClass('active')
			} else {
				$('.notification-icon').removeClass('active')
				$(this).addClass('active')
			}
		})
	}

	// Compact nav
	var compact_nav
	if ($('.compact-nav').length) {
		compact_nav = true
	} else {
		compact_nav = false
	}

	// On window resized
	var responsive_side_nav = function() {
		if ($(window).width() <= 885 && $('.side-nav').length) {
			if (!$('.wrapper').find('.mask').length) {
				$('.wrapper').prepend('<div class="mask"></div>')
			}
			$('.side-nav').children().wrapAll("<div class='scrollable'></div>")
			$(".side-nav").find('.scrollable').slimScroll({
				color: 'rgb(142, 142, 142)',
	    		height: $(window).height() - $('.top-nav').height()
			})

			if (compact_nav) {
				$('.wrapper').removeClass('compact-nav')
			}
		} else if ($(window).width() > 885 && $('.side-nav').find('.scrollable').length && $('.side-nav').length) {
			$('body').css('overflow-y', 'scroll')
			$('.wrapper').find('.mask').remove()
			if (!$('.fixed-nav').length) {
				$(".side-nav").find('.scrollable').slimScroll({
					destroy: true
				})
				$('.side-nav').find('.scrollable').children().unwrap()
			}
			$('.side-nav').removeAttr('style')
			$('.user-top-profile').removeAttr('style')

			if (compact_nav) {
				$('.wrapper').addClass('compact-nav')
			}
		}
	}

	responsive_side_nav()
	$(window).resize(function() {
		responsive_side_nav()
	})

	// Mobile nav
	$('.side-nav-mobile').find('i').on('click', function() {
		if (!$('.side-nav').is(':visible')) {
			$('.user-top-profile').hide()
			$('.side-nav').show()
			$('.mask').show()
			$('body').css('overflow-y', 'hidden')
		} else {
			$('.side-nav').hide()
			$('.mask').hide()
			$('body').css('overflow-y', 'scroll')
		}
	})

	// Top profile nav
	$('.profile-nav-mobile').find('i').on('click', function() {
		if (!$('.user-top-profile').is(':visible')) {
			$('.side-nav').hide()
			$('.user-top-profile').show()
			$('.mask').show()
		} else {
			$('.user-top-profile').hide()
			$('.mask').hide()
		}
	})

	// Mask event
	$('.wrapper').find('.mask').on('click', function() {
		$('.side-nav').hide()
		$('.user-top-profile').hide()
		$('.mask').hide()
		$('body').css('overflow-y', 'scroll')
	})

	// Side nav fixed scroll
	if ($(".fixed-nav").length) {
		$('body').css('overflow', 'hidden')
		$(".fixed-nav").find('.side-nav').children().wrapAll("<div class='scrollable'></div>")
		$(".fixed-nav").find('.main').children().wrapAll("<div class='scrollable'></div>")

		var fixed_nav_scroll = function() {
			$(".fixed-nav").find('.scrollable').each(function() {
				$(this).slimScroll({
					color: 'rgb(142, 142, 142)',
		    		height: $(window).height() - $('.top-nav').height()
				})
			})
		}

		fixed_nav_scroll()
		$(window).resize(function() {
			fixed_nav_scroll()
		})
	}

	// Side nav submenu
	if ($('.side-nav').length) {
		$('.side-nav').find('.main-menu').find('a').each(function() {
			if ($(this).parent().find('ul').length > 0) {
				$(this).attr('href', 'javascript:;')
			}

			$(this).on('click', function() {
				var li = $(this).parent()
				if ($(li).parent().parent().hasClass('main-menu')) {
					if (!$(li).hasClass('active')) {
						$('.side-nav').find('.main-menu > ul > li').removeClass('active')
						$(li).addClass('active')
					} else {
						$(li).removeClass('active')
					}
				}
			})
		})
	}

	// Profile menu
	if ($('.user-side-profile').length) {
		$('.user-side-profile').on('click', function() {
			if ($(this).hasClass('active')) {
				$(this).removeClass('active')
			} else {
				$('.notification-icon').removeClass('active')
				$(this).addClass('active')
			}
		})
	}

	// Side notification
	if ($('.side-notification').length) {
		$('.side-notification').find('.notification-icon').each(function() {
			var notification_icon = this;
			$(notification_icon).on('click', function() {
				var show = $(notification_icon).hasClass('active')
				$('.notification-icon').removeClass('active')
				$('.user-side-profile').removeClass('active')

				if (!show) {
					$(notification_icon).addClass('active')
				} else {
					$(notification_icon).removeClass('active')
				}
			})
		})
	}

	// Card 
	if ($('.card-wrapper').length) {
		$('.card-wrapper').each(function() {
			$(this).find('.card-menu').on('click', function() {
				$('.card-wrapper').find('.card-menu').find('ul').fadeOut()
				if (!$(this).find('ul').is(':visible')) {
					$(this).find('ul').fadeIn('fast')
				} else {
					$(this).find('ul').fadeOut('fast')
				}
			})
		})
	}

	// Slide item
	if ($('.slide-item').length && $('.slide-item').children().length > 1) {
		(function slide_item() {
			$('.slide-item').css('overflow', 'hidden')
			$('.slide-item').height($('.slide-item').height())
			var margin_top = $('.slide-item').children().first().css('margin-top')
			var item_height = $('.slide-item').children().first().height()
			$('.slide-item').children().first().animate({
				'margin-top': '-' + item_height
			}, 1000, function() {
				var item = $('.slide-item').children().first().clone().css({
					'margin-top': margin_top,
					'display': 'none'
				})
				$('.slide-item').children().first().remove()
				$('.slide-item').append(item)
				$(item).fadeIn()
				setTimeout(function() {
					slide_item()
				}, 5000)
			})
		}())
	}

	// Calendar
	if ($('#full-calendar').length) {
		var calendar, d, date, m, y;
		date = new Date();
		d = date.getDate();
		m = date.getMonth();
		y = date.getFullYear();

		calendar = $("#full-calendar").fullCalendar({
			header: {
				left: "prev,next today",
				center: "title",
				right: "month,agendaWeek,agendaDay"
			},
			selectable: true,
			selectHelper: true,
			select: function select(start, end, allDay) {
				var title;
				title = prompt("Event Title:");
				if (title) {
					calendar.fullCalendar("renderEvent", {
						title: title,
						start: start,
						end: end,
						allDay: allDay
					}, true);
				}
				return calendar.fullCalendar("unselect");
			},
			editable: true,
			events: [{
				title: "Long Event",
				start: new Date(y, m, 3, 12, 0),
				end: new Date(y, m, 7, 14, 0)
			}, {
				title: "Lunch",
				start: new Date(y, m, d, 12, 0),
				end: new Date(y, m, d + 2, 14, 0),
				allDay: false
			}, {
				title: "Click for Google",
				start: new Date(y, m, 28),
				end: new Date(y, m, 29),
				url: "http://google.com/"
			}]
		});
	}

	// Donut chart
	if ($('#donut-chart').length) {
		var donutChart = $("#donut-chart");
		var data = {
			labels: ["Red", "Yellow", "Green", "Blue"],
			datasets: [{
				data: [80, 120, 80, 50],
				backgroundColor: ["#ff4141", "#FBC02D", "#71c21a", "#5797fc"],
				hoverBackgroundColor: ["#ff5c5c", "#fdcd54", "#89da32", "#6ca4fb"],
				borderWidth: 0
			}]
		};

		new Chart(donutChart, {
			type: 'doughnut',
			data: data,
			options: {
				legend: {
					display: false
				},
				animation: {
					animateScale: true
				},
				cutoutPercentage: 80
			}
		});
	}

	// Bar chart
	if ($('#bar-chart').length) {
		var barChart1 = $("#bar-chart");
		var barData1 = {
			labels: ["January", "February", "March", "April", "May", "June"],
			datasets: [{
				label: "Visitors",
				backgroundColor: "#5797FC",
				data: [32, 12, 20, 42, 20, 59]
			}]
		};

		new Chart(barChart1, {
			type: 'bar',
			data: barData1,
			options: {
				scales: {
					xAxes: [{
						display: false,
						ticks: {
							fontSize: '11',
							fontColor: '#969da5'
						},
						gridLines: {
							color: 'rgba(0,0,0,0.05)',
							zeroLineColor: 'rgba(0,0,0,0.05)'
						}
					}],
					yAxes: [{
						ticks: {
							beginAtZero: true
						},
						gridLines: {
							color: 'rgba(0,0,0,0.05)',
							zeroLineColor: '#6896f9'
						}
					}]
				},
				legend: {
					display: false
				},
				animation: {
					animateScale: true
				}
			}
		});
	}

	// Ckeditor
	if ($('#ckeditor').length) {
		CKEDITOR.replace('ckeditor')
	}

	// Datatable
	if ($('.datatable').length) {
		$('.datatable').DataTable()
	}


	// Date picker
	if ($('input.single-daterange').length) {
		$('input.single-daterange').daterangepicker({ "singleDatePicker": true, showDropdowns:true })
	}

	if ($('input.multi-daterange').length) {
		$('input.multi-daterange').daterangepicker({ showDropdowns:true })
	}

	// Form validation
	if ($('#form-validate').length) {
		$('#form-validate').validator()
	}

	// Jquery count to
	$('.timer').each(function() {
		$(this).countTo({
			speed: 2000,
			formatter: function (value, options) {
				return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',')
			}
		})
	})

	// Form wizard
	if ($('.form-wizard-nav').length) {
		$('.form-wizard-nav').find('.step').each(function() {
			var next_step = $(this).next()
			var prev_step = $(this).prev()
			var content = $(this).attr('data-form')
			$(content).hide()

			$(content).find('.prev-action').on('click', function() {
				go(prev_step)
			})

			$(content).find('.next-action').on('click', function() {
				go(next_step)
			})
		})

		var content = $('.form-wizard-nav').find('.step').first()
		$($(content).attr('data-form')).show()
		$(content).addClass('active').addClass('complete')

		$('.form-wizard-nav').find('.step').each(function() {
			$(this).on('click', function() {
				go(this)
			})
		})
	}

	function go(el) {
		// next
		if ($(el).prev().hasClass('complete') && !$(el).hasClass('complete')) {
			$(el).prev().removeClass('active')
			$(el).addClass('complete').addClass('active')

			var prev_content = $(el).prev().attr('data-form')
			$(prev_content).hide()

			var next_content = $(el).attr('data-form')
			$(next_content).show()						
		}

		// prev
		if ($(el).hasClass('complete') && $(el).next().hasClass('active')) {
			$(el).addClass('complete').addClass('active')
			$(el).next().removeClass('complete').removeClass('active')

			var prev_content = $(el).next().attr('data-form')
			$(prev_content).hide()

			var next_content = $(el).attr('data-form')
			$(next_content).show()
		}
	}
})