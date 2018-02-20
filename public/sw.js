importScripts('https://www.gstatic.com/firebasejs/3.5.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/3.5.2/firebase-messaging.js');
//importScripts('https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js');

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
firebase.initializeApp({
  'messagingSenderId': '43600357644'
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const message = firebase.messaging();

const CACHE = 'my-cache-v1';
const CACHE2 = 'my-cache-v2';
const CACHE3 = 'my-cache-v3';
const CACHE4 = 'my-cache-v4';
const CACHE5 = 'my-cache-v5';
const CACHE6 = 'my-cache-v5';
//message.onMessage.apply(window,f);

var files_to_cache = [
    'js/vendor/jquery.js',
    'js/vendor/bootstrap.js',
    'js/easing.js',
    'js/scrollbar.js',
    'js/retina.js',
    'js/raphael.js',
    'js/tabs.js',
    'js/livicons.js',
    'js/icheck.js',
    'js/mousewheel.js',
    'js/selectik.js',
    'js/spinedit.js',
    'js/wow.js',
    'js/hover-dropdown.js',
    'js/classie.js',
    'cloudslider/js/cloudslider.jquery.min.js',
    'cubeportfolio/js/jquery.cubeportfolio.js',
    'vendor/js/eazyForm.js',
    'nivo-lightbox/nivo-lightbox.min.js',
    'js/appear.js',
    'js/pie-chart.js',
    'favicon-32x32.png',
    'style.css',
    'js/vide.js',
    'js/fitvids.js',
    'owl-carousel/owl.carousel.min.js',
    'img/headers/header4.jpg',
    'img/logos/logo.png',
    'img/slides/landing-page/event.jpg',
    'js/totop.js',
    'js/sm-scroll.js',
    'js/smooth-scroll.js',
    'js/contact.js',
    'js/tempo.js',
    'customcss/all.css',
    //'https://www.gstatic.com/firebasejs/3.6.9/firebase.js',
    'https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.js',
    'https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js',
    'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
    'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js'
]

//window.onMessage.apply(message,f);


self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(CACHE6).then(function(cache) {
      console.log('caching')
      return cache.addAll(files_to_cache);
    })
  );
  self.skipWaiting();
});//done there

self.addEventListener('activate', function(event) {
  event.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.filter(function(name) {
          return name != CACHE6;
        }).map(function(name) {
          return caches.delete(name);
        })
      ) 
    })
  );
  return self.clients.claim();
})

// self.addEventListener('fetch',function(event) {
//    event.respondWith(
//       caches.match(event.request).then(function(response) {
//         return response || fetch(event.request).then(function(response) {
//           return response;
//         })
//       })
//    );
// });


message.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload.data.messsage);
  // Customize notification here
  const notificationTitle = payload.notification.title;
  const notificationOptions = {
    body: payload.notification.body,
    icon: ''
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});

self.addEventListener('notificationClick', function(event) {
    console.log('[Service Worker] Notification click Received.');

    event.notification.close();

    event.waitUntil(
      clients.openWindow('https://eventpad.ng/culogin')
    );
});
