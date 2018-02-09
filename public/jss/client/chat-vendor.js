
$(document).ready(function(){
    var interval;
    /************* 
     *  OPEN CHAT
     **************/
    //OnChatOpen();
    openChatWithVendor();
    OnChatClose();
    function OnChatOpen() {
        $('#chat-vendor').on('show.bs.modal',function(event) {
           var button = $(event.relatedTarget);
           var vendor_channel_url = button.data('vendorChannelUrl');
           var vendor_id = button.data('vendorId') || currentUserId;

            if(vendor_id) {
                var channel = SB.getChannelBetweenClientAndVendor(vendor_id);           
            }
            else {
                sb.GroupChannel.createChannelWithUserIds([currentuser['user']['id'],vendor_id],true,'name',null,null,function(channel,err){
                    if(!err) {
                        currentChannel = channel;
                        channels[vendor_id] = channel;
                        $(event.relatedTarget).data('vendorChannelUrl',channel.url);
                        currentChannel.inviteWithUserIds([vendor_id],function(response,err){
                            if(err)
                                return;
                        });
                        sendChannelUrlToServer(channel.url,vendor_id);
                    }
                });
            }

            $('#send_chat_message').attr('disabled',true).html('getting channel ready..');
            $('#chat-message').attr('disabled',true);

          window.requestAnimationFrame(checkCurrentChannel);

           var vendor_id = button.data('vendorId');
           $('.modal-title').html('Chat with '+button.data('vendorName'));
           $(this).find('.messages').css('height',200).css('overflow-y','scroll');
    
           $(this).find('#send_chat_message').click(function(){
               //currentChannel.sendMessage($('#chat-message').val());
           });
           $(this).find('#chat-message').keypress(function(event){
               var self = this;
               if(event.keyCode === 13 && this.value !== '') {
                 currentChannel.sendUserMessage(this.value,null,null,function(message,err){
                    if(err) {
                        alertify.log('connection error message couldnt be sent');
                        return;
                    }
                      
                    else console.log(message);
                    self.value = ''; 
                 });
               }
           })
        });
   
     }

     function openChatWithVendor() {
         $('.openchat').click(function() {
            var clicked = $(this);
            var vendor_id = clicked.data('vendorId');
            var callback = function(start_time) {
                if(!channels[vendor_id]) {
                    window.requestAnimationFrame(callback);
                    return;
                }
                console.log(channels[vendor_id]);
                SB.computeChatPop(vendor_id,clicked.data('vendorName'));
                loadPreviousMessage(channels[vendor_id],vendor_id);
            }
            if($(`#${vendor_id}`).length !== 0) return;
            SB.getChannelBetweenClientAndVendor(vendor_id);
            window.requestAnimationFrame(callback);
         });
     }

     function OnChatClose() {
         $('#chat-vendor').on('hidden.bs.modal',function(event){
            $(this).find('.messages').html('');
         })
     }

     function loadPreviousMessage(currentChannel,vendor_id) {
        var messageListQuery = currentChannel.createPreviousMessageListQuery();
        messageListQuery.load(30, true, function(message_list, error){
          if (error) {
              console.error(error);
              return;
          }
          console.log(message_list)
          displayPreviousMessages(message_list,vendor_id);
       });
     }

     function sendChannelUrlToServer(channel_url,vendor_id) {
         $.get(window.location.origin+'/add-new-channel/'+vendor_id+'/'+channel_url,function(){

         }).fail(function(err){

         });
     }

     function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    };

    function checkCurrentChannel() {
        if(currentChannel !== undefined && currentChannel !== null) {
            $('#send_chat_message').attr('disabled',false).html('Send');
            $('#chat-message').attr('disabled',false);
            loadPreviousMessage(currentChannel);
            //clearInterval(interval);
            return;
        } 
        window.requestAnimationFrame(checkCurrentChannel);
    }

    function displayPreviousMessages(message_list,vendor_id) {
        if(!message_list)
            return;
        // var message_container = $('<div class="message_container"></div>');
        // message_list.forEach(function(message_object){
        //     var message_div = $('<div class="message_div"></div>');
           
        //     if(message_object._sender.userId !== currentuser['user']['id']) {
        //         var h5 = $('<h5>you</h5>');
        //         var p = $(`<p>${message_object.message}</p>`);
        //         var img = $(`<img src="${message_object._sender.profileUrl}">`).width('100').height('auto');
        //         message_div.addClass('').append([h5,img,p]);
        //     }
        //     message_container.prepend(message_div);
        // });
        // message_container.appendTo($('.messages'));
        var msg_insert = $('#'+vendor_id).length;
        console.log(msg_insert);
        [].forEach.call(message_list,function(message_object) {
            if(message_object._sender.userId !== currentuser['user']['id']) {
                $(`<div class="msg-send">${message_object.message}</div>`).appendTo(msg_insert);
            } else {
                $(`<div class="msg-receive">${message_object.message}</div>`).appendTo(msg_insert);
            } 
        });
    }

     window.onunload = function() {
         sb.disconnect();
     }
});