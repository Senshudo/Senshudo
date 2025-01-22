<script lang="ts" setup>
const props = defineProps<{ articles: App.PageResource<App.Article> }>()

const pageTitle = computed(() => {
    const pageName = current('news.index') ? 'News' : 'Reviews'

    if (props.articles?.meta?.current_page > 1) {
        return `${pageName} - Page ${props.articles?.meta?.current_page}`
    }

    return pageName
})

const featuredArticles = computed(() =>
    props.articles?.data?.length > 0
        ? props.articles?.data?.filter((article, index) => index >= 0 && index < 5)
        : [],
)

const normalArticles = computed(() => props.articles?.data?.slice(5))
</script>

<template>
    <div class="mx-auto max-w-7xl p-4">
        <AppHead :title="pageTitle" />

        <ArticlesFeaturedSection v-if="featuredArticles.length > 0" :articles="featuredArticles" />

        <div class="mb-4 mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">
            <ArticlesCard v-for="article in normalArticles" :key="article?.id" :article="article" />
        </div>

        <Pagination v-if="articles.meta.total > 0" :meta="articles?.meta" />
    </div>
</template>
