<script setup lang="ts">
defineProps<{
    featured: App.Article[]
    articles: App.Article[]
    liveStream: App.Channel | null
    reviews: App.Article[]
}>()
</script>

<template>
    <div>
        <AppHead />

        <div class="mx-auto my-4 max-w-2xl space-y-4 px-4 lg:max-w-7xl">
            <LiveStream :live-stream="liveStream" />

            <ArticlesFeaturedSection :articles="featured" />

            <div
                class="mb-4 flex items-center justify-between gap-4 border-b border-b-gray-200 pb-1"
            >
                <h2 class="text-2xl font-bold">Articles</h2>
                <InertiaLink :href="route('news.index')">View All</InertiaLink>
            </div>

            <div class="grid grid-cols-1 gap-4 lg:grid-cols-6">
                <ArticlesCard
                    v-for="(article, index) in articles"
                    :key="`article${index}`"
                    :article
                />
            </div>

            <div
                class="mb-4 flex items-center justify-between gap-4 border-b border-b-gray-200 pb-1"
            >
                <h2 class="text-2xl font-bold">Reviews</h2>
                <InertiaLink :href="route('reviews')">View All</InertiaLink>
            </div>

            <div class="grid grid-cols-1 gap-4 lg:grid-cols-6">
                <ArticlesCard
                    v-for="(review, index) in reviews"
                    :key="`review${index}`"
                    :article="review"
                />
            </div>
        </div>
    </div>
</template>
