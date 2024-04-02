<script setup>
onMounted(() => {
    const timezone = useDayJs.tz.guess() ?? 'Europe/London'
    useDayJs.tz.setDefault(timezone)
})
</script>

<template>
    <NavBar />
    <main class="">
        <slot />
    </main>
    <AppFooter />
</template>
