$(document).ready(function(){

	// Паралакс верхней части
	$('.top-page').parallax({imageSrc: '/css/images/bg_top.jpg'});

	// слайдер (отзывы)
	var carousel = $('.owl-carousel');
	carousel.owlCarousel({
		items: 1
	});

	// Тригеры для слайдера (отзывы)
	$(".bt-carouser.prev").on("click", function(){
		carousel.trigger('prev.owl.carousel');
	});

	$(".bt-carouser.next").on("click", function(){
		carousel.trigger('next.owl.carousel');
	});

	// Кнопка вверх
 	$(".go-to").on("click", function(){
 		$('body, html').animate({
    		scrollTop: 0
    	}, 1000);
 	});

 	// Просмотр работ
 	$('.one-work .button-slty').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		image: {
			verticalFit: false
		}
	});

	// Показать еще работы (по 4 каждый раз)
	$(".more-view").on("click", function(e){
		e.preventDefault();
		var count = 0;

		$(".one-work").each(function(index, element){
			if (!$(element).is(":visible")) {
				count++;
				if (count === 5) {
					return false;
				}
				else {
					$(element).show();
					if($(element).is(':last-child')) {
						$('.more-view a').attr("onclick", "showPopup('Портфолио', '');").html('Хочу такой же лендинг');
					}
				}
			}
		});
	});

	// Показ и скрытие поля "Пакета" в попапе
	$(".package-go").on("click", function(){
		if ($(this).attr("title-package")) {
			$("#title_package").show(0).val("Пакет " + $(this).attr("title-package"));
			$(".remodal.package h3").css("margin-top", "35px");
		} else {
			$("#title_package").val("nan").hide(0);
			$(".remodal.package h3").css("margin-top", "85px")
		}
	});

	// Кнопка меню
	$(".toggle-nav").on("click", function(){
		if (!$(this).hasClass("active")) {
			$(".wp-top-nav").slideDown(300);
			$(this).addClass("active");
		} else {
			$(".wp-top-nav").slideUp(300);
			$(this).removeClass("active");
		}
	});

	function controlShowNav() {
		if ($(window).width() > 991) {
			$(".wp-top-nav").show(0);
		} else {
			$(".wp-top-nav").hide(0)
		}
	} controlShowNav();

	$(window).resize(function(){
		controlShowNav();
	});

	// плавный якорь
	$('.wp-top-nav a').click(function(){
		var el = $(this).attr('href');

		$('html, body').animate({
			scrollTop: $(el).offset().top}, 2000);
		return false;
	});
	$('.stock-top a').click(function(){
		var el = $(this).attr('href');

		$('html, body').animate({
			scrollTop: $(el).offset().top}, 2000);
		return false;
	});

	function replacePromoDate() {
		var add_days = 1;
		var arr_month = new Array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
		var current_date = new Date();
		var current_time = current_date.getTime();
		var next_time = current_time + 86400 * 1000 * add_days;
		var next_date = new Date(next_time);

		var str_day = next_date.getDate();
		var number_month = next_date.getMonth();
		var str_month = arr_month[number_month];
		var str_year = next_date.getFullYear();
		var str_text = 'до ' + str_day + ' ' + str_month;
		jQuery('.tomorrow').html(str_text);
	}

	// Акция - замена даты
	replacePromoDate();

	var wow = new WOW();
	wow.init();

	$('.remodal_bg').click(function() {
		modalClose()
	});
	function modalClose() {
		$('.popup_window').modal('hide');
		//$('.modal-backdrop').css('display', 'none');
	}
	$('.remodal-close').click(function() {
		modalClose()
	});
	$('.remodal-close').click(function() {
		$('.multi_description').fadeOut(50);
	});

	$(window).scroll(function() {
		if($(this).scrollTop() > 100) {
			$('.header').animate({'marginTop': 0}, 0).css('background', "rgba(51,233,184,0.3)");
		}
		if($(this).scrollTop() > 2355) {
			$('.header').css('background', "rgba(242,3,3,0.3)");
		}
		if($(this).scrollTop() > 6373) {
			$('.header').css('background', "rgba(19,143,252,0.3)");
		}

		if($(this).scrollTop() < 100) {
			$('.header').animate({'marginTop': '15px'}, 0).css('background', "transparent");
		}
	});
	$('.popup-content').on('click', function() {
		//$('.multi_description').fadeIn(300);
		showModal($(this).attr('data-template'))
	});
	$(".phone").inputmask({"mask": "+7 (999) 999-9999"});

	$('body').on('change', '.order-form input', function(e) {
		e.preventDefault();
		let form = $(this).closest('.order-form')
		formValidate(form)
	});
	function displayFormResult(form, message) {
		let info = form.find('.info-message');
		info.text(message);
	}
	function formValidate(form) {
		let data = form.serialize();
		let button = form.find('button[type="submit"]');
		let info = form.find('.info-message');
		info.text('');
		$.ajax({
			url: '/site/form-validate',
			type: 'POST',
			data: data,
			success: function (res) {
				console.log(res)
				if(res.result == 0) {
					displayFormResult(form, res.message);
					button.attr('disabled', 'disabled')
				}
				else {
					button.removeAttr('disabled');
					info.text('');
				}
			},
			error: function (e) {
				console.log('Error!', e);
			}
		});
	}

	$('body').on('submit', '.order-form', function (e) {
		var form = $(this);
		$.ajax({
			url: form.attr("action"),
			type: form.attr("method"),
			data: form.serialize(),
			success: function (res) {
				console.log('form res', res)
				if(res.result == 1) {
					modalClose()
					//$(".popup_form").modal('hide');

					//$(".popup_success").modal();
					showModal('success')
				}

			},
			error: function () {
				alert('Произошла ошибка отправки, попробуйте позднее');
			}
		});
		return false;
	});
	function showModal(template) {
		let content = $('.modal-content[data-template="' + template + '"]').html();
		$('#modal-content').html(content);
		$('.popup_window.popup_success').modal()
	}

	/*$("form").on("submit", function (e) {
		var email = $(this).find('#modalform-email').val();
		//alert(email.length);
		if (email.length < 1) {

			$(this).find('#modalform-email').css('border', '2px solid #f00');
			return false;
		}
		var form = $(this);
		var formData = form.serialize();
		$.ajax({
			url: form.attr("action"),
			type: form.attr("method"),
			data: formData,
			success: function (response) {
				$(".popup_form").modal('hide');
				$(".popup_success").modal();
				//alert(response.message)
			},
			error: function () {
				alert('Произошла ошибка отправки, попробуйте позднее');
			}
		});
		return false;
	});*/

});
function showPopup(form, plan) {
    $('.form-service').val(plan);
    $('.form-btn').val(form);
    $('.popup_form').modal();
    //alert($('#modalform-plan').val());
    return false;
}
bg_10 = new Image();
bg_15 = new Image();
bg_20 = new Image();
bg_30 = new Image();
bg_10.src = '/css/images/bg-10-min.png';
bg_15.src = '/css/images/bg-15-min.png';
bg_20.src = '/css/images/bg-20-min.png';
bg_30.src = '/css/images/bg-30-min.png';
$(window).scroll(function () {
	if ($(this).scrollTop() > 759) {
		$('body').css('background', 'url("' + bg_10.src + '") no-repeat');
	}
	if ($(this).scrollTop() > 2355) {
		$('body').css('background', 'url("' + bg_20.src + '") no-repeat');
	}
	if ($(this).scrollTop() > 6373) {
		$('body').css('background', 'url("' + bg_30.src + '") no-repeat');
	}
});


