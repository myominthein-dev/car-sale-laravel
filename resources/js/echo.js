import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'reverb',
//     key: import.meta.env.VITE_REVERB_APP_KEY,
//     wsHost: import.meta.env.VITE_REVERB_HOST,
//     wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
//     wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') == 'https',
//     enabledTransports: ['ws', 'wss'],
// });

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: 'y5hlcp1sxeizmzhdmywz', // Your actual key
    wsHost: 'reverb-server.up.railway.app', // Your Railway app URL
    wsPort: 443, // Usually 443 for secure connections on Railway
    wssPort: 443,
    forceTLS: true, // Use TLS for Railway connections
    enabledTransports: ['ws', 'wss'],
    disableStats: true
});
