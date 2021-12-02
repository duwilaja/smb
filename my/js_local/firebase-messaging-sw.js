importScripts("https://www.gstatic.com/firebasejs/7.16.1/firebase-app.js");
importScripts(
    "https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js",
);
// For an optimal experience using Cloud Messaging, also add the Firebase SDK for Analytics.
importScripts(
    "https://www.gstatic.com/firebasejs/7.16.1/firebase-analytics.js",
);

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
firebase.initializeApp({
    messagingSenderId: "692559198635",
    apiKey: "AIzaSyAUgARs4qI7rHFI10UdkBkhOwwvHnXbG1k",
    projectId: "web-solo-59597",
    appId: "1:692559198635:web:2b46ab6699a6ae42d37aee",
});
// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

// self.addEventListener('notificationclick', function (event) {
//     // console.log(event);
//     if (event.close)
//         event.close();
// });
messaging.setBackgroundMessageHandler(function (payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    // Customize notification here
    const notificationTitle = payload.data.mesgTitle;
    const notificationOptions = {
        body: payload.data.alert,
        // icon: "/itwonders-web-logo.png",
    };
    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});