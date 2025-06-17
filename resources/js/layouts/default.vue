<script lang="ts" setup>
withDefaults(defineProps<{ status?: number }>(), { status: 200 })

onMounted(() => {
    const timezone = useDayJs.tz.guess() ?? 'Europe/London'
    useDayJs.tz.setDefault(timezone)
})
</script>

<template>
    <main class="">
        <slot />
    </main>
</template>
