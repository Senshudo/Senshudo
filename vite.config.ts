import tailwindcss from '@tailwindcss/vite'
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'
import inertiaLayout from 'momentum-layout'
import autoimport from 'unplugin-auto-import/vite'
import Components from 'unplugin-vue-components/vite'
import { defineConfig } from 'vite'
import manifestSRI from 'vite-plugin-manifest-sri'
import { watch } from 'vite-plugin-watch'

export default defineConfig({
    resolve: {
        alias: {
            '@': '/resources/js',
            '~': '/node_modules',
        },
    },
    plugins: [
        autoimport({
            eslintrc: {
                enabled: true,
            },
            vueTemplate: true,
            dirs: ['resources/js/composables', 'resources/js/constants'],
            dts: 'resources/js/types/auto-imports.d.ts',
            imports: [
                'vue',
                '@vueuse/core',
                { 'momentum-trail': ['route', 'current'] },
                { '@inertiajs/vue3': ['router', 'useForm', 'usePage', 'useRemember'] },
            ],
        }),
        Components({
            dirs: ['resources/js/components'],
            dts: 'resources/js/types/auto-components.d.ts',
            deep: true,
            directoryAsNamespace: true,
            resolvers: [
                (name) => {
                    const components = {
                        InertiaLink: { component: 'Link', lib: '@inertiajs/vue3' },
                        InertiaHead: { component: 'Head', lib: '@inertiajs/vue3' },
                    }

                    if (name in components) {
                        return {
                            name: components[name]?.component,
                            from: components[name]?.lib,
                        }
                    }
                },
            ],
        }),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.ts', 'resources/js/pages/error.vue'],
            ssr: 'resources/js/ssr.ts',
            refresh: ['resources/css/**', 'resources/js/**', 'routes/**'],
        }),
        inertiaLayout(),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        watch({
            pattern: 'routes/**/*.php',
            command: 'php artisan trail:generate',
        }),
        manifestSRI(),
        tailwindcss(),
    ],
    ssr: {
        noExternal: ['@inertiajs/vue3/server', 'lodash', 'laravel-echo', 'pusher-js'],
    },
})
