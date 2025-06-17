<script setup lang="ts">
import type { RouterGlobal } from 'momentum-trail/dist/types/router'

const props = defineProps<{
    featured: App.Article[]
    articles: App.PageResource<App.Article>
    liveStream: App.Channel | null
}>()

const copyrightYear = ref(new Date().getFullYear())

const navigationItems = ref<
    {
        name: string
        route: keyof RouterGlobal['routes'] | keyof RouterGlobal['wildcards']
        href: string
        current: boolean
    }[]
>([
    { name: 'News', href: '/news', route: 'news.*', current: false },
    { name: 'Reviews', href: '/reviews', route: 'reviews', current: false },
    //{ name: 'Guides', href: '/guides', route: 'guides', current: false },
    { name: 'Schedule', href: '/schedule', route: 'schedule', current: false },
    //{ name: 'About', href: '/about', route: 'about', current: false },
])

const navigation = {
    company: [
        { name: 'About', href: '#' },
        { name: 'Blog', href: '#' },
        { name: 'Jobs', href: '#' },
        { name: 'Press', href: '#' },
    ],
    legal: [
        { name: 'Terms of service', href: '#' },
        { name: 'Privacy policy', href: '#' },
        { name: 'License', href: '#' },
    ],
}

onBeforeMount(() => {
    router.on('navigate', () => {
        const currentActive = navigationItems.value.findIndex((item) => item.current === true)
        const newActive = navigationItems.value.findIndex((item) => {
            if (item.route === null) {
                return false
            }

            return current(item.route)
        })

        if (newActive === -1 && currentActive !== -1) {
            navigationItems.value[currentActive].current = false
        }

        if (newActive > -1 && currentActive !== newActive) {
            if (currentActive !== -1) {
                navigationItems.value[currentActive].current = false
            }

            navigationItems.value[newActive].current = true
        }
    })
})

const topFeatured = computed(() => props.featured.at(0))

const otherFeatured = computed(() => {
    return props.featured.filter((item) => item.id !== topFeatured.value?.id)
})
</script>

<template>
    <div>
        <AppHead />
        <header>
            <div class="flex items-center justify-center py-6">
                <img
                    loading="lazy"
                    decoding="async"
                    class="block h-12 w-auto dark:hidden"
                    src="@/../images/logo-black.svg"
                    width="141"
                    height="48"
                    alt="Senshudo"
                />
                <img
                    loading="lazy"
                    decoding="async"
                    class="hidden h-12 w-auto dark:block"
                    src="@/../images/logo-white.svg"
                    width="141"
                    height="48"
                    alt="Senshudo"
                />
            </div>
            <div class="mx-auto max-w-7xl">
                <div
                    class="flex items-center justify-center gap-2 border-b border-b-gray-200 px-4 sm:justify-between"
                >
                    <div class="hidden sm:block lg:w-[216px]">
                        <ThemeToggle class="mb-2" />
                    </div>
                    <nav class="flex flex-grow-0 gap-4">
                        <InertiaLink
                            v-for="(item, index) in navigationItems"
                            :key="index"
                            :href="item.href"
                            :class="[
                                'dark:hover:border-base-content dark:hover:text-base-content inline-flex items-center border-b-2 px-1 pt-1 pb-2 text-sm font-medium hover:border-gray-300 hover:text-gray-700',
                                {
                                    'dark:text-base-content/80 border-transparent text-gray-500':
                                        !item.current,
                                    'border-indigo-500 text-gray-900 dark:border-white dark:text-white':
                                        item.current,
                                },
                            ]"
                        >
                            {{ item.name }}
                        </InertiaLink>
                    </nav>
                    <div class="hidden justify-center space-x-4 md:order-2 lg:flex">
                        <Socials />
                    </div>
                    <div class="hidden sm:block lg:hidden"></div>
                </div>
            </div>
        </header>

        <div class="mx-auto my-4 max-w-2xl px-4 lg:max-w-7xl">
            <div
                class="inset-px hidden h-[600px] w-full grid-cols-5 overflow-hidden rounded-lg shadow-sm ring-1 ring-black/5 lg:grid"
            >
                <InertiaLink
                    :href="route('news.show', topFeatured?.slug)"
                    class="relative col-span-2 flex items-end bg-gray-50 bg-cover p-4"
                    :style="`background-image: url(${topFeatured?.background})`"
                >
                    <div
                        class="-mx-4 -mb-4 flex max-w-[calc(100%+2rem)] flex-col bg-linear-to-t from-black to-transparent p-4 whitespace-nowrap text-white"
                    >
                        <span class="max-w-full overflow-hidden text-lg font-bold text-ellipsis">
                            {{ topFeatured?.title }}
                        </span>
                        <span class="max-w-full overflow-hidden text-sm text-ellipsis">
                            {{ topFeatured?.author?.name }}
                        </span>
                    </div>
                    <div
                        class="pointer-events-none absolute inset-px rounded-lg shadow-sm ring-1 ring-black/5"
                    />
                </InertiaLink>
                <div class="col-span-3 grid grid-cols-2">
                    <InertiaLink
                        v-for="(article, index) in otherFeatured"
                        :key="`featured-${index + 1}`"
                        :href="route('news.show', article?.slug)"
                        :class="`relative bg-gray-${index}00 flex items-end bg-cover p-4`"
                        :style="`background-image: url(${article.background})`"
                    >
                        <div
                            class="-mx-4 -mb-4 flex max-w-[calc(100%+2rem)] flex-col bg-linear-to-t from-black to-transparent p-4 whitespace-nowrap text-white"
                        >
                            <span
                                class="max-w-full overflow-hidden text-lg font-bold text-ellipsis"
                            >
                                {{ article?.title }}
                            </span>
                            <span class="max-w-full overflow-hidden text-sm text-ellipsis">
                                {{ article?.author?.name }}
                            </span>
                        </div>
                        <div
                            :class="[
                                'pointer-events-none absolute inset-px shadow-sm ring-1 ring-black/5',
                                {
                                    'rounded-tr-lg': index === 1,
                                    'rounded-bl-lg': index === 3,
                                },
                            ]"
                        />
                    </InertiaLink>
                </div>
            </div>

            <div class="block space-y-4 lg:hidden">
                <InertiaLink
                    v-for="(article, index) in featured"
                    :key="`featured-${index}`"
                    :href="route('news.show', article?.slug)"
                    :class="`relative bg-gray-${index}00 flex h-60 items-end overflow-hidden rounded-lg bg-cover p-4 shadow-sm ring-1 ring-black/5`"
                    :style="`background-image: url(${article.background})`"
                >
                    <div
                        class="-mx-4 -mb-4 flex max-w-[calc(100%+2rem)] flex-col bg-linear-to-t from-black to-transparent p-4 whitespace-nowrap text-white"
                    >
                        <span class="max-w-full overflow-hidden text-lg font-bold text-ellipsis">
                            {{ article?.title }}
                        </span>
                        <span class="max-w-full overflow-hidden text-sm text-ellipsis">
                            {{ article?.author?.name }}
                        </span>
                    </div>
                    <div
                        class="pointer-events-none absolute inset-px rounded-lg shadow-sm ring-1 ring-black/5"
                    />
                </InertiaLink>
            </div>
        </div>

        <div class="mx-auto mb-4 max-w-2xl px-4 lg:max-w-7xl">
            <div
                class="mb-4 flex items-center justify-between gap-4 border-b border-b-gray-200 pb-1"
            >
                <h2 class="text-2xl font-bold">Articles</h2>
                <InertiaLink :href="route('news.index')">View All</InertiaLink>
            </div>

            <div class="grid grid-cols-1 gap-4 lg:grid-cols-6">
                <InertiaLink
                    v-for="(article, index) in articles.data"
                    :key="`article-${index}`"
                    :href="route('news.show', article?.slug)"
                    class="relative lg:col-span-2"
                >
                    <div class="absolute inset-px rounded-lg bg-white dark:bg-slate-700" />
                    <div
                        class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)]"
                    >
                        <img
                            class="h-60 object-cover object-left"
                            :src="article.background"
                            :alt="article.title"
                            width="405"
                            height="240"
                            loading="lazy"
                            decoding="async"
                        />
                        <div class="p-10 pt-4">
                            <h3
                                class="flex justify-between text-sm/4 font-semibold text-indigo-600 dark:text-gray-300"
                            >
                                <span>{{ article?.author?.name }}</span>
                                <span>
                                    {{ useDayJs(article?.published_at).format('DD/MM/YYYY') }}
                                </span>
                            </h3>
                            <p
                                class="mt-2 text-lg font-medium tracking-tight text-gray-950 dark:text-white"
                            >
                                {{ article.title }}
                            </p>
                            <p
                                class="mt-2 max-w-lg text-sm/6 text-gray-600 dark:text-gray-300"
                                v-html="article.excerpt"
                            />
                        </div>
                    </div>
                    <div
                        class="pointer-events-none absolute inset-px rounded-lg shadow-sm ring-1 ring-black/5"
                    />
                </InertiaLink>
            </div>
        </div>

        <div class="mx-auto mb-4 max-w-2xl px-4 lg:max-w-7xl">
            <div
                class="mb-4 flex items-center justify-between gap-4 border-b border-b-gray-200 pb-1"
            >
                <h2 class="text-2xl font-bold">Reviews</h2>
                <InertiaLink :href="route('reviews')">View All</InertiaLink>
            </div>
        </div>

        <footer class="bg-gray-100 dark:bg-slate-700">
            <div class="mx-auto max-w-7xl px-6 pt-16 pb-8 sm:pt-24 lg:px-8 lg:pt-32">
                <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                    <div class="space-y-8">
                        <img
                            class="h-9"
                            src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                            alt="Company name"
                        />
                        <p class="text-sm/6 text-balance text-gray-400">
                            Making the world a better place through constructing elegant
                            hierarchies.
                        </p>
                        <div class="flex gap-x-6">
                            <Socials />
                        </div>
                    </div>
                    <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
                        <div class="md:grid md:grid-cols-2 md:gap-8">
                            <div></div>
                            <div></div>
                        </div>
                        <div class="md:grid md:grid-cols-2 md:gap-8">
                            <div>
                                <h3 class="text-sm/6 font-semibold text-white">Company</h3>
                                <ul role="list" class="mt-6 space-y-4">
                                    <li v-for="item in navigation.company" :key="item.name">
                                        <a
                                            :href="item.href"
                                            class="text-sm/6 text-gray-300 hover:text-gray-300"
                                        >
                                            {{ item.name }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="mt-10 md:mt-0">
                                <h3 class="text-sm/6 font-semibold text-white">Legal</h3>
                                <ul role="list" class="mt-6 space-y-4">
                                    <li v-for="item in navigation.legal" :key="item.name">
                                        <a
                                            :href="item.href"
                                            class="text-sm/6 text-gray-300 hover:text-gray-300"
                                        >
                                            {{ item.name }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-16 border-t border-white/10 pt-8 sm:mt-20 lg:mt-24">
                    <p class="text-sm/6 text-gray-400">
                        &copy; {{ copyrightYear }} Senshudo. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>
