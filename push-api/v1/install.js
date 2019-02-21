'use strict';

const applicationServerPublicKey = '$KEY';

let swRegistration = null;

function rNmXm(min, max) {
  return Math.round(Math.random() * (max - min)) + min;
};

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

function goToOffer() {
  window.location.href = '$BINOM_URL/click.php?lp=1&' + window.location.search.substring(1);
}

function updateSubscriptionOnServer(subscription) {
  if (subscription) {
    var key = subscription.getKey ? subscription.getKey('p256dh') : '';
    var auth = subscription.getKey ? subscription.getKey('auth') : '';
    return fetch('$SERVER_URL', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        endpoint: subscription.endpoint,
        key: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : '',
        auth: auth ? btoa(String.fromCharCode.apply(null, new Uint8Array(auth))) : '',
        url: window.location.href        
      })
    })
      .then(function(response) {
        if (!response.ok) {
          throw new Error('Bad status code from server.');
        }
        goToOffer();
      });
  }
}

function subscribeUser() {
  const applicationServerKey = urlB64ToUint8Array(applicationServerPublicKey);
  swRegistration.pushManager.subscribe({
    userVisibleOnly: true,
    applicationServerKey: applicationServerKey
  })
    .then(function(subscription) {
      console.log('User is subscribed.');
      updateSubscriptionOnServer(subscription);
    })
    .catch(function(err) {
      console.log('Failed to subscribe the user: ', err);
      goToOffer();
    });
}


function checkSubscribe() {
  swRegistration.pushManager.getSubscription()
    .then(function(subscription) {
      var isSubscribed = !(subscription === null);
      if (isSubscribed) {
        goToOffer();
      } else {
        console.log('User is NOT subscribed.');
        subscribeUser();
      }
    });
}

if ('serviceWorker' in navigator && 'PushManager' in window) {
  console.log('Service Worker and Push is supported');
  navigator.serviceWorker.register('/push-api/v1/push.js')
    .then(function(swReg) {
      console.log('Service Worker is registered', swReg);
      swRegistration = swReg;
      checkSubscribe();
    })
    .catch(function(error) {
      console.error('Service Worker Error', error);
      goToOffer();
    });
} else {
  console.warn('Push messaging is not supported');
  goToOffer();
}
