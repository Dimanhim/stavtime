$(document).ready(function() {
    $('body').on('change', '.change-order-o', function(e) {
        e.preventDefault();
        let form = $(this).closest('form');
        form.find('#change-order-btn').trigger('click')
    });

    /**
     * Открывает нужный таб по ссылке
     * */
    if($('#myTab').length) {
        let location = window.location;
        let hash = location.hash;
        if(hash.length) {
            let tab = $('.nav-item a[href="' + hash + '"]');
            if(tab.length) {
                tab.trigger('click');
            }
        }
    }

    $(".phone").inputmask({"mask": "+7 (999) 999-9999"});
    /**
     * сворачивает/разворачивает карточку
     * */
    $('body').on('click', '.card-header-o', function(e) {
        //e.preventDefault();
        console.log('header')
        let target = e.target;
        if($(target).is('.card-header-o')) {
            let parent = $(this).closest('.card-o');
            let body = parent.find('.card-body-o');
            let icon = $(this).find('.bi')
            if(body.is(':visible')) {
                body.slideUp();
                icon.removeClass('bi-chevron-up').addClass('bi-chevron-down');
            }
            else {
                body.slideDown();
                icon.removeClass('bi-chevron-down').addClass('bi-chevron-up');
            }
        }

    });
    $('body').on('click', '.tabs-action', function(e) {
        e.preventDefault();
        showAllTabs($(this))
    });
    function showAllTabs(self) {
        let action = self.attr('data-action');
        let icon = $('.bi');
        let card = $('.card-o');
        let body = card.find('.card-body-o');
        if(action == 2) {
            body.slideUp();
            icon.removeClass('bi-chevron-up').addClass('bi-chevron-down')
            self.attr('data-action', 1);
            self.text('Равернуть все');
        }
        else {
            body.slideDown();
            icon.removeClass('bi-chevron-down').addClass('bi-chevron-up')
            self.attr('data-action', 2);
            self.text('Свернуть все');
        }
    }




})
