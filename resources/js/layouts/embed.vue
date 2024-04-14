<script setup>
onMounted(() => {
    const timezone = useDayJs.tz.guess() ?? 'Europe/London'
    useDayJs.tz.setDefault(timezone)
})
</script>

<template>
    <main class="h-full w-full">
        <slot />
    </main>
</template>

<style>
#app {
    @apply w-full h-full;
}
</style>
