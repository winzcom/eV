$(document).ready(function(){

  $('.review_reply').click(function(){
      var name = $(this).data('name');
      var id = $(this).data('id');
      $('#id01').css('display','block');
      $('#reviewers_name').val(name);
      $('#review_id').val(id);
  })

  $('.w3-closebtn').click(function(){
      $('#id01').css('display','none');
      $('#reviewers_name').val('');
      $('#review_id').val('');
      $('#content').val('')

  })

 $('#review_reply').submit(function(){

     event.preventDefault();
      
      var submit = $('#submit');
      submit.val('posting');
      var review_id =  $('#review_id').val();
      var content = $('#content').val();
      
      var uri = window.myUrl+'/reply_review';
      $.ajax({
            url:uri,
            beforeSend:function(request){
                request.setRequestHeader('X-CSRF-TOKEN',document.getElementsByTagName('meta')['csrf-token'].getAttribute('content'))
            },
            type:"POST",
            dataType:'json',
            data:{'review_id':review_id,'reply_content':content},
            success:function(data){
                alert(data.status)
                 $('.review_reply').each(function(){
                     if($(this).data('id') == review_id){
                         $(this).parents('tr').find('.reply').html(content)
                        $(this).remove();
                        
                     }
                     
                 })
                 $('#id01').css('display','none');
            },
            error:function(err){
                console.log(err)
            
            }
        });
     return false;
 });

 $('.close_review_modal').click(function() {
     document.forms['send_request_form'].reset();
 })

 $('#review_pictures').on('change', function(event) {
    var imageType = /^image\//
    $('#send_quote').attr('disabled',false);
    $('#error_message').html('');
     if( event.target.files.length > 4 ) {
         $('#send_quote').attr('disabled',true);
         var html = `<p style="color:red;">you can only upload four pictures</p>`
         $('#error_message').html(html);
     } 
     Array.prototype.forEach.call( event.target.files, function(file) {
         if( !imageType.test(file.type)) {
            $('#send_quote').attr('disabled',true);
            var html = `<p style="color:red;">Only images are allowed</p>`
            $('#error_message').html(html);
         }
     })
 });

 $('#send_request_form').submit(function(event) {
     event.preventDefault();
     event.stopPropagation();
     var url = window.location.origin+'/write_review';
     var fd = new FormData(this);
     $('#send_quote').attr('disabled',true).html('sending...');
     $.ajax({
        url:url,
        method:'POST',
        data:fd,
        processData:false,
        contentType:false,
        dataType:'json',
        headers:{
            'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr("content")
        },
        success:function(data) {
            if(data['status'] === 'success') {
                alert('Review created successfully');
                setTimeout(function() {
                    window.location.reload(true);
                }, 2000);
            }
        },
        error:function(err) {
            console.log(err);
            $('#send_quote').attr('disabled',false).html('send');
        }
     })
 })

});// document ready
