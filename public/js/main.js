$.noConflict();
jQuery(document).ready(function($) {

    function ajaxSend(url,data){
        $.ajax({
            type: 'POST',
            url: url,
            data: data
        }).done(function (res) {
            let answer = $.parseJSON(res);
            if (answer.success) {
                location.reload();
            } else {
                console.log('error ' + answer);
                $('.ajax-message').text(answer.message)
            }
        });
    }

    $('.to-basket').on('click',function(){
        let url = $(this).data('url'),
        data ={
            id: $(this).data('id'),
            price: $(this).data('price'),
            name: $(this).data('name')
        };
        ajaxSend(url,data)
    });

    $('.from-basket').on('click',function(){
        let url = $(this).data('url'),
            data ={
                id: $(this).data('id'),
                price: $(this).data('price'),
                name: $(this).data('name')
            };
        ajaxSend(url,data)
    });

});

