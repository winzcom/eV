$(document).ready(function(){

    var file_quote = document.querySelector('#quote_file');
    if(file_quote !== null && file_quote !== undefined) {
        file_quote.addEventListener('change', handleFiles, false);
        var quote_file = null;
    }
    $('#reply_request').on('show.bs.modal',function(event){

         var button = $(event.relatedTarget);
         if(button.data('message') !== undefined && button.data('message') !== ''){
             var message = button.data('message');
             var cost = button.data('cost');
             var dp = button.data('dp');
             console.log(button);
             console.log(cost);
             var cost_input = $('#cost');
             var down_payment = $('#down_payment');
             var message_textarea =  $('#message')

             cost_input.attr({
                    'disabled':true,
                    'type':'text',
                    'value':cost
                });
            

            down_payment.attr({
                'disabled':true,
                'value':dp
            })

             message_textarea.attr({
                 'disabled':true
             })

             message_textarea.val(message);

             $('#send_quote').hide();
         }
         else{

             $('#send_quote').show();
             var cost = $('#cost');
             var down_payment = $('#down_payment');

             down_payment.attr({
                 'disabled':false,
                 'value':''
             })

             cost.attr({
                 'disabled':false,
                 'value':''
             })

             var message_textarea =  $('#message')
             message_textarea.attr({
                 'disabled':false,
             })

             message_textarea.val('')


            var rid = button.data('rid');
            var client_id = button.data('cid');
            //var vendor_id = button.data('uid');
            //alert(vendor_id);
            console.log(rid+' '+client_id)
            var url = 'reply_request'
            console.log(url)

            var self = $(this);
            var valid = true;
         }

         $('#send_quote').click(function(){
             
             var form = $('#send_request_form');
             var inputs = form.find('.quo');
        
             inputs.each(function(i,v){
                 if($(this).val() == '' && ( $(this).attr('name') !== 'quote_file' && $(this).attr('name') !== 'down_payment') ){
                     this.focus();
                     $(this).css('border-bottom','solid 1px red');
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
                if(quote_file !== null )
                    fd.append('quote_file', quote_file);
                //fd.append('uid',vendor_id);
                var data = fd;
                submitRequest(data,self,url,button);
                $(this).html('sending quote..');
                $(this).attr('disabled',true);
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
        var r_id = self.data('rid');
        var c_id = self.data('cid');
        //var uid = self.data('uid');

        alertify.logPosition('bottom right');
        alertify.okBtn('Dismiss')
        .cancelBtn('Cancel')
        .confirm('Are You Sure You Want to Dismiss This Request',function(){
             var url = myUrl+'dismiss_request/'+r_id+'/'+c_id;
             $.get(url,{},function(data){
                 if(data.status == undefined || data.status == null) {
                     setTimeout(function(){
                         location.reload(true);
                    },100)
                    alertify.success('Request Dismissed');
                 }
                   
                   
                else{}
            })
        },
        function(){
            alertify.log('Cancelled');
        });
        
        
       
        //console.log(url);

       /* $.get(url,{},function(data){

            console.log(data);
        })*/
    })

    function submitRequest(data,modal,url,button){
        /**Make ajax call */

        $.ajax({
					url:myUrl+'reply_request',
					type:"POST",
                    data:data,
                    contentType:false,
                    processData:false,
					headers:{
						'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr("content")
					},
                    success:function(data){
                        //$('.request').remove();
                        $('#reply_request').modal('hide');
                        var italic = $('<i>').attr('class','fa fa-check-circle-o');
                        $('cbp-caption-defaultWrap').prepend(italic);
                        setTimeout(function() {
                            location.href = location.href+'#messages';
                            location.reload(true);
                        }, 100);
                        alertify.log('Reply Sent');
                    },
                    error:function(err){
                        alertify.alert('An error occured, quote could not be sent ');
                        console.log(err)
                    }
				})
        /**End ajax call */
    }

     $('#soq_modal').on('hidden.bs.modal', function(e) {
         document.querySelector('#getting_quotes').innerHTML = 'Getting Quotes...';
         document.querySelector('#quotes').innerHTML = '';
     })

    $('.show_others_quotes').click(function(e) {
        e.preventDefault();
        $('#soq_modal').modal('show')
        $.ajax({
            url:e.target.parentNode.getAttribute('href'),
            dataType:'JSON',
            method:'GET',
            headers:{
						'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr("content")
                    },
            statusCode:{
                500: function() {
                    alert('Request Cannot be processed at this time please try again later');
                },
                401:function() {
                    alert('session has expired, please login again');
                },
                400:function() {
                    alert('Bad request'); 
                }
            },
            success: function(data) {
                var outerContent = '<ul class="list-group">';
                var content = '';
                if(data.quote.length > 0) {
                    content = data.quote.map(function(quote) {
                        if(quote.vendor !== null) {
                            var li = '<li class="list-group-item quote_li"><h3 class="">'+quote.vendor.name+'</h3>';
                            if(quote.vendor.company_image !== null)
                                li+='<img src="'+myUrl+'storage/images/'+quote.vendor.company_image+'" class="quote_img">';
                            else
                                li+='<img src="'+myUrl+'img/gmc.png" class="quote_img">';
                            var cost = numberFormat(+quote.cost);
                            li+='<div class="quote_content">'
                            li+='<h3>Price: &#8358;'+cost+'</h3>';
                            li+='</div>';
                            li+='</li>';
                            return li;
                        }
                        return '';
                        
                    }).reduce(function(over,quote) {
                        return over+=quote;
                    },'')
                } else content = '<li class="no_quotes">No Quotes Yet</li>';
                var div = document.querySelector('#quotes');
                var getting_quotes = document.querySelector('#getting_quotes');
                getting_quotes.innerHTML = '';
                outerContent+=content;
                div.insertAdjacentHTML('afterbegin',outerContent);
                console.log(content);
            },
            error: function(jqxhr,err,textErr) {
                console.log(textErr);
            }
        });
    })

    function numberFormat(n) {
        return n.toFixed(2).replace(/./g,function(c,i,a){
            return i && c!=="." && ((a.length - i) % 3 === 0) ? ',' + c : c;
        });
    }
    
    function handleFiles() {
        var header = $('#reply_header');
        var send_quote_button = $('#send_quote');
        var text = header.text();
        header.text('Request Reply');
        var text = header.text();
        var imageType = /^image\//, pdfType = /^pdf\//;
        if(this.files.length > 0) {
            var file = this.files[0];
            var size = file.size;
            sizeInKb = (+size)/1000;
            fileType = file.type;
            console.log(fileType);
            if(sizeInKb > 100) {
                header.text(text+' Size exceeds 100kb');
                send_quote_button.attr('disabled', true)
            } else if(!imageType.test(fileType) && !pdfType.test(fileType) ) {
                header.text(text+' File not of type image or pdf');
                send_quote_button.attr('disabled', true)
            } else {
                send_quote_button.attr('disabled', false);
            }
            quote_file = file;
        }
    }
})