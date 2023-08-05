$(document).ready(function() {
    $('body').on('change', '.change-order-o', function(e) {
        e.preventDefault();
        console.log('val', $(this).val())
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





})
