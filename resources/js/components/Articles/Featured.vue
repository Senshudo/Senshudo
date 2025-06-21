<script lang="ts" setup>
withDefaults(defineProps<{ article?: App.Article; isLoading?: boolean }>(), {
    article: undefined,
    isLoading: false,
})
</script>

<template>
    <article class="relative my-4 w-full overflow-hidden">
        <div v-if="isLoading" class="flex flex-col">
            <div
                class="relative flex h-full w-auto transform-none flex-col items-end justify-center"
            >
                <div class="h-[500px] w-[900px] rounded bg-gray-300"></div>
            </div>
            <div
                class="dark:bg-base-100/30 absolute top-1/2 z-[2] h-full w-full -translate-y-1/2 bg-white blur-lg sm:w-1/2"
            ></div>
            <div
                class="absolute top-[80%] z-[3] flex w-full -translate-y-1/2 animate-pulse flex-col gap-4 p-2 sm:top-1/2 sm:w-1/2 dark:text-white"
            >
                <div class="bg-base-100/30 h-6 rounded dark:bg-slate-700"></div>
                <div class="bg-base-100/30 h-4 w-1/2 rounded dark:bg-slate-700"></div>
                <div class="bg-base-100/30 h-4 rounded dark:bg-slate-700"></div>
                <div class="bg-base-100/30 h-4 rounded dark:bg-slate-700"></div>
                <div class="bg-base-100/30 h-4 rounded dark:bg-slate-700"></div>
            </div>
        </div>
        <template v-else>
            <InertiaLink :href="route('news.show', article?.slug)" class="flex flex-col">
                <div
                    class="relative flex h-full w-auto transform-none flex-col items-end justify-center"
                >
                    <div class="relative h-[500px] w-full rounded bg-gray-300 sm:w-[900px]">
                        <img
                            v-if="article?.thumbnail"
                            :src="article?.thumbnail"
                            loading="lazy"
                            decoding="async"
                            alt="Placeholder"
                            class="h-full w-full rounded object-cover"
                        />
                        <div v-if="article?.review" class="hexagon absolute top-2 right-2 w-[50px]">
                            <div>{{ article?.review.overall }}</div>
                        </div>
                    </div>
                </div>
                <div
                    class="dark:bg-base-100/30 absolute top-1/2 z-[2] h-full w-full -translate-y-1/2 rounded bg-white/70 blur-lg sm:w-1/2"
                ></div>
                <div
                    class="absolute top-[70%] z-[3] flex w-full -translate-y-1/2 flex-col gap-4 rounded p-2 sm:top-1/2 sm:w-1/2 dark:text-white"
                >
                    <h2
                        class="text-nowrapk mb-2 overflow-hidden text-5xl font-black text-ellipsis"
                        v-html="article?.title"
                    />
                    <div class="flex flex-row gap-4">
                        <div class="border-l-4 border-red-600 pl-2">
                            {{ article?.author?.name }}
                        </div>
                        <div class="border-l-4 border-red-600 pl-2">
                            {{ useDayJs(article?.published_at).format('DD/MM/YYYY HH:mm z') }}
                        </div>
                    </div>
                    <p v-html="article?.excerpt" />
                </div>
            </InertiaLink>
        </template>
    </article>
</template>
