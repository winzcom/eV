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
      
      var uri = "/eWeb/public/reply_review";
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
 })

});// document ready
