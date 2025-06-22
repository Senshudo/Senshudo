<script lang="ts" setup>
withDefaults(defineProps<{ status?: number }>(), { status: 200 })

onMounted(() => {
    const timezone = useDayJs.tz.guess() ?? 'Europe/London'
    useDayJs.tz.setDefault(timezone)
})
</script>

<template>
    <NavBar v-if="status !== 503" />

    <main class="flex-1">
        <slot />
    </main>

    <AppFooter />
</template>
