$(document).ready(function() {
    $('body').on('change', '.change-order-o', function(e) {
        e.preventDefault();
        console.log('val', $(this).val())
        let form = $(this).closest('form');
        form.find('#change-order-btn').trigger('click')
    });





})
