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

const CACHE = 'my-cache-v1';
//message.onMessage.apply(window,f);

var vendor_file_to_cache = [

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
    'js/vide.js',
    'js/fitvids.js',
    'owl-carousel/owl.carousel.min.js',
    'js/jflickrfeed.js',
    'js/tweecool.js',
    'js/chart.js',
    'js/totop.js',
    'js/sm-scroll.js',
    'js/smooth-scroll.js',
    'js/ajaxchimp.js',
    'js/contact.js',
    'js/form.js',
    'js/validate.js',
    'js/tempo.js',
    'js/main.js'
]

//window.onMessage.apply(message,f);


self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(CACHE).then(function(cache) {
      console.log('caching')
      return cache.addAll(vendor_file_to_cache);
    })
  );
});

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
      clients.openWindow('https://localhost/eventing/culogin')
    );
});