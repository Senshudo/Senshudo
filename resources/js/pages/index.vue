<script setup>
defineProps({
    featured: {
        type: Object,
        required: true,
    },
    articles: {
        type: Object,
        required: true,
    },
})
</script>

<template>
    <div class="mx-auto max-w-7xl p-4">
        <AppHead />

        <!--<live-stream />-->

        <ArticlesFeatured :article="featured.data.at(0)" />

        <ArticlesFeaturedSection :articles="featured.data.slice(1)" />

        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">
            <ArticlesCard
                v-for="index in 12"
                :key="`news${index}`"
                :article="articles.data.at(index)"
            />
        </div>
    </div>
</template>
