$(document).ready(function(){

    $('#reply_request').on('shown.bs.modal',function(event){

         var button = $(event.relatedTarget);
         var rid = button.data('rid');
         var client_id = button.data('clientId');
         var vendor_id = button.data('uid');
         console.log(rid+' '+client_id)
         var url = 'reply_request'
         console.log(url)

         var self = $(this);
         var valid = true;

         $('#send_quote').click(function(){
             
             var form = $('#send_request_form');
             var inputs = form.find('.quo');
        
             inputs.each(function(i,v){
                 if($(this).val() == ''){
                     this.focus();
                     valid = false;
                 }
                 else{
                     valid = true;
                 }
             },self,valid)

             if(valid){
                var fd = new FormData(form);

                inputs.each(function(i,v){

                    fd.append($(this).attr('name'),$(this).val());
                })


                fd.append('rid',rid);
                fd.append('client_id',client_id);
                fd.append('uid',vendor_id);
                var data = fd;
                submitRequest(data,self,url,button);
             }
            
            
             //self.modal('hide');
         })
    });// shown.bs.modal ends


    /*** Reply Review Modal/ Submission */

    $('#reply_review').on('show.bs.modal',function(event){

        var modal = $(this);
        var button = $(event.relatedTarget);
        var reviewers_name = button.data('name');
        var review_id = button.data('id');

        var input_reviewers_name = $('#reviewers_name');
        input_reviewers_name.val(reviewers_name);

        var rev_id = $('#review_id');
        rev_id.val(review_id);


        $('#reply_review_submit').click(function(){

        var form = $('#send_review_reply');
        var url = form.attr('action');
        var td = button.parents('td').siblings('.reply');
        var datas = form.serialize();
        var reply = $('textarea[name="reply"]').val();
        console.log(url); 
        
      $.ajax({
            url:url,
            headers:{
						'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr("content")
					},
            type:"POST",
            dataType:'json',
            data:datas,
            success:function(data){
                 td.html(reply)
                 modal.modal('hide');
                 button.remove();
                 
            },
            error:function(err){
                console.log(err)
            
            }
        })
    })

    
})/***End of Reply Review Modal */

    $('.dismiss').click(function(event){

       
        var self = $(this);
        var rid = self.data('rid');
        var client_id = self.data('clientId');
        var uid = self.data('uid');

        var response = confirm('Are You Sure You Want to Dismiss This Request');
        
        if(response){
             var url = 'dismiss_request/'+rid+'/'+uid+'/'+client_id;
             $.get(url,{},function(data){
                 if(data.status == undefined || data.status == null)
                    location.reload(true);
                else{}
            })
        }
       
        console.log(url);

       /* $.get(url,{},function(data){

            console.log(data);
        })*/
    })

    function submitRequest(data,modal,url,button){
        /**Make ajax call */

        $.ajax({
					url:'reply_request',
					type:"POST",
                    dataType:"json",
                    processData:false,
					data:data,
					contentType:false,
					headers:{
						'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr("content")
					},
                    success:function(data){
                        $('.request').remove();
                        $('#reply_request').modal('hide');
                        var italic = $('<i>').attr('class','fa fa-check-circle-o');
                        $('cbp-caption-defaultWrap').prepend(italic);
                    }
				})
        /**End ajax call */
    }

})