import Echo from 'laravel-echo'
import Pusher from 'pusher-js'

export default () => {
    const options = {
        broadcaster: 'reverb',
        cluster: '',
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

    Pusher.logToConsole = true

    /*if (['local', 'staging'].includes(usePage().props.env)) {

    }*/

    return new Echo({
        ...options,
        client: new Pusher(options.key, options),
    })
}
