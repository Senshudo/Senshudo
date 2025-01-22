<script lang="ts" setup>
withDefaults(defineProps<{ article?: App.Article; isLoading?: boolean }>(), {
    article: undefined,
    isLoading: false,
})
</script>

<template>
    <article class="flex overflow-hidden rounded bg-white shadow dark:bg-neutral">
        <div v-if="isLoading" class="flex w-full flex-col">
            <div class="h-[168.75px] w-full bg-gray-300"></div>
            <div class="flex flex-col gap-2 p-2">
                <div class="h-6 animate-pulse rounded bg-base-100/30 dark:bg-slate-700"></div>
                <div class="flex flex-row justify-between gap-x-4 text-sm">
                    <div
                        class="h-4 w-1/2 animate-pulse rounded bg-base-100/30 dark:bg-slate-700"
                    ></div>
                    <div
                        class="h-4 w-1/2 animate-pulse rounded bg-base-100/30 dark:bg-slate-700"
                    ></div>
                </div>
                <div
                    class="h-2 w-full animate-pulse rounded bg-base-100/30 dark:bg-slate-700"
                ></div>
                <div
                    class="h-2 w-full animate-pulse rounded bg-base-100/30 dark:bg-slate-700"
                ></div>
                <div
                    class="h-2 w-full animate-pulse rounded bg-base-100/30 dark:bg-slate-700"
                ></div>
                <div
                    class="h-2 w-full animate-pulse rounded bg-base-100/30 dark:bg-slate-700"
                ></div>
            </div>
        </div>
        <template v-else>
            <InertiaLink :href="`/news/${article?.slug}`" class="flex w-full flex-col">
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
                    <div v-if="article?.review" class="hexagon absolute right-2 top-2 w-[50px]">
                        <div>{{ article?.review.overall }}</div>
                    </div>
                </div>
                <div class="flex flex-col gap-2 p-2">
                    <h2
                        class="overflow-hidden text-ellipsis text-nowrap font-semibold"
                        v-html="article?.title"
                    />
                    <div class="flex flex-row justify-between gap-x-4 text-sm">
                        <div class="border-l-2 border-red-600 pl-1">
                            {{ article?.author?.name }}
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
