<script setup lang="ts">
const props = defineProps<{ status: number }>()

const pageTitle = computed(() => {
    return {
        503: '503: Service Unavailable',
        500: '500: Server Error',
        404: '404: Page Not Found',
        403: '403: Forbidden',
    }[props.status]
})

const title = computed(() => {
    return {
        503: 'Service Unavailable',
        500: 'Server Error',
        404: 'Page Not Found',
        403: 'Forbidden',
    }[props.status]
})

const description = computed(() => {
    return {
        503: 'Sorry, we are doing some maintenance. Please check back soon.',
        500: 'Whoops, something went wrong on our servers.',
        404: 'Sorry, the page you are looking for could not be found.',
        403: 'Sorry, you are forbidden from accessing this page.',
    }[props.status]
})
</script>

<template>
    <AppHead :title="pageTitle" />

    <div class="mx-auto my-4 max-w-2xl space-y-4 px-4 lg:max-w-7xl">
        <div class="text-center">
            <p class="text-base font-semibold text-indigo-600 dark:text-white">{{ status }}</p>
            <h1
                class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl dark:text-white"
            >
                {{ title }}
            </h1>
            <p class="dark:text-base-content mt-6 text-base leading-7 text-gray-600">
                {{ description }}
            </p>
            <div v-if="status !== 503" class="mt-10 flex items-center justify-center gap-x-6">
                <InertiaLink href="/" class="btn-primary">Go back home</InertiaLink>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
