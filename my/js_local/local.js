

// TODO: Replace firebaseConfig you get from Firebase Console
var firebaseConfig = {
    apiKey: "AIzaSyAUgARs4qI7rHFI10UdkBkhOwwvHnXbG1k",
    authDomain: "web-solo-59597.firebaseapp.com",
    projectId: "web-solo-59597",
    storageBucket: "web-solo-59597.appspot.com",
    messagingSenderId: "692559198635",
    appId: "1:692559198635:web:2b46ab6699a6ae42d37aee",
    measurementId: "G-F35VC41GCK"
};
firebase.initializeApp(firebaseConfig);
async function play() {
    let audio = new Audio("https://backoffice.elingsolo.com/sm-ci/my/sirine.wav");
    return await audio.play();
}
register();
async function register() {
    if (window.navigator && navigator.serviceWorker) {
        let registrations = await navigator.serviceWorker.getRegistrations();
        if (registrations) {
            for (let registration of registrations) {
                console.log("YUHU", registration);
                registration.unregister();
            }
        }
        navigator.serviceWorker.register('./my/js_local/firebase-messaging-sw.js')
            .then((registration) => {

                const messaging = firebase.messaging();
                messaging.useServiceWorker(registration);

                messaging
                    .requestPermission()
                    .then(function () {
                        // MsgElem.innerHTML = 'Notification permission granted.';
                        console.log('Notification permission granted.');

                        // get the token in the form of promise
                        return messaging.getToken();
                    })
                    .then(function (token) {
                        // TokenElem.innerHTML = 'Device token is : <br>' + token;
                        console.log("TOKEN", token);
                        $.ajax({
                            type: "post",
                            url: "./Api/save_uidfcm",
                            data: {
                                'token': token
                            },
                            dataType: "json",
                            success: function (response) {
                                console.log('sending');
                            }
                        });
                    })
                    .catch(function (err) {
                        // ErrElem.innerHTML = ErrElem.innerHTML + '; ' + err;
                        console.log('Unable to get permission to notify.', err);
                    });

                let enableForegroundNotification = true;

                messaging.onMessage(function (payload) {
                    console.log('Message received. ', payload);
                    play();
                    if (enableForegroundNotification) {
                        let notification = payload.data;
                        navigator.serviceWorker
                            .getRegistrations()
                            .then((reg) => {
                                console.log(reg, "======");
                                reg[0].showNotification(notification.mesgTitle, { body: notification.alert});
                            });
                    }
                });
            });
    }
}

