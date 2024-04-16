import Echo from 'laravel-echo'
import Pusher from 'pusher-js'

export default () => {
    if (typeof window === 'undefined') {
        return null
    }

    const options = {
        broadcaster: 'reverb',
        key: import.meta.env.VITE_REVERB_APP_KEY,
        wsHost: import.meta.env.VITE_REVERB_HOST,
        wsPort: import.meta.env.VITE_REVERB_PORT,
        wssPort: import.meta.env.VITE_REVERB_PORT,
        forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
        enabledTransports: ['ws', 'wss'],
    }

    if (!options.key) {
        return null
    }

    if (['local', 'staging'].includes(usePage().props.env)) {
        Pusher.logToConsole = true
    }

    return new Echo({
        ...options,
    })
}
