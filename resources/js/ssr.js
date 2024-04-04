import Layout from '@/layouts/default.vue'
import { createInertiaApp } from '@inertiajs/vue3'
import createServer from '@inertiajs/vue3/server'
import { renderToString } from '@vue/server-renderer'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createSSRApp, h } from 'vue'
import { ZiggyVue } from 'ziggy-js'

createServer((page) =>
    createInertiaApp({
        page,
        render: renderToString,
        resolve: (name) =>
            resolvePageComponent(`./pages/${name}.vue`, import.meta.glob('./pages/**/*.vue')).then(
                (module) => {
                    const page = module.default

                    page.layout = page.layout || Layout

                    return page
                },
            ),
        setup({ App, props, plugin }) {
            const app = createSSRApp({
                render: () => h(App, props),
            })
                .use(plugin)
                .use(ZiggyVue, {
                    ...page.props.ziggy,
                    location: new URL(page.props.location),
                })

            return app
        },
    }),
)
