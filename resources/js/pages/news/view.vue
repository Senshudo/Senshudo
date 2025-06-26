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
    <div class="relative">
        <AppHead
            :title="article?.title"
            :author="article?.author"
            og-type="article"
            :slug="article?.slug"
            :description="article?.excerpt"
            :keywords="article?.keywords"
            :thumbnail="article?.socialThumbnail ?? undefined"
            :published-at="
                article?.published_at ? useDayJs(article?.published_at).toISOString() : undefined
            "
            :updated-at="
                article?.updated_at ? useDayJs(article?.updated_at).toISOString() : undefined
            "
        />

        <header class="hero-banner">
            <img
                v-if="article?.background"
                :src="useGetImage(article, 'background')"
                loading="lazy"
                decoding="async"
                class="absolute h-full w-full object-cover"
                alt=""
            />
            <div class="hero-copy space-y-4">
                <h1>{{ article?.title }}</h1>
                <p>
                    By
                    <InertiaLink :href="route('author', article?.author?.slug)">
                        {{ article?.author?.name }}
                    </InertiaLink>
                    on
                    {{
                        useDayJs(article?.published_at ?? article?.created_at).format(
                            'DD/MM/YYYY HH:mm z',
                        )
                    }}
                </p>
                <div class="scroll-indicator">
                    <span></span>
                </div>
            </div>
        </header>

        <div class="mx-auto my-4 max-w-2xl space-y-4 px-4 lg:max-w-7xl">
            <div
                class="relative inset-px flex flex-col rounded-lg bg-white p-6 pt-4 md:p-10 dark:bg-slate-700"
            >
                <div class="absolute inset-px rounded-lg bg-white dark:bg-slate-700" />
                <article
                    class="prose dark:prose-invert relative flex h-full max-w-fit flex-col"
                    v-html="article?.content"
                />
                <div
                    v-if="article?.sources && article?.sources?.length > 0"
                    class="relative mt-4 space-y-4 border-t pt-4"
                >
                    <p class="font-bold">Sources</p>
                    <div class="flex flex-row flex-wrap gap-4">
                        <a
                            v-for="(source, index) in article?.sources"
                            :key="index"
                            class="btn-default block"
                            :href="source.url"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                {{ source.name }}
                            </span>
                        </a>
                    </div>
                </div>
                <div
                    class="pointer-events-none absolute inset-px rounded-lg shadow-sm ring-1 ring-black/5"
                />
            </div>

            <div
                v-if="article?.review"
                class="relative inset-px flex flex-col rounded-lg bg-white p-6 pt-4 md:p-10 dark:bg-slate-700"
            >
                <div class="absolute inset-px rounded-lg bg-white dark:bg-slate-700" />
                <div
                    class="relative flex h-full flex-col gap-6 overflow-hidden rounded-[calc(var(--radius-lg)+1px)] sm:flex-row"
                >
                    <div class="hexagon mx-auto h-[180px] w-[200px] text-6xl">
                        {{ article?.review?.overall }}
                    </div>
                    <div class="flex flex-1 flex-col gap-y-4">
                        <p class="text-center text-xl font-semibold italic">
                            &ldquo;{{ article?.review?.oneliner }}&rdquo;
                        </p>
                        <div
                            v-if="article?.review?.quote"
                            class="prose dark:text-base-content w-full max-w-full"
                            v-html="article?.review?.quote"
                        />

                        <div>
                            <div class="mb-1 flex justify-between">
                                <span class="text-base font-medium dark:text-white">Story</span>
                                <span class="text-sm font-medium dark:text-white">
                                    {{ getPercentage(article?.review?.story) }}%
                                </span>
                            </div>
                            <div class="h-2.5 w-full rounded-full bg-gray-200 dark:bg-gray-800">
                                <div
                                    class="h-2.5 rounded-full bg-indigo-500"
                                    :style="{
                                        width: `${getPercentage(article?.review?.story)}%`,
                                    }"
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
                            <div class="h-2.5 w-full rounded-full bg-gray-200 dark:bg-gray-800">
                                <div
                                    class="h-2.5 rounded-full bg-indigo-500"
                                    :style="{
                                        width: `${getPercentage(article?.review?.gameplay)}%`,
                                    }"
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
                            <div class="h-2.5 w-full rounded-full bg-gray-200 dark:bg-gray-800">
                                <div
                                    class="h-2.5 rounded-full bg-indigo-500"
                                    :style="{
                                        width: `${getPercentage(article?.review?.graphics)}%`,
                                    }"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="pointer-events-none absolute inset-px rounded-lg shadow-sm ring-1 ring-black/5"
                />
            </div>
        </div>
    </div>
</template>
