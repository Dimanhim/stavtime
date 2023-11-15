$(document).ready(function() {

    /**
     выбор любого чекбокса
     * */
    $('body').on('change', '#portfolio-filters input[type="checkbox"]', function(e) {
        e.preventDefault();
        let params = getFilterParams()
        console.log('params', params)
        changeFilter(params)
    });

    /**
     формирует json из нажатых кнопок
     * */
    function getFilterParams() {
        let data = [];
        let inputs = $('#portfolio-filters input[type="checkbox"]');
        inputs.each(function(input_index, input_element) {
            let input_el = $(input_element);
            if(input_el.is(':checked')) {
                data.push({
                    portfolio_tags: input_el.attr('data-id'),
                })
            }
        })
        return data;
    }

    /**
     функция показа контента фильтра
     * */
    function changeFilter(data) {
        addPreloader();
        let type = $('#portfolio-filters').attr('data-type');
        $.ajax({
            url: '/ajax/change-filter',
            type: 'POST',
            data: {data: data, type: type},
            success: function (res) {
                if(res.result == 1) {
                    $('#portfolio-filter').replaceWith(res.html);
                    initMagnific()
                }
                removePreloader();
            },
            error: function () {
                console.log('Error!');
                removePreloader()
            }
        });
    }







})

function addPreloader() {
    $('.loader-block').css('display', 'block').addClass('loader');
}
function removePreloader() {
    $('.loader-block').css('display', 'none').removeClass('loader');
}


