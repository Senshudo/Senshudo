<script lang="ts" setup>
withDefaults(defineProps<{ articles?: App.Article[]; isLoading?: boolean }>(), {
    articles: () => [],
    isLoading: false,
})
</script>

<template>
    <div class="grid grid-cols-1 gap-y-4 sm:gap-y-1 lg:grid-cols-2 lg:gap-x-1 lg:gap-y-0">
        <article class="relative hidden overflow-hidden rounded sm:block">
            <div v-if="isLoading">
                <div class="h-auto min-h-[350px] w-full rounded bg-gray-300 lg:max-w-[638px]"></div>
                <div
                    class="bg-gradient-cover absolute bottom-0 w-full space-y-2 rounded-b px-4 pt-7 pb-4"
                >
                    <div class="bg-base-100/30 h-6 animate-pulse rounded dark:bg-slate-700"></div>
                    <div
                        class="bg-base-100/30 h-4 w-1/2 animate-pulse rounded dark:bg-slate-700"
                    ></div>
                    <div
                        class="bg-base-100/30 h-4 w-1/2 animate-pulse rounded dark:bg-slate-700"
                    ></div>
                </div>
            </div>
            <template v-else>
                <InertiaLink
                    :href="route('news.show', articles?.at(0)?.slug)"
                    class="relative block"
                >
                    <img
                        :src="
                            articles?.at(0)?.thumbnail
                                ? (articles?.at(0)?.thumbnail ??
                                  'https://via.placeholder.com/800x400')
                                : 'https://via.placeholder.com/800x400'
                        "
                        loading="lazy"
                        decoding="async"
                        alt="Placeholder"
                        class="mx-auto h-[350px] w-full max-w-full rounded"
                    />
                    <div
                        v-if="articles?.at(0)?.review"
                        class="hexagon absolute top-2 right-2 w-[50px]"
                    >
                        <div>{{ articles?.at(0)?.review?.overall }}</div>
                    </div>
                    <div
                        class="bg-gradient-cover absolute bottom-0 w-full space-y-2 rounded rounded-b px-4 pt-7 pb-4"
                    >
                        <h2
                            class="mb-3 text-lg font-bold text-white capitalize lg:text-3xl"
                            v-html="articles?.at(0)?.title"
                        />
                        <div class="flex flex-row gap-x-4 pt-2 text-gray-100">
                            <div class="border-l-2 border-red-600 pl-1">
                                {{ articles?.at(0)?.author?.name }}
                            </div>
                            <div class="border-l-2 border-red-600 pl-1">
                                {{
                                    useDayJs(articles?.at(0)?.published_at).format(
                                        'DD/MM/YYYY HH:mm z',
                                    )
                                }}
                            </div>
                        </div>
                    </div>
                </InertiaLink>
            </template>
        </article>

        <articles-card class="block sm:hidden" :article="articles?.at(0)" />

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-1">
            <article class="relative hidden overflow-hidden rounded sm:block">
                <div v-if="isLoading">
                    <div
                        class="h-auto min-h-[170px] w-full rounded bg-gray-300 lg:max-w-[317px]"
                    ></div>
                    <div
                        class="bg-gradient-cover absolute bottom-0 w-full space-y-2 rounded-b px-4 pt-7 pb-4"
                    >
                        <div
                            class="bg-base-100/30 h-6 animate-pulse rounded dark:bg-slate-700"
                        ></div>
                        <div
                            class="bg-base-100/30 h-4 w-1/2 animate-pulse rounded dark:bg-slate-700"
                        ></div>
                    </div>
                </div>
                <template v-else>
                    <InertiaLink
                        :href="route('news.show', articles?.at(1)?.slug)"
                        class="relative block"
                    >
                        <img
                            :src="
                                articles?.at(1)?.thumbnail
                                    ? (articles?.at(1)?.thumbnail ??
                                      'https://via.placeholder.com/800x400')
                                    : 'https://via.placeholder.com/800x400'
                            "
                            loading="lazy"
                            decoding="async"
                            alt="Placeholder"
                            class="mx-auto h-[170px] w-full max-w-full rounded"
                        />
                        <div
                            v-if="articles?.at(1)?.review"
                            class="hexagon absolute top-2 right-2 w-[50px]"
                        >
                            <div>{{ articles?.at(1)?.review?.overall }}</div>
                        </div>
                        <div
                            class="bg-gradient-cover absolute bottom-0 w-full rounded px-4 pt-7 pb-4"
                        >
                            <h2
                                class="mb-1 text-lg leading-tight font-bold text-white capitalize"
                                v-html="articles?.at(1)?.title"
                            />
                            <div class="flex flex-row gap-x-4 pt-2 text-gray-100">
                                <div class="border-l-2 border-red-600 pl-1">
                                    {{ articles?.at(1)?.author?.name }}
                                </div>
                            </div>
                        </div>
                    </InertiaLink>
                </template>
            </article>

            <articles-card class="block sm:hidden" :article="articles?.at(1)" />

            <article class="relative hidden overflow-hidden rounded sm:block">
                <div v-if="isLoading">
                    <div class="min-h-[170px] w-full rounded bg-gray-300 lg:max-w-[317px]"></div>
                    <div
                        class="bg-gradient-cover absolute bottom-0 w-full space-y-2 rounded-b px-4 pt-7 pb-4"
                    >
                        <div
                            class="bg-base-100/30 h-6 animate-pulse rounded dark:bg-slate-700"
                        ></div>
                        <div
                            class="bg-base-100/30 h-4 w-1/2 animate-pulse rounded dark:bg-slate-700"
                        ></div>
                    </div>
                </div>
                <template v-else>
                    <InertiaLink
                        :href="route('news.show', articles?.at(2)?.slug)"
                        class="relative block"
                    >
                        <img
                            :src="
                                articles?.at(2)?.thumbnail
                                    ? (articles?.at(2)?.thumbnail ??
                                      'https://via.placeholder.com/800x400')
                                    : 'https://via.placeholder.com/800x400'
                            "
                            loading="lazy"
                            decoding="async"
                            alt="Placeholder"
                            class="mx-auto h-[170px] w-full max-w-full rounded"
                        />
                        <div
                            v-if="articles?.at(3)?.review"
                            class="hexagon absolute top-2 right-2 w-[50px]"
                        >
                            <div>{{ articles?.at(3)?.review?.overall }}</div>
                        </div>
                        <div
                            class="bg-gradient-cover absolute bottom-0 w-full rounded px-4 pt-7 pb-4"
                        >
                            <h2
                                class="mb-1 text-lg leading-tight font-bold text-white capitalize"
                                v-html="articles?.at(2)?.title"
                            />
                            <div class="flex flex-row gap-x-4 pt-2 text-gray-100">
                                <div class="border-l-2 border-red-600 pl-1">
                                    {{ articles?.at(2)?.author?.name }}
                                </div>
                            </div>
                        </div>
                    </InertiaLink>
                </template>
            </article>

            <articles-card class="block sm:hidden" :article="articles?.at(2)" />

            <article class="relative hidden overflow-hidden rounded sm:block">
                <div v-if="isLoading">
                    <div class="min-h-[170px] w-full rounded bg-gray-300 lg:max-w-[317px]"></div>
                    <div
                        class="bg-gradient-cover absolute bottom-0 w-full space-y-2 rounded-b px-4 pt-7 pb-4"
                    >
                        <div
                            class="bg-base-100/30 h-6 animate-pulse rounded dark:bg-slate-700"
                        ></div>
                        <div
                            class="bg-base-100/30 h-4 w-1/2 animate-pulse rounded dark:bg-slate-700"
                        ></div>
                    </div>
                </div>
                <template v-else>
                    <InertiaLink
                        :href="route('news.show', articles?.at(3)?.slug)"
                        class="relative block"
                    >
                        <img
                            :src="
                                articles?.at(3)?.thumbnail
                                    ? (articles?.at(3)?.thumbnail ??
                                      'https://via.placeholder.com/800x400')
                                    : 'https://via.placeholder.com/800x400'
                            "
                            loading="lazy"
                            decoding="async"
                            alt="Placeholder"
                            class="mx-auto h-[170px] w-full max-w-full rounded"
                        />
                        <div
                            v-if="articles?.at(3)?.review"
                            class="hexagon absolute top-2 right-2 w-[50px]"
                        >
                            <div>{{ articles?.at(3)?.review?.overall }}</div>
                        </div>
                        <div
                            class="bg-gradient-cover absolute bottom-0 w-full rounded px-4 pt-7 pb-4"
                        >
                            <h2
                                class="mb-1 text-lg leading-tight font-bold text-white capitalize"
                                v-html="articles?.at(3)?.title"
                            />
                            <div class="flex flex-row gap-x-4 pt-2 text-gray-100">
                                <div class="border-l-2 border-red-600 pl-1">
                                    {{ articles?.at(3)?.author?.name }}
                                </div>
                            </div>
                        </div>
                    </InertiaLink>
                </template>
            </article>

            <articles-card class="block sm:hidden" :article="articles?.at(3)" />

            <article class="relative hidden overflow-hidden rounded sm:block">
                <div v-if="isLoading">
                    <div class="min-h-[170px] w-full rounded bg-gray-300 lg:max-w-[317px]"></div>
                    <div
                        class="bg-gradient-cover absolute bottom-0 w-full space-y-2 rounded-b px-4 pt-7 pb-4"
                    >
                        <div
                            class="bg-base-100/30 h-6 animate-pulse rounded dark:bg-slate-700"
                        ></div>
                        <div
                            class="bg-base-100/30 h-4 w-1/2 animate-pulse rounded dark:bg-slate-700"
                        ></div>
                    </div>
                </div>
                <template v-else>
                    <InertiaLink
                        :href="route('news.show', articles?.at(4)?.slug)"
                        class="relative block"
                    >
                        <img
                            :src="
                                articles?.at(4)?.thumbnail
                                    ? (articles?.at(4)?.thumbnail ??
                                      'https://via.placeholder.com/800x400')
                                    : 'https://via.placeholder.com/800x400'
                            "
                            loading="lazy"
                            decoding="async"
                            alt="Placeholder"
                            class="mx-auto h-[170px] w-full max-w-full rounded"
                        />
                        <div
                            v-if="articles?.at(4)?.review"
                            class="hexagon absolute top-2 right-2 w-[50px]"
                        >
                            <div>{{ articles?.at(4)?.review?.overall }}</div>
                        </div>
                        <div
                            class="bg-gradient-cover absolute bottom-0 w-full rounded px-4 pt-7 pb-4"
                        >
                            <h2
                                class="mb-1 overflow-hidden text-lg leading-tight font-bold text-nowrap text-ellipsis text-white capitalize"
                                v-html="articles?.at(4)?.title"
                            />
                            <div class="flex flex-row gap-x-4 pt-2 text-gray-100">
                                <div class="border-l-2 border-red-600 pl-1">
                                    {{ articles?.at(4)?.author?.name }}
                                </div>
                            </div>
                        </div>
                    </InertiaLink>
                </template>
            </article>

            <articles-card class="block sm:hidden" :article="articles?.at(4)" />
        </div>
    </div>
</template>
