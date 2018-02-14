var currentuser;
var channels = {};
var ChannelHandler = {};
var currentUserId = null;
var sb;
var currentChannel;

(function(){
    /** LOAD ALL REQUIRED DATA */

    var SBWrapper = function() {
        
    }
    loadUserData(window.location.origin+'/user').then(function(){
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
            if(currentuser['client'].length > 0) {
                Array.prototype.forEach.call(currentuser['client'],function(vendor){
                    try {
                        sb.GroupChannel.getChannel(vendor['channel_url'],function(channel,err){
                            if(err) {
                                return;
                            } channels[vendor['channel_url']] = channel;
                        });
                    } catch(err) {
                       return;
                    }
                });
            }
        });
    
       ChannelHandler = new sb.ChannelHandler();
        ChannelHandler.onMessageReceived = function(channel, message){
            // alertify.success(message._sender.nickname+'  '+message.message)
            console.log(channel);
            console.log(message);
            var msg = `<h3>${message._sender.nickname}</h3> 
                        <p>${message.message}</p>`;
            if($('#chat-vendor').hasClass('show')) {
                if(currentChannel.url === channel.url) {
                        //Just add message
                }
            } else {
                    alertify.log(msg,function(e){
                        e.preventDefault();
                        currentUserId = message._sender.userId;
                        $('#chat-vendor').modal('show');
                    });
                }
        };
        sb.addChannelHandler('group-channel-handler', ChannelHandler);
    }


})()