
const messaging = firebase.messaging();
var regg;
navigator.serviceWorker
           .register(customerUrl+'sw.js')
           .then(function(reg){
               regg = reg;
               messaging.useServiceWorker(reg);

               if(checkNotificationPermission() !== 'granted'){

                    messaging.requestPermission().then(function(){
                    
                      messaging.getToken().then(function(token){
                          console.log(token)
                      }).catch(function(e){
                          console.log('Token not generated')
                      })   
                  }).catch(function(){
                      console.log('Notification not granted');
                  })
               }

               else{
                 messaging.getToken().then(function(token){
                   console.log(token);
                 }) 
               }
               
           })       

messaging.onTokenRefresh(function() {
  messaging.getToken()
  .then(function(refreshedToken) {
    console.log('Token refreshed.');
    // Indicate that the new Instance ID token has not yet been sent to the
    // app server.
    console.log(refreshedToken);
    // ...
  })
  .catch(function(err) {
    console.log('Unable to retrieve refreshed token ', err);
    showToken('Unable to retrieve refreshed token ', err);
  });
});

 /*messaging.useServiceWorker(regg);
messaging.getToken().then(function(token){
    console.log(token);
})*/


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

/*navigator.permissions.query({name:'notifications'})
  .then(function(permissionStatus) {  
   
    if(permissionStatus.state !== 'granted'){
        
        messaging.requestPermission()
        .then(function() {
        console.log('Notification permission granted.');
        // TODO(developer): Retrieve an Instance ID token for use with FCM.
            messaging.useServiceWorker(regg)
            messaging.getToken().then(function(currentToken){

                console.log(currentToken);
                console.log('not there');
            }) 
        })
    } 

    else{
                messaging.useServiceWorker(regg)
                messaging.getToken().then(function(currentToken){
                console.log(currentToken);
            }) 
    }
});*/


/*var json = {
     "to": "cM4OLwbQQrw:APA91bEKjczBpHAWEix1H8HDWDZpW2pyzEparIhjC77jrB5K74hId5J2nfKsraGhLBrzvN2NAX4ggU4lni-uZjRzcGAdbBHeST0y7dWh6SrwW4Pv2shvnNNEQnW4FQ0IzAa_ohX03dUl",
     "notification": {
       "title": "Push Notification",
       "body": "Hay Sent!"
     },
     "data": {
       "titulo": "!",
       "descricao": "Corpo dos dados..."
     }
   };

   $.ajax({
    url: 'https://fcm.googleapis.com/fcm/send',
    type: "POST",
    processData : false,
    beforeSend: function (xhr) {
      xhr.setRequestHeader('Content-Type', 'application/json');
      xhr.setRequestHeader('Authorization', 'key=AIzaSyAP2Bn2-qtgcXehXVSp004puevZ1gkUy0M');
    },
    data: JSON.stringify(json),
    success: function () {
      //console.log("Mensagem enviada com sucesso!");
    },
    error: function(error) {
      //console.log(error);
    }
  });*/
function checkNotificationPermission(){

   return Notification.permission
}