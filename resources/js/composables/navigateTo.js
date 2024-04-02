import { router } from '@inertiajs/vue3'

export function navigateTo(url, options = {}) {
    router.visit(url, options)
}
