<script lang="ts" setup>
withDefaults(defineProps<{ article?: App.Article; author?: App.Author; isLoading?: boolean }>(), {
    article: undefined,
    author: undefined,
    isLoading: false,
})
</script>

<template>
    <article class="dark:bg-neutral flex overflow-hidden rounded bg-white shadow">
        <div v-if="isLoading" class="flex w-full flex-col">
            <div class="h-[168.75px] w-full bg-gray-300"></div>
            <div class="flex flex-col gap-2 p-2">
                <div class="bg-base-100/30 h-6 animate-pulse rounded dark:bg-slate-700"></div>
                <div class="flex flex-row justify-between gap-x-4 text-sm">
                    <div
                        class="bg-base-100/30 h-4 w-1/2 animate-pulse rounded dark:bg-slate-700"
                    ></div>
                    <div
                        class="bg-base-100/30 h-4 w-1/2 animate-pulse rounded dark:bg-slate-700"
                    ></div>
                </div>
                <div
                    class="bg-base-100/30 h-2 w-full animate-pulse rounded dark:bg-slate-700"
                ></div>
                <div
                    class="bg-base-100/30 h-2 w-full animate-pulse rounded dark:bg-slate-700"
                ></div>
                <div
                    class="bg-base-100/30 h-2 w-full animate-pulse rounded dark:bg-slate-700"
                ></div>
                <div
                    class="bg-base-100/30 h-2 w-full animate-pulse rounded dark:bg-slate-700"
                ></div>
            </div>
        </div>
        <template v-else>
            <InertiaLink :href="route('news.show', article?.slug)" class="flex w-full flex-col">
                <div class="relative">
                    <img
                        :src="
                            article?.thumbnail
                                ? article?.thumbnail
                                : 'https://via.placeholder.com/800x400'
                        "
                        loading="lazy"
                        decoding="async"
                        alt="Placeholder"
                        class="h-[168.75px] w-full object-cover"
                    />
                    <div v-if="article?.review" class="hexagon absolute top-2 right-2 w-[50px]">
                        <div>{{ article?.review.overall }}</div>
                    </div>
                </div>
                <div class="flex flex-col gap-2 p-2">
                    <h2
                        class="overflow-hidden font-semibold text-nowrap text-ellipsis"
                        v-html="article?.title"
                    />
                    <div class="flex flex-row justify-between gap-x-4 text-sm">
                        <div class="border-l-2 border-red-600 pl-1">
                            {{ article?.author?.name ?? author?.name }}
                        </div>
                        <div class="border-l-2 border-red-600 pl-1">
                            {{ useDayJs(article?.published_at).format('DD/MM/YYYY') }}
                        </div>
                    </div>
                    <p class="text-sm" v-html="article?.excerpt" />
                </div>
            </InertiaLink>
        </template>
    </article>
</template>
