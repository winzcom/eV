var currentuser;
var channels = {};
var computeChatPop;
var ChannelHandler = {};
var currentUserId;
var notifyCount = {};
var userIds = [];
var sb;
var chatPops = [];
var currentChannel;
var audioSoundBuffer = null;

window.onload = function () {
    (function(){
        /** LOAD ALL REQUIRED DATA */
        var openchat = document.querySelector('.openchat');
        openchat !== null && openchat.length > 0 ? openchat.setAttribute('disabled',true) : null
        var SB = {
            getChannelBetweenClientAndVendor:getChannelBetweenClientAndVendor,
            computeChatPop:computeChatPop,
            readySendInput:readySendInput,
            loadPreviousMessage:loadPreviousMessage
        }
    
        loadUserData(window.location.origin+'/user/client').then(function(){
            SendBirdAction();
            openchat !== null && openchat.length > 0 ? loadChatVendorScript() : null;
            //loadChatVendorScript();
        });
    
        function loadChatVendorScript() {
            var script = document.createElement('script');
            script.src = window.location.origin+'/jss/client/chat-vendor.js';
            script.onload = function(openchat) {
                if(openchat)
                    $(openchat).attr('disabled',false);
            }.bind(null,[openchat])
            document.body.appendChild(script);
        }
        
        function loadUserData(url) {
            return new Promise(function(resolve,reject){
               $.get(url,function(data){
                   currentuser = data;
                   currentUserId = data['user']['id'];
                   console.log(currentuser);
                   resolve(true);
                }).fail(function(err){
                   reject(err)
                });
            });
        }
        
        function SendBirdAction() {
            sb = new SendBird({
                appId:'E0386319-775D-4AA4-AFA1-667748BDF191'
            });
        
            sb.connect(currentuser['user']['id'],function(user,error){
                currentuser['sb_user'] = user;
                console.log(user);
                sb.updateCurrentUserInfo(currentuser['user']['name'], null, function(response, error) {
                    currentuser['nick_name'] = currentuser['user']['name'];
                  });
            });
           var ConnectionHandler = new sb.ConnectionHandler();    
           ConnectionHandler.onReconnectStarted = function(){
               alertify.log('Network not available');
               $(`.send-chat`).attr('disabled',true);
           };
           ConnectionHandler.onReconnectSucceeded = function(){
            alertify.log('Network available');
            $(`.send-chat`).attr('disabled',false);
           }
    
           ChannelHandler = new sb.ChannelHandler();
            
            ChannelHandler.onMessageReceived = function(channel, message){
                console.log(channel);
                console.log(message);
                var msg = $(`<h3>${message._sender.nickname}</h3> 
                                <p>${message.message}</p>`).css({
                                    'backgroundColor':'white',
                                    'color':'black',
                                    'textAlign':'center',
                                    'margin':'auto 0px'
                                }).toString();
                if(channel.memberMap[currentUserId]) {
                    if($(`#${message._sender.userId}`).length) {
                        var msg_insert = $(`#${message._sender.userId} .chat-box .chat-body .msg-insert`);
                        $(`<div class="msg-receive">${message.message}</div>`).appendTo(msg_insert);
                    }
                    else {
                            alertify.success(msg,function(e){
                                userIds.push(message._sender.userId);
                                computeChatPop(message._sender.userId,message._sender.nickname);
                                loadPreviousMessage(channel,message._sender.userId)
                            });
                        }
                }
            };
            sb.addChannelHandler('group-channel-handler', ChannelHandler);
        }
    
        function computeChatPop(userId,name,message = null) {
            var windowWidth = window.innerWidth;
            if($('#'+userId).length) {
                var msg_receive = $(`<div class="msg-receive"></div>`).appendTo($(`<div class="msg-insert"></div>`));
                $('#'+userId).find('.msg-insert').append(msg_receive);
            } else {
                if(windowWidth >= 540) {
                    if(chatPops.length < 5) {
                        displayPop(userId,name);
                        chatPops.push(userId);
                    } else {
                        id_url = chatPops.shift();
                        $('#'+id_url).remove();
                        chatPops.push(userId);
                        displayPop(userId,name);
                    }
                }
            }
        }
    function getChannelBetweenClientAndVendor(vendor_id) {
        if(Object.keys(channels).indexOf(vendor_id) > -1) {
            return;
        }
        var channelListQuery = sb.GroupChannel.createMyGroupChannelListQuery();
        channelListQuery.userIdsFilter = [vendor_id]; 
        //channelListQuery.queryType = "AND";  
        if (channelListQuery.hasNext) {
            channelListQuery.next(function(channelList, error){
                if (error) {
                    console.error(error);
                    return;
                }
                if(channelList.length) {
                    currentChannel = channelList[0];
                    channels[vendor_id] = currentChannel;
                    return channelList[0];
                }
                createChannel([user['user']['id'],vendor_id]);
            });
        }      
    }
    
    function createChannel(ids = [],name = 'name') {
        sb.GroupChannel.createChannelWithUserIds(ids,true,name,null,null,function(channel,err){
            if(!err) {
                currentChannel = channel;
                channels[ids[1]] = channel;
            }
        });
    }

    function displayPop(userId,name) {
        var div = $(`<div class"wrapper" id="${userId}"></div>`).appendTo($('body'));
        var chat_box = $(`<div class="chat-box"></div>`).appendTo(div);
        var chat_head = $(`<div class="chat-head"></div>`).append(`<h2>${name}</h2>`)
                            .appendTo(chat_box).css({
                                'color':'white',
                                'textAlign':'center',
                                'paddingBottom':'20px'
                            });
        var chat_body = $(`<div class="chat-body"></div>`).appendTo(chat_box);
        var msg_insert = $(`<div class="msg-insert"></div>`).appendTo(chat_body);
        var chat_text = $(`<div class="chat-text"></div>`).appendTo(chat_body);
        var send_text_area = $(`<textarea data-user-id ="${userId}" class="send-chat"></textarea>`).appendTo(chat_text);
    }

    function loadPreviousMessage(currentChannel,id) {
        var messageListQuery = currentChannel.createPreviousMessageListQuery();
        messageListQuery.load(30, true, function(message_list, error){
          if (error) {
              console.error(error);
              return;
          }
          console.log(message_list)
          window.requestAnimationFrame(function(time){
             displayPreviousMessages(message_list,id);
             readySendInput(id,currentChannel);
          })
        })
    }

    function getIds(arrayOfMembers) {
        return [].map.call(arrayOfMembers,function(mem){
            return mem.id;
        })
    }

    function readySendInput(id,channel = null) {
        console.log(channel);
        $(`#${id} .chat-box .chat-body .send-chat`).keypress(function(event){
            
            var self = this;
            var msg_insert = $(`#${id} .chat-box .chat-body .msg-insert`);
            var val = $(this).val();
            if(event.keyCode == 13 && val !== '') {
                $(`<div class="msg-send">${val}</div>`).appendTo(msg_insert);
                if(channel.memberMap[id].connectionStatus == 'offline') {
                    $(`<span id="connection-status"></span>`).text('User is currently offline').insertAfter($(`#${id} .chat-box .chat-head h2`))
                    //Send Mail to the person
                    NotifyUser(id,currentuser['user']['name']);
                }
                channel.sendUserMessage(val,null,null,function(message,err){
                    if(err) {
                        console.log(err);
                        alertify.log('connection error message couldnt be sent');
                        return;
                    }
                      
                    else console.log(message);
                 });
                 self.value = ''; 
            }
        }).attr('disabled',false);
    }
    
    function displayPreviousMessages(message_list,id) {
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
        var msg_insert = $(`#${id} .chat-box .chat-body .msg-insert`);
        for (var index = message_list.length - 1; index >= 0 ; index--) {
            if(index & 1) message_list[index]._sender.userId = 12;
            if(message_list[index]._sender.userId == currentuser['user']['id']) {
                $(`<div class="msg-send">${message_list[index].message}</div>`).appendTo(msg_insert);
            } else {
                $(`<div class="msg-receive">${message_list[index].message}</div>`).appendTo(msg_insert);
            } 
        }
        // [].forEach.call(message_list,function(message_object,index) {
            
        // });
    }
    
    function NotifyUser(vendor_id,currentusername) {
        if(notifyCount[vendor_id] !== undefined && notifyCount[vendor_id]['count'] >= 2) {
            if(((notifyCount[vendor_id]['time']/1000)/60) <= 20) {
                notifyCount[vendor_id]['count'] = 0;
            }
            return;
        }
        $.get(`${window.location.origin}/chat-notification/vendor/${vendor_id}`,function(data){
            //notifyCount[client_id]['count'] += 1;
            //notifyCount[client_id]['time'] = new Date().getMilliseconds();
        }).fail(function(response){
            alertify(response.message);
        })
    }

    function sendMessage(message,data,callback) {

    }
        window.SB = SB;
    })()
}