<script lang="ts" setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'
import { Link as InertiaLink } from '@inertiajs/vue3'
import type { RouterGlobal } from 'momentum-trail/dist/types/router'

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
</script>

<template>
    <Disclosure v-slot="{ open }" as="header" class="dark:bg-neutral bg-white shadow">
        <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:divide-y lg:divide-gray-700 lg:px-8">
            <div class="relative flex h-16 justify-between">
                <div class="relative z-10 flex px-2 lg:px-0">
                    <InertiaLink href="/" class="flex flex-shrink-0 items-center">
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
                    </InertiaLink>
                </div>
                <div
                    class="relative flex flex-1 items-center justify-center px-2 sm:absolute sm:inset-0"
                >
                    <div class="grid w-full grid-cols-1 sm:max-w-xs">
                        <Search />
                    </div>
                </div>
                <div class="relative z-10 flex items-center lg:hidden">
                    <!-- Mobile menu button -->
                    <DisclosureButton
                        class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:outline-hidden focus:ring-inset"
                    >
                        <span class="absolute -inset-0.5" />
                        <span class="sr-only">Open menu</span>
                        <Bars3Icon v-if="!open" class="block size-6" aria-hidden="true" />
                        <XMarkIcon v-else class="block size-6" aria-hidden="true" />
                    </DisclosureButton>
                </div>
                <div class="hidden lg:relative lg:z-10 lg:ml-4 lg:flex lg:items-center">
                    <ThemeToggle />
                </div>
            </div>
            <nav class="hidden lg:flex lg:justify-center lg:space-x-8 lg:py-2" aria-label="Global">
                <InertiaLink
                    v-for="item in navigationItems"
                    :key="item.name"
                    :href="item.href"
                    :class="[
                        item.current
                            ? 'bg-gray-100 text-black dark:bg-gray-900 dark:text-white'
                            : 'text-gray-700 hover:bg-gray-100 hover:text-black dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white',
                        'inline-flex items-center rounded-md px-3 py-2 text-sm font-medium',
                    ]"
                    :aria-current="item.current ? 'page' : undefined"
                >
                    {{ item.name }}
                </InertiaLink>
            </nav>
        </div>

        <DisclosurePanel as="nav" class="lg:hidden" aria-label="Global">
            <div class="space-y-1 px-2 pt-2 pb-3">
                <DisclosureButton
                    v-for="item in navigationItems"
                    :key="item.name"
                    :as="InertiaLink"
                    :href="item.href"
                    :class="[
                        item.current
                            ? 'bg-gray-900 text-white'
                            : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                        'block rounded-md px-3 py-2 text-base font-medium',
                    ]"
                    :aria-current="item.current ? 'page' : undefined"
                >
                    {{ item.name }}
                </DisclosureButton>
            </div>
        </DisclosurePanel>
    </Disclosure>
</template>
