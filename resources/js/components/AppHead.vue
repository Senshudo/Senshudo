<script setup>
import socialBanner from '@/../images/social-banner.png'
import { computed } from 'vue'

const props = defineProps({
    title: {
        type: String,
        default: undefined,
    },
    index: {
        type: Boolean,
        default: true,
    },
    author: {
        type: String,
        default: 'Senshudo',
    },
    authorTwitter: {
        type: String,
        required: false,
        default: null,
    },
    ogType: {
        type: String,
        default: 'website',
    },
    description: {
        type: String,
        default: 'Senshudo, The Way Of The Player. Video game news and reviews.',
    },
    thumbnail: {
        type: String,
        default: socialBanner,
    },
    imageWidth: {
        type: String,
        default: '1200',
    },
    imageHeight: {
        type: String,
        default: '630',
    },
    imageAlt: {
        type: String,
        default: undefined,
    },
    category: {
        type: String,
        required: false,
        default: null,
    },
    publishedAt: {
        type: String,
        required: false,
        default: null,
    },
    updatedAt: {
        type: String,
        required: false,
        default: null,
    },
})

const url = computed(() => usePage().props.location)

const pageTitle = computed(() =>
    props.title ? `${props.title} - Senshudo` : 'Senshudo - The Way Of The Player',
)
</script>

<template>
    <InertiaHead :title="pageTitle">
        <link rel="canonical" :content="url" />
        <meta name="description" :content="description" />
        <meta name="author" :content="author" />
        <meta name="robots" :content="index ? 'index, follow' : 'noindex, nofollow'" />
        <meta property="fb:app_id" content="635861056474584" />
        <meta property="og:url" :content="url" />
        <meta property="og:type" :content="ogType" />
        <meta property="og:title" :content="pageTitle" />
        <meta property="og:description" :content="description" />
        <meta property="og:image" :content="thumbnail" />
        <meta property="og:image:width" :content="imageWidth" />
        <meta property="og:image:height" :content="imageHeight" />
        <meta property="og:image:alt" :content="imageAlt ?? pageTitle" />
        <meta property="og:locale" content="en_GB" />
        <meta property="og:site_name" content="Senshudo" />
        <meta name="twitter:title" :content="pageTitle" />
        <meta name="twitter:description" :content="description" />
        <meta name="twitter:image" :content="thumbnail" />
        <meta name="twitter:card" content="summary_large_image" />
        <template v-if="ogType === 'article'">
            <meta property="article:published_time" :content="publishedAt" />
            <meta property="article:modified_time" :content="updatedAt" />
            <meta property="og:updated_time" :content="updatedAt" />
            <meta v-if="category" property="article:section" :content="category" />
            <meta v-if="authorTwitter" name="twitter:creator" :content="`@${authorTwitter}`" />
        </template>
    </InertiaHead>
</template>
