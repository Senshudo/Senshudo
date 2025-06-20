<script lang="ts" setup>
defineProps<{ article: App.Article }>()

onMounted(() => {
    if (typeof window !== 'undefined') {
        if (document.querySelector('#twitterSDK')) {
            document.querySelector('#twitterSDK')?.remove()
        } else {
            const script = document.createElement('script')
            script.id = 'twitterSDK'
            script.src = 'https://platform.twitter.com/widgets.js'
            script.charset = 'utf-8'
            script.async = true
            document.body.appendChild(script)
        }
    }
})
</script>

<template>
    <div>
        <AppHead
            :title="article?.title"
            :author="article?.author?.name"
            :author-twitter="article?.author?.twitter ?? undefined"
            og-type="article"
            :slug="article?.slug"
            :description="article?.excerpt"
            :thumbnail="article?.socialThumbnail ?? undefined"
            :published-at="useDayJs(article?.published_at).toISOString()"
            :updated-at="useDayJs(article?.updated_at).toISOString()"
        />
    </div>
</template>
