<script setup lang="ts">
const props = defineProps<{ author: App.Author; articles: App.PageResource<App.Article> }>()

const isLoading = ref(false)

const pageTitle = computed(() => {
    const pageName = `Articles by ${props.author.name}`

    if (props.articles?.meta?.current_page > 1) {
        return `${pageName} - Page ${props.articles.meta.current_page}`
    }

    return pageName
})

function pageChange(page: number) {
    router.visit(route('author', { author: props.author.slug, page }), {
        only: ['articles'],
        onStart: () => (isLoading.value = true),
        onFinish: () => (isLoading.value = false),
    })
}
</script>

<template>
    <AppHead :title="pageTitle" />

    <div class="mx-auto my-4 max-w-2xl space-y-4 px-4 lg:max-w-7xl">
        <div class="flex flex-col space-y-4">
            <img
                :src="author?.avatar ?? undefined"
                :alt="author?.name ?? undefined"
                class="mx-auto h-24 w-24 rounded-full"
            />
            <div class="mx-auto">
                <h1 class="text-bold text-5xl">{{ author.name }}</h1>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 lg:grid-cols-6">
            <template v-if="isLoading">
                <ArticlesCard
                    v-for="index in 6"
                    :key="`featured-loading-${index}`"
                    :is-loading="true"
                />
            </template>
            <ArticlesCard
                v-for="(article, index) in articles.data"
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
