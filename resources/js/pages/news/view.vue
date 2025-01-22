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

function getPercentage(value: number) {
    return (100 * value) / 10
}
</script>

<template>
    <div class="w-full">
        <AppHead
            :title="article?.title"
            :author="article?.author?.name"
            :author-twitter="article?.author?.twitter ?? undefined"
            og-type="article"
            :description="article?.excerpt"
            :thumbnail="article?.socialThumbnail ?? undefined"
            :published-at="useDayJs(article?.published_at).toISOString()"
            :updated-at="useDayJs(article?.updated_at).toISOString()"
        />

        <div class="hero-banner">
            <img
                v-if="article?.background"
                :src="article?.background"
                loading="lazy"
                decoding="async"
                class="absolute h-full w-full object-cover"
                alt=""
            />
            <div class="hero-copy space-y-4">
                <h1>{{ article?.title }}</h1>
                <p>
                    By
                    <InertiaLink :href="`/author/${article?.author?.slug}`">
                        {{ article?.author?.name }}
                    </InertiaLink>
                    on {{ useDayJs(article?.published_at).format('DD/MM/YYYY HH:mm z') }}
                </p>
                <div class="scroll-indicator">
                    <span></span>
                </div>
            </div>
        </div>

        <div class="prose mx-auto max-w-7xl p-4 pt-8 dark:prose-invert" v-html="article?.content" />

        <div
            v-if="article?.review"
            class="mx-auto flex max-w-6xl flex-col items-center gap-6 rounded-md bg-base-100/20 p-4 shadow dark:bg-neutral sm:flex-row"
        >
            <div class="hexagon h-[180px] w-[200px] text-6xl">{{ article?.review?.overall }}</div>
            <div class="flex flex-1 flex-col gap-y-4">
                <p class="text-center text-xl font-semibold italic">
                    &ldquo;{{ article?.review?.oneliner }}&rdquo;
                </p>
                <div
                    v-if="article?.review?.quote"
                    class="prose w-full max-w-full dark:text-base-content"
                    v-html="article?.review?.quote"
                />

                <div>
                    <div class="mb-1 flex justify-between">
                        <span class="text-base font-medium dark:text-white">Story</span>
                        <span class="text-sm font-medium dark:text-white">
                            {{ getPercentage(article?.review?.story) }}%
                        </span>
                    </div>
                    <div class="h-2.5 w-full rounded-full bg-gray-200 dark:bg-gray-700">
                        <div
                            class="h-2.5 rounded-full bg-indigo-500"
                            :style="{ width: `${getPercentage(article?.review?.story)}%` }"
                        ></div>
                    </div>
                </div>

                <div>
                    <div class="mb-1 flex justify-between">
                        <span class="text-base font-medium dark:text-white">Gameplay</span>
                        <span class="text-sm font-medium dark:text-white">
                            {{ getPercentage(article?.review?.gameplay) }}%
                        </span>
                    </div>
                    <div class="h-2.5 w-full rounded-full bg-gray-200 dark:bg-gray-700">
                        <div
                            class="h-2.5 rounded-full bg-indigo-500"
                            :style="{ width: `${getPercentage(article?.review?.gameplay)}%` }"
                        ></div>
                    </div>
                </div>

                <div>
                    <div class="mb-1 flex justify-between">
                        <span class="text-base font-medium dark:text-white">Graphics</span>
                        <span class="text-sm font-medium dark:text-white">
                            {{ getPercentage(article?.review?.graphics) }}%
                        </span>
                    </div>
                    <div class="h-2.5 w-full rounded-full bg-gray-200 dark:bg-gray-700">
                        <div
                            class="h-2.5 rounded-full bg-indigo-500"
                            :style="{ width: `${getPercentage(article?.review?.graphics)}%` }"
                        ></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
