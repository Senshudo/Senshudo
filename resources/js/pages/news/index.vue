<script setup>
import { route } from 'ziggy-js'

const props = defineProps({
    articles: {
        type: Object,
        required: true,
    },
})

const pageTitle = computed(() => {
    const pageName = route().current('news.index') ? 'News' : 'Reviews'

    if (props.articles?.meta?.current_page > 1) {
        return `${pageName} - Page ${props.articles.meta.current_page}`
    }

    return pageName
})

function goToPage(page) {
    navigateTo(route().current('news.index') ? `/news?page=${page}` : `/reviews?page=${page}`)
}
</script>

<template>
    <div class="mx-auto max-w-7xl p-4">
        <AppHead :title="pageTitle" />

        <articles-featured-section
            :articles="
                articles.data.length > 0
                    ? articles.data.filter((article, index) => index >= 0 && index < 5)
                    : []
            "
        />

        <div class="mb-4 mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">
            <articles-card
                v-for="article in articles.data.slice(5)"
                :key="article.id"
                :article="article"
            />
        </div>

        <pagination :meta="articles.meta" @page-change="goToPage" />
    </div>
</template>
