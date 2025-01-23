<script lang="ts" setup>
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
    <div class="mx-auto max-w-7xl p-4">
        <AppHead :title="pageTitle" />

        <!-- TODO: AUTHOR Card -->

        <h1 class="my-4 text-3xl font-semibold dark:text-white">Articles by {{ author.name }}</h1>

        <div
            v-if="isLoading"
            class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center"
        >
            <div class="absolute inset-0 flex items-center justify-center">
                <IconsIconLoading
                    class="text-primary-500 mr-4 size-8 animate-spin dark:text-white"
                />
                <span class="font-medium dark:text-white">Loading Articles...</span>
            </div>
        </div>

        <div v-else class="mb-4 mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">
            <ArticlesCard
                v-for="article in articles.data"
                :key="article.id"
                :article="article"
                :author="author"
            />
        </div>

        <Pagination
            v-if="articles.meta.total > 0"
            :meta="articles.meta"
            @page-change="pageChange"
        />
    </div>
</template>
