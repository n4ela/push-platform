'use strict';

/* eslint-disable max-len */

const applicationServerPublicKey = '$KEY'

/* eslint-enable max-len */

function urlB64ToUint8Array(base64String) {
  const padding = '='.repeat((4 - base64String.length % 4) % 4);
  const base64 = (base64String + padding)
    .replace(/\-/g, '+')
    .replace(/_/g, '/');

  const rawData = window.atob(base64);
  const outputArray = new Uint8Array(rawData.length);

  for (let i = 0; i < rawData.length; ++i) {
    outputArray[i] = rawData.charCodeAt(i);
  }
  return outputArray;
}

self.addEventListener('push', function(event) {
  console.log('[Service Worker] Push Received.');
  var data = event.data.json();
  console.log(data);
  var promise = self.registration.showNotification(data.title, {
    body: data.body,
    icon: data.icon,
    image: data.image,
    data: data.click_action
  });
  event.waitUntil(promise);
});

self.addEventListener('notificationclick', function(event) {
  console.log(event);
  const target = event.notification.data || '/';
  event.notification.close();
  return clients.openWindow(target);
});

self.addEventListener('pushsubscriptionchange', function(event) {
  console.log('[Service Worker]: \'pushsubscriptionchange\' event fired.');
  const applicationServerKey = urlB64ToUint8Array(applicationServerPublicKey);
  event.waitUntil(
    self.registration.pushManager.subscribe({
      userVisibleOnly: true,
      applicationServerKey: applicationServerKey
    })
      .then(function(newSubscription) {
        var key = newSubscription.getKey ? newSubscription.getKey('p256dh') : '';
        var auth = newSubscription.getKey ? newSubscription.getKey('auth') : '';
        return fetch('$SERVER_URL', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            endpoint: newSubscription.endpoint,
            key: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : '',
            auth: auth ? btoa(String.fromCharCode.apply(null, new Uint8Array(auth))) : ''            
          })
        }).then(function(response) {
          if (!response.ok) {
            throw new Error('Bad status code from server.');
          }

          console.log(response);
        });
      }))
});
