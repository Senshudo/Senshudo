import { router } from '@inertiajs/vue3'

export function navigateTo(url: string, options = {}) {
    router.visit(url, options)
}
