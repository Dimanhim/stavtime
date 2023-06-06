jQuery(function($) {
	jQuery(".popup_bg").click(function(){   
		jQuery(".popup_mask").fadeOut(800);
	});
	jQuery(".close").click(function(){   
		jQuery(".popup_mask").fadeOut(800);
	});
	$('.questions dt').click(function() {
        var _this = $(this);
        if(_this.hasClass('active')) {
            _this.removeClass('active').next().slideUp();
        } else {
            $('.questions dd').slideUp();
            $('.questions dt').removeClass('active');
            _this.addClass('active').next().slideDown();
        }
        
    })

    $('.cmn-toggle-switch').click(function(){
        $(this).toggleClass('active');
        $('nav').toggleClass('active');
    });

    $('.look').fancybox();

    $('.slider').slick({
        dots: true
    })

    $('nav a').click(function(){
        var el = $(this).attr('href');
        $('body, html').animate({
        scrollTop: $(el).offset().top }, 1200);
        return false;
    });

    $('footer .top').click(function() {
        $('body, html').animate({
            scrollTop: 0
        }, 1200);
    })

    $('.package .new-action a').click(function() {
        var el = $(this).attr('href');
        $('body, html').animate({
        scrollTop: $(el).offset().top + 100}, 600);
        return false;
    })

    $('.summary a').click(function() {
        var el = $(this).attr('href');
        
        $('body, html').animate({
        scrollTop: $('.questions dl').offset().top - 20}, 600);

        var _this = $(el);
        if(_this.hasClass('active')) {
            return false;
        } else {
            $('.questions dd').slideUp();
            $('.questions dt').removeClass('active');
            _this.addClass('active').next().slideDown();
        }

        return false;
    })

    var popupForm = $('.fancybox');

    popupForm.fancybox({
        padding: 0
    }).click(function() {
        $('#btn').val($(this).data('btn'))
    });

    var choosePackage = $('.choose-package');

    choosePackage.fancybox({
        padding: 0
    }).click(function() {
        $('#plan').val('Пакет ' + $(this).data('plan'))
    })

    $('.popup .close, .thanks .close').click(function() {
        $('.fancybox-close').trigger('click')
    })

    $('.thanks-btn').fancybox({
        padding: 0
    })

    $('.main').addClass('animated')


    function parallax() {
        var windowHeight = $(window).height(),
            scroll = $(this).scrollTop();

        var bottom = windowHeight + scroll;

        var first = $('.in-any-case').offset().top,
            second = $('.making').offset().top,
            third = $('.new-level').offset().top,
            fourth = $('.reviews').offset().top;

        if(bottom>=first) {
            $('.in-any-case').css({
                backgroundPosition: 'center ' + (first-bottom)/4 + 'px'
            })
        }

        if(bottom>=second) {
            $('.making').css({
                backgroundPosition: 'center ' + (second-bottom)/10 + 'px'
            })
        }

        if(bottom>=third) {
            $('.new-level').css({
                backgroundPosition: 'center ' + (third-bottom)/3 + 'px'
            })
        }

        if(bottom>=fourth) {
            $('.reviews').css({
                backgroundPosition: 'center ' + (100 - (bottom-fourth)/30) + '%'
            })
        }
    }

	// Акция - замена даты
	var arr_month = new Array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
	var date = new Date();
	var month = date.getMonth();
	var day = date.getDate() + 1;
	if(month == 1 && day == 29) {
		day = 1;
		month = month + 1;
	}
	if(day == 31) {
		day = 1;
		month = month + 1;
	}
	month = arr_month[month];
	var text = 'до ' + day + ' ' + month;
	jQuery('.promo').html(text);
    //parallax()

    //$(window).scroll(parallax);

    


});

