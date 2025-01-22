<script lang="ts" setup>
const props = defineProps<{ articles: App.PageResource<App.Article> }>()

const isLoading = ref(false)

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

function pageChange(page: number) {
    router.visit(route(current('news.index') ? 'news.index' : 'reviews', { page }), {
        only: ['previous'],
        onStart: () => (isLoading.value = true),
        onFinish: () => (isLoading.value = false),
    })
}
</script>

<template>
    <div class="mx-auto max-w-7xl p-4">
        <AppHead :title="pageTitle" />

        <ArticlesFeaturedSection v-if="featuredArticles.length > 0" :articles="featuredArticles" />

        <div
            v-if="isLoading"
            class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center"
        >
            <div class="absolute inset-0 flex items-center justify-center">
                <IconLoading class="text-primary-500 mr-4 size-8 animate-spin dark:text-white" />
                <span class="font-medium dark:text-white">Loading Articles...</span>
            </div>
        </div>
        <div v-else class="mb-4 mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">
            <ArticlesCard v-for="article in normalArticles" :key="article?.id" :article="article" />
        </div>

        <Pagination
            v-if="articles.meta.total > 0"
            :meta="articles?.meta"
            @page-change="pageChange"
        />
    </div>
</template>
