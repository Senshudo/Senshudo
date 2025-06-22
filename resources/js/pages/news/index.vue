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
        only: ['articles'],
        onStart: () => (isLoading.value = true),
        onFinish: () => (isLoading.value = false),
    })
}
</script>

<template>
    <AppHead :title="pageTitle" />

    <div class="mx-auto my-4 max-w-2xl space-y-4 px-4 lg:max-w-7xl">
        <ArticlesFeaturedSection :articles="featuredArticles" />

        <div class="grid grid-cols-1 gap-4 lg:grid-cols-6">
            <template v-if="isLoading">
                <ArticlesCard
                    v-for="index in 6"
                    :key="`featured-loading-${index}`"
                    :loading="true"
                />
            </template>
            <ArticlesCard
                v-for="(article, index) in normalArticles"
                v-else
                :key="`article${index}`"
                :article
            />
        </div>

        <Pagination
            v-if="articles?.meta?.total > 0 && !isLoading"
            :meta="articles?.meta"
            @page-change="pageChange"
        />
    </div>
</template>
