import { register } from 'register-service-worker';
register('/service-worker.js', {
    registrationOptions: { scope: './' },
    ready (registration) {
        console.log('Service worker is active.')
    },
    registered (registration) {
        console.log('Service worker has been registered.')
    },
    cached (registration) {
        console.log('Content has been cached for offline use.')
    },
    updatefound (registration) {
        console.log('New content is downloading.')
    },
    updated (registration) {
        console.log('New content is available; please refresh.')
    },
    offline () {
        console.log('No internet connection found. App is running in offline mode.')
    },
    error (error) {
        console.error('Error during service worker registration:', error)
    }
});
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
