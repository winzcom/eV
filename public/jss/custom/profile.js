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

    $('#dismiss').click(function(event){

       
        var self = $(this);
        var rid = self.data('rid');
        var client_id = self.data('clientId');
        var uid = self.data('uid');

        var response = confirm('Are You Sure You Want to Dismiss This Request');
        
        if(response){
             var url = 'dismiss_request/'+rid+'/'+uid+'/'+client_id;
             $.get(url,{},function(data){
                 window.location.href = '';
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