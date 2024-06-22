<script setup>
const props = defineProps({
    author: {
        type: Object,
        required: true,
    },
    articles: {
        type: Object,
        required: true,
    },
})

const pageTitle = computed(() => {
    const pageName = `Articles by ${props.author.name}`

    if (props.articles?.meta?.current_page > 1) {
        return `${pageName} - Page ${props.articles.meta.current_page}`
    }

    return pageName
})
</script>

<template>
    <div class="mx-auto max-w-7xl p-4">
        <AppHead :title="pageTitle" />

        <!-- TODO: AUTHOR Card -->

        <div class="mb-4 mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">
            <articles-card v-for="article in articles.data" :key="article?.id" :article="article" />
        </div>

        <pagination :meta="articles?.meta" />
    </div>
</template>
