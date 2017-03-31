importScripts('https://www.gstatic.com/firebasejs/3.5.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/3.5.2/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
firebase.initializeApp({
  'messagingSenderId': '43600357644'
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const message = firebase.messaging();

//message.onMessage.apply(window,f);



//window.onMessage.apply(message,f);


message.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload.data.messsage);
  // Customize notification here
  const notificationTitle = payload.data.title;
  const notificationOptions = {
    body: payload.data.body,
    icon: ''
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});

self.addEventListener('notificationclick', function(event) {
    console.log('[Service Worker] Notification click Received.');

    event.notification.close();

    event.waitUntil(
      clients.openWindow('https://localhost/eventing/public/culogin')
    );
});