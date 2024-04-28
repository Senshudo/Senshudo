<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'
import { route } from 'ziggy-js'

const navigationItems = ref([
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

            return route().current(item.route)
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
    <Disclosure v-slot="{ open }" as="nav" class="bg-white shadow dark:bg-neutral">
        <div class="mx-auto max-w-7xl px-2 sm:px-4">
            <div class="flex h-16 justify-between">
                <div class="flex px-2 lg:px-0">
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
                    <div class="hidden lg:ml-6 lg:flex lg:space-x-8">
                        <InertiaLink
                            v-for="(item, index) in navigationItems"
                            :key="index"
                            :href="item.href"
                            :class="[
                                'inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium hover:border-gray-300 hover:text-gray-700 dark:hover:border-base-content dark:hover:text-base-content',
                                {
                                    'border-transparent text-gray-500 dark:text-base-content/80':
                                        !item.current,
                                    'border-indigo-500 text-gray-900 dark:border-white dark:text-white':
                                        item.current,
                                },
                            ]"
                        >
                            {{ item.name }}
                        </InertiaLink>
                    </div>
                </div>
                <div
                    class="flex flex-1 items-center justify-center gap-6 px-2 sm:gap-2 lg:ml-6 lg:justify-end"
                >
                    <theme-toggle />
                    <search />
                </div>
                <div class="flex items-center lg:hidden">
                    <!-- Mobile menu button -->
                    <DisclosureButton
                        class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 dark:hover:bg-base-100"
                    >
                        <span class="absolute -inset-0.5" />
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                        <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
                    </DisclosureButton>
                </div>
            </div>
        </div>

        <DisclosurePanel class="lg:hidden">
            <div class="space-y-1 pb-3 pt-2">
                <InertiaLink
                    v-for="(item, index) in navigationItems"
                    :key="index"
                    :href="item.href"
                    :class="[
                        'block border-l-4 py-2 pl-3 pr-4 text-base font-medium hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800',
                        {
                            'border-transparent text-gray-600 dark:text-base-content/80':
                                !item.current,
                            'border-indigo-500 bg-indigo-50 text-indigo-700 dark:border-white dark:bg-base-100 dark:text-white':
                                item.current,
                        },
                    ]"
                >
                    {{ item.name }}
                </InertiaLink>
            </div>
        </DisclosurePanel>
    </Disclosure>
</template>
