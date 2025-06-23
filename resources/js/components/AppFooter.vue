<script lang="ts" setup>
const copyrightYear = ref(new Date().getFullYear())

const navigation = {
    company: [
        { name: 'News', href: '/news', route: 'news.*', current: false },
        { name: 'Reviews', href: '/reviews', route: 'reviews', current: false },
        //{ name: 'Guides', href: '/guides', route: 'guides', current: false },
        { name: 'Schedule', href: '/schedule', route: 'schedule', current: false },
        //{ name: 'About', href: '/about', route: 'about', current: false },
    ],
    legal: [
        { name: 'Terms of service', href: '#' },
        { name: 'Privacy policy', href: '#' },
    ],
}
</script>

<template>
    <footer class="inset-px bg-white shadow-sm ring-1 ring-black/5 dark:bg-slate-700">
        <div class="mx-auto max-w-7xl px-6 pt-16 pb-8 sm:pt-24 lg:px-8 lg:pt-32">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-8">
                    <img
                        loading="lazy"
                        decoding="async"
                        class="block h-8 w-auto dark:hidden"
                        src="@/../images/logo-black.svg"
                        alt="Senshudo"
                    />
                    <img
                        loading="lazy"
                        decoding="async"
                        class="hidden h-8 w-auto dark:block"
                        src="@/../images/logo-white.svg"
                        alt="Senshudo"
                    />
                    <p class="text-sm/6 text-balance text-gray-700 dark:text-gray-300">
                        The way of the player.
                    </p>
                    <div class="flex gap-x-6">
                        <Socials />
                    </div>
                </div>
                <div class="mt-16 grid gap-8 md:grid-cols-2 xl:col-span-2 xl:mt-0">
                    <div class="hidden md:grid md:grid-cols-2 md:gap-8">
                        <div></div>
                        <div></div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm/6 font-semibold text-black dark:text-white">
                                Company
                            </h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li v-for="item in navigation.company" :key="item.name">
                                    <a
                                        :href="item.href"
                                        class="text-sm/6 text-gray-700 hover:text-black dark:text-gray-300 dark:hover:text-white"
                                    >
                                        {{ item.name }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-10 md:mt-0">
                            <h3 class="text-sm/6 font-semibold text-black dark:text-white">
                                Legal
                            </h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li v-for="item in navigation.legal" :key="item.name">
                                    <a
                                        :href="item.href"
                                        class="text-sm/6 text-gray-700 hover:text-black dark:text-gray-300 dark:hover:text-white"
                                    >
                                        {{ item.name }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-16 border-t border-gray-200 pt-8 sm:mt-20 lg:mt-24 dark:border-white/10">
                <p class="text-sm/6 text-gray-700 dark:text-gray-300">
                    &copy; {{ copyrightYear }} Senshudo. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</template>
