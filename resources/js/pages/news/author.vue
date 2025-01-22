<script lang="ts" setup>
const props = defineProps<{ author: App.Author; articles: App.PageResource<App.Article> }>()

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

        <div
            v-if="articles.data.length > 0"
            class="mb-4 mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4"
        >
            <ArticlesCard v-for="article in articles.data" :key="article.id" :article="article" />
        </div>

        <Pagination v-if="articles.meta.total > 0" :meta="articles.meta" />
    </div>
</template>
