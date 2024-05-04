<script setup>
const props = defineProps({
    status: {
        type: Number,
        required: false,
        default: 200,
    },
})

onMounted(() => {
    const timezone = useDayJs.tz.guess() ?? 'Europe/London'
    useDayJs.tz.setDefault(timezone)
})
</script>

<template>
    <NavBar v-if="status !== 503" />
    <main class="">
        <slot />
    </main>
    <AppFooter />
</template>
