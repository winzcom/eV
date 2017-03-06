$(document).ready(function(){

    $('.request').click(function(){

        var id = $(this).attr('id');
        var request_id = $(this).data('requestId');
        

        if(id == 'reply'){
            var url =   "{!! url('reply_request')!!}";
            url = url+'/'+request_id;
            /*** Ajax Call With Reply */
            $.get(url,function(data){

            });
            /*** */
        }
        else if(id == 'dismiss'){
            var url =   "{!! url('dismiss_request')!!}";
            url = url+'/'+request_id;
            /***Ajax Call With Dismiss */
            $.get(url,function(data){

            });
            /*** */
        }
    })
})