<script lang="ts" setup>
defineProps<{
    featured: App.Article[]
    articles: App.PageResource<App.Article>
    liveStream: App.Channel | null
}>()
</script>

<template>
    <div class="mx-auto max-w-7xl p-4">
        <AppHead />

        <LiveStream :live-stream="liveStream" />

        <ArticlesFeatured v-if="featured.length > 0" :article="featured.at(0)" />

        <ArticlesFeaturedSection v-if="featured.length > 0" :articles="featured.slice(1)" />

        <div
            v-if="articles.data.length > 0"
            class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4"
        >
            <ArticlesCard
                v-for="index in 12"
                :key="`news${index}`"
                :article="articles.data.at(index)"
            />
        </div>
    </div>
</template>
