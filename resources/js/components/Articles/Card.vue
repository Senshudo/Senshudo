<script lang="ts" setup>
import { useGetImage } from '@/composables/useGetImage'
import { Link as InertiaLink } from '@inertiajs/vue3'

withDefaults(defineProps<{ article?: App.Article; author?: App.Author; isLoading?: boolean }>(), {
    article: undefined,
    author: undefined,
    isLoading: false,
})
</script>

<template>
    <component
        :is="isLoading ? 'div' : InertiaLink"
        class="relative lg:col-span-2"
        :href="isLoading ? undefined : route('news.show', article?.slug ?? '')"
    >
        <div class="absolute inset-px rounded-lg bg-white dark:bg-slate-700" />
        <div
            v-if="isLoading"
            class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)]"
        >
            <div
                class="bg-base-100/30 h-[240px] w-full animate-pulse rounded rounded-b-none dark:bg-slate-300/25"
            ></div>
            <div class="p-6 pt-4 md:p-10">
                <div
                    class="flex justify-between text-sm/4 font-semibold text-indigo-600 dark:text-gray-300"
                >
                    <div
                        class="bg-base-100/30 h-4 w-1/2 animate-pulse rounded dark:bg-slate-300"
                    ></div>
                    <div
                        class="bg-base-100/30 h-4 w-20 animate-pulse rounded dark:bg-slate-300"
                    ></div>
                </div>
                <div
                    class="bg-base-100/30 mt-2 h-6 w-full animate-pulse rounded dark:bg-slate-300"
                ></div>
                <div class="mt-4 space-y-2">
                    <div
                        class="bg-base-100/30 mt-2 h-4 w-full animate-pulse rounded dark:bg-slate-300/25"
                    ></div>
                    <div
                        class="bg-base-100/30 mt-2 h-4 w-full animate-pulse rounded dark:bg-slate-300/25"
                    ></div>
                    <div
                        class="bg-base-100/30 mt-2 h-4 w-full animate-pulse rounded dark:bg-slate-300/25"
                    ></div>
                    <div
                        class="bg-base-100/30 mt-2 h-4 w-full animate-pulse rounded dark:bg-slate-300/25"
                    ></div>
                    <div
                        class="bg-base-100/30 mt-2 h-4 w-full animate-pulse rounded dark:bg-slate-300/25"
                    ></div>
                </div>
            </div>
        </div>
        <div
            v-else
            class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)]"
        >
            <img
                class="h-60 object-cover object-left"
                :src="useGetImage(article, 'background')"
                :alt="article?.title"
                width="405"
                height="240"
                loading="lazy"
                decoding="async"
            />
            <div v-if="article?.review" class="hexagon absolute top-2 right-2 w-[50px]">
                <div>{{ article?.review?.overall }}</div>
            </div>
            <div class="p-6 pt-4 md:p-10">
                <h3
                    class="flex justify-between text-sm/4 font-semibold text-indigo-600 dark:text-gray-300"
                >
                    <span>{{ article?.author?.name }}</span>
                    <span>
                        {{ useDayJs(article?.published_at).format('DD/MM/YYYY') }}
                    </span>
                </h3>
                <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 dark:text-white">
                    {{ article?.title }}
                </p>
                <p
                    class="mt-2 max-w-lg text-sm/6 text-gray-600 dark:text-gray-300"
                    v-html="article?.excerpt"
                />
            </div>
        </div>
        <div
            class="pointer-events-none absolute inset-px rounded-lg shadow-sm ring-1 ring-black/5"
        />
    </component>
</template>
