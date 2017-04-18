window.onload = function(){
  if(checkNotificationPermission() == 'granted'){
    var subscribe_button = document.getElementById('sb');
    subscribe_button.style.display = 'none';
  }
}

const messaging = firebase.messaging();
navigator.serviceWorker
           .register(customerUrl+'sw.js')
           .then(function(reg){
               messaging.useServiceWorker(reg);

               if(checkNotificationPermission() == 'granted'){
                  messaging.getToken().then(function(token){
                   setServerToken(token);
                   console.log(token);
                 }).catch(function(err){
                   console.error('token could not be generated');
                 }) 
               }
           })       

messaging.onTokenRefresh(function() {
  messaging.getToken()
  .then(function(refreshedToken) {
    console.log('Token refreshed.');
    // Indicate that the new Instance ID token has not yet been sent to the
    // app server.
    setServerToken(refreshedToken);
    console.log(refreshedToken);
    // ...
  })
  .catch(function(err) {
    console.log('Unable to retrieve refreshed token ', err);
    showToken('Unable to retrieve refreshed token ', err);
  });
});


messaging.onMessage(function(payload) {

		var n = new Notification(payload.data.title, { 
			body: payload.data.body,
            icon:'quote.png'
			 // optional
		}); 

    console.log("Message received. ", payload);
    // [START_EXCLUDE]
    // Update the UI to include the received message.
    // [END_EXCLUDE]
  });

  function setServerToken(Token){
    $.ajax({
        url:customerUrl+'set_firebase_token',
        type:'GET',
        data:{token:Token},
        success:function(data){
          console.log('token Saved')
        }
      });
}

function toggleSubscribeButton(){
  var sb = document.getElementById('sb')
  if(checkNotificationPermission() == 'granted'){
    // dont display subscribe button;
    sb.style.display = 'none';
  }
  else{
    sb.style.display = '';
    sb.disabled = false;
  }
}

function subscribeToPush(){

    var sb = document.getElementById('sb');
    sb.innerText = 'subscribing...';
    sb.disabled = true;

    if(checkNotificationPermission() !== 'granted'){

        messaging.requestPermission().then(function(){
                    
            messaging.getToken().then(function(token){
                setServerToken(token);
                sb.innerText = 'subscribed';
                toggleSubscribeButton();
                console.log(token)
            }).catch(function(e){
                console.log('Token not generated')
            })   
        }).catch(function(){
            console.log('Notification not granted');
        })
    }
}


function checkNotificationPermission(){

   return Notification.permission
}