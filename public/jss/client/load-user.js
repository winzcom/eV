var currentuser;
var channels = {};
var computeChatPop;
var ChannelHandler = {};
var currentUserId;
var userIds = [];
var sb;
var chatPops = [];
var currentChannel;

(function(){
    /** LOAD ALL REQUIRED DATA */

    var SB = {
        getChannelBetweenClientAndVendor:getChannelBetweenClientAndVendor,
        getChatPops:function() {
            return chatPops;
        },
        computeChatPop:computeChatPop
    }

    loadUserData(window.location.origin+'/user/client').then(function(){
        SendBirdAction();
    });
    
    function loadUserData(url) {
        return new Promise(function(resolve,reject){
           $.get(url,function(data){
               currentuser = data;
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
            sb.updateCurrentUserInfo(currentuser['user']['name'], null, function(response, error) {
                currentuser['nick_name'] = currentuser['user']['name'];
              });
            // if(currentuser['vendor'].length > 0) {
            //     Array.prototype.forEach.call(currentuser['vendor'],function(vendor){
            //         if(vendor['channel_url'])
            //         sb.GroupChannel.getChannel(vendor['channel_url'],function(channel,err){
            //             if(err) {
            //                 return;
            //             } channels[vendor['channel_url']] = channel;
            //             console.log(channel);
            //         });
            //     });
            // }
        });
    
       ChannelHandler = new sb.ChannelHandler();
        console.log(ChannelHandler);
        ChannelHandler.onMessageReceived = function(channel, message){
            var message_container = $('<div class="message_container"></div>');
            var message_div = $('<div class="message_div"></div>');
            var msg = `<h3>${message._sender.nickname}</h3> 
                            <p>${message.message}</p>`;
            var h5 = $(`<h5>${message._sender.nickname}</h5>`);
            var p = $(`<p>${message.message}</p>`);
            if($(message._sender.userId).length) {
                //Just add message
                // var img = $(`<img src="${message._sender.profileUrl}">`).width('100').height('auto');
                // message_div.addClass('').append([h5,img,p]);
                // message_container.append(message_div);
                // message_container.appendTo($('.messages'));
                computeChatPop(message._sender.userId);
            }
            else {
                    alertify.log(msg,function(e){
                        e.preventDefault();
                        currentUserId = message._sender.userId;
                        userIds.push(message._sender.userId);
                        computeChatPop(message._sender.userId);
                        //$('#chat-vendor').modal('show');
                    });
                }
        };
        sb.addChannelHandler('group-channel-handler', ChannelHandler);
    }

    function computeChatPop(userId,name) {
        var windowWidth = window.innerWidth;
        if($(+'#'+userId).length) {
            var msg_receive = $(`<div class="msg-receive"></div>`).appendTo($(`<div class="msg-insert"></div>`));
            $('#'+userId).find('.msg-insert').append(msg_receive);
        } else {
            if(windowWidth >= 540) {
                if(chatPops.length < 5) {
                    displayPop(userId,name);
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
            console.log(channelList);
            currentChannel = channelList[0];
            channels[vendor_id] = currentChannel;
            return channelList[0];
        });
    }      
}

    function displayPop(userId,name) {
        var div = $(`<div class"wrapper" id="${userId}"></div>`).appendTo($('body'));
        var chat_box = $(`<div class="chat-box"></div>`).appendTo(div);
        var chat_head = $(`<div class="chat-head"></div>`).append(`<h2>${name}</h2>`).appendTo(chat_box).css('color','white');
        var chat_body = $(`<div class="chat-body"></div>`).appendTo(chat_box)
        var msg_insert = $(`<div class="msg-insert"></div>`).appendTo(chat_body);
        var chat_text = $(`<div class="chat-text"></div>`).appendTo(chat_body);
        var send_text_area = $(`<textarea data-user-id ="${userId}" class="send-chat"></textarea>`).appendTo(chat_text);
    }

    function sendMessage(message,data,callback) {

    }
    window.SB = SB;
})()