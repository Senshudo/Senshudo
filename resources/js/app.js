import Layout from '@/layouts/default.vue'
import { Ziggy } from '@/routes/routes.js'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createApp, h } from 'vue'
import { ZiggyVue } from 'ziggy-js'
import '../css/app.css'

globalThis.Ziggy = Ziggy

createInertiaApp({
    progress: {
        color: '#4B5563',
    },
    resolve: (name) =>
        resolvePageComponent(`./pages/${name}.vue`, import.meta.glob('./pages/**/*.vue')).then(
            (module) => {
                const page = module.default

                page.layout = page.layout || Layout

                return page
            },
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, {
                ...Ziggy,
                location: props?.initialPage?.props?.location
                    ? new URL(props.initialPage.props.location)
                    : null,
            })
            .mount(el)
    },
})
