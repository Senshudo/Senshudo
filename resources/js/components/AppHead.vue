<script lang="ts" setup>
import socialBanner from '@/../images/social-banner.png'

const props = withDefaults(
    defineProps<{
        title?: string
        index?: boolean
        author?: string
        authorTwitter?: string | null
        ogType?: string
        description?: string
        thumbnail?: string
        imageWidth?: number
        imageHeight?: number
        imageAlt?: string
        category?: string | null
        publishedAt?: string
        updatedAt?: string
    }>(),
    {
        title: undefined,
        index: true,
        author: 'Senshudo',
        authorTwitter: undefined,
        ogType: 'website',
        description:
            'Senshudo, Video Game News, Gaming News, Game Rankings, Game Reviews, Video Game Reviews',
        thumbnail: socialBanner,
        imageWidth: 1200,
        imageHeight: 630,
        imageAlt: undefined,
        category: undefined,
        publishedAt: undefined,
        updatedAt: undefined,
    },
)

const url = computed(() => usePage().props.location)

const pageTitle = computed(() =>
    props.title
        ? `${props.title} - Senshudo`
        : 'Senshudo - Video Game News, Game Reviews, Game Rankings',
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
        <meta property="og:image:width" :content="imageWidth?.toString()" />
        <meta property="og:image:height" :content="imageHeight?.toString()" />
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
