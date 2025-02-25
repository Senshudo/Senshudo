import '../css/app.css'

import Layout from '@/layouts/default.vue'
import routes from '@/routes/routes.json'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { trail } from 'momentum-trail'
import { DefineComponent, createApp, h } from 'vue'

createInertiaApp({
    progress: {
        color: '#4B5563',
    },
    resolve: (name: string) =>
        resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./pages/**/*.vue'),
        ).then((module) => {
            const page = module.default

            page.layout = page.layout || Layout

            return page
        }) as Promise<DefineComponent>,
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(trail, { routes, absolute: true })
            .mount(el)
    },
})
