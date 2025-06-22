<script lang="ts" setup>
import socialBanner from '@/../images/social-banner.png'

const props = withDefaults(
    defineProps<{
        title?: string
        index?: boolean
        author?: string
        authorTwitter?: string | null
        ogType?: string
        slug?: string
        description?: string
        thumbnail?: App.Media | string
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
        slug: undefined,
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

const appUrl = computed(() => usePage().props.app_url)
const ampUrl = computed(() => usePage().props.amp_url)

const url = computed(() => usePage().props.location)

const thumbnailUrl = computed(() => {
    if (typeof props.thumbnail === 'string') {
        return props.thumbnail
    } else if (props.thumbnail && props.thumbnail.url) {
        return props.thumbnail.url
    }
    return socialBanner
})

const pageTitle = computed(() =>
    props.title
        ? `${props.title} - Senshudo`
        : 'Senshudo - Video Game News, Game Reviews, Game Rankings',
)

watch(
    () => props.ogType,
    () => {
        if (typeof window !== 'undefined') {
            if (props.ogType !== 'article' && document.querySelector('#articleData')) {
                document.querySelector('#articleData')?.remove()
            }

            if (props.ogType === 'article') {
                const script = document.createElement('script')
                script.id = 'articleData'
                script.type = 'application/ld+json'
                script.textContent = JSON.stringify({
                    '@context': 'http://schema.org',
                    '@type': 'Article',
                    mainEntityOfPage: url.value,
                    headline: props.title,
                    datePublished: props.publishedAt,
                    dateModified: props.updatedAt,
                    description: props.description,
                    author: {
                        '@type': 'Person',
                        name: props.author,
                    },
                    publisher: {
                        '@type': 'Organization',
                        name: 'Senshudo',
                        logo: {
                            '@type': 'ImageObject',
                            url: `${appUrl.value}/images/logo-black.svg`,
                            width: 705,
                            height: 237,
                        },
                    },
                    image: {
                        '@type': 'ImageObject',
                        url: thumbnailUrl.value,
                        height: props.imageHeight,
                        width: props.imageWidth,
                        alt: props.imageAlt ?? props.title,
                    },
                })

                document.head.appendChild(script)
            }
        }
    },
    { immediate: true, deep: true },
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
        <meta property="og:image" :content="thumbnailUrl" />
        <meta property="og:image:width" :content="imageWidth?.toString()" />
        <meta property="og:image:height" :content="imageHeight?.toString()" />
        <meta property="og:image:alt" :content="imageAlt ?? pageTitle" />
        <meta property="og:locale" content="en_GB" />
        <meta property="og:site_name" content="Senshudo" />
        <meta name="twitter:title" :content="pageTitle" />
        <meta name="twitter:description" :content="description" />
        <meta name="twitter:image" :content="thumbnailUrl" />
        <meta name="twitter:card" content="summary_large_image" />
        <template v-if="ogType === 'article'">
            <meta v-if="publishedAt" property="article:published_time" :content="publishedAt" />
            <meta v-if="updatedAt" property="article:modified_time" :content="updatedAt" />
            <meta v-if="updatedAt" property="og:updated_time" :content="updatedAt" />
            <meta v-if="category" property="article:section" :content="category" />
            <meta v-if="authorTwitter" name="twitter:creator" :content="`@${authorTwitter}`" />
            <link rel="amphtml" :href="`${ampUrl}/${slug}`" />
        </template>
    </InertiaHead>
</template>
