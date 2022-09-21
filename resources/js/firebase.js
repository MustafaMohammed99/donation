// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
// import { getAnalytics } from "firebase/analytics";
import { getMessaging } from "firebase/messaging";

// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional

const firebaseConfig = {
    apiKey: "AIzaSyDcKYe_Wb-7fFFK0WiNAOGDYYNtNwb6qgo",
    authDomain: "donations-c5e62.firebaseapp.com",
    projectId: "donations-c5e62",
    storageBucket: "donations-c5e62.appspot.com",
    messagingSenderId: "1092983884468",
    appId: "1:1092983884468:web:a96112406dbd08070b65e1",
    measurementId: "G-TZ07RZVHFQ"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
// const analytics = getAnalytics(app);
const messaging = getMessaging();
getToken(messaging, { vapidKey: 'BD1FQiLYJw1uvkZPow8VRIQXotG9mMJvR880EsBoO-lCW7uWBNJkgZJyuwqUecwFMozk8-43oJzC0rtSJ6BGXUA' }).then((currentToken) => {
    if (currentToken) {
        // Send the token to your server and update the UI if necessary
        console.log(currentToken)
        // ...
    } else {
        // Show permission request UI
        console.log('No registration token available. Request permission to generate one.');
        // ...
    }
}).catch((err) => {
    console.log('An error occurred while retrieving token. ', err);
    // ...
});
