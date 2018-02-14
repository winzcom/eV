var currentuser;
var channels = {};
var computeChatPop;
var ChannelHandler = {};
var currentUserId;
var userIds = [];
var sb;
var chatPops = [];
var currentChannel;
var audioSoundBuffer = null;

(function(){
    /** LOAD ALL REQUIRED DATA */
    var SB = {
        getChannelBetweenClientAndVendor:getChannelBetweenClientAndVendor,
        computeChatPop:computeChatPop
    }

    loadUserData(window.location.origin+'/user').then(function(){
        SendBirdAction();
        openchat.length > 0 ? loadChatVendorScript() : null;
    });

    function loadChatVendorScript() {
        var script = document.createElement('script');
        script.src = window.location.origin+'/jss/client/chat-vendor.js';
        script.onload = function(openchat) {
            $(openchat).attr('disabled',false);
        }.bind(null,[openchat])
        document.body.appendChild(script);
    }
    
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
        });
       var ConnectionHandler = new sb.ConnectionHandler();    
       ConnectionHandler.onReconnectStarted = function(){
           alertify.log('Network not available connecting...');
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
            var msg = `<h3>${message._sender.nickname}</h3> 
                            <p>${message.message}</p>`;
            if($(`#${message._sender.userId}`).length) {
                var msg_insert = $(`#${message._sender.userId} .chat-box .chat-body .msg-insert`);
                $(`<div class="msg-receive">${val}</div>`).appendTo(msg_insert);
            }
            else {
                    alertify.log(msg,function(e){
                        userIds.push(message._sender.userId);
                        computeChatPop(message._sender.userId);
                    });
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
function getChannelBetweenClientAndVendor(client_id) {
    if(Object.keys(channels).indexOf(client_id) > -1) {
        return;
    }
    var channelListQuery = sb.GroupChannel.createMyGroupChannelListQuery();
    channelListQuery.userIdsFilter = [client_id]; 
    //channelListQuery.queryType = "AND";  
    if (channelListQuery.hasNext) {
        channelListQuery.next(function(channelList, error){
            if (error) {
                console.error(error);
                return;
            }
            if(channelList.length) {
                currentChannel = channelList[0];
                channels[client_id] = currentChannel;
                return channelList[0];
            }
            createChannel([user['user']['id'],client_id]);
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

    function sendMessage(message,data,callback) {

    }
    window.SB = SB;
})()