<script lang="ts" setup>
import Facebook from '@/components/Icons/Facebook.vue'
import Instagram from '@/components/Icons/Instagram.vue'
import Tiktok from '@/components/Icons/Tiktok.vue'
import Twitch from '@/components/Icons/Twitch.vue'
import X from '@/components/Icons/X.vue'
import Youtube from '@/components/Icons/Youtube.vue'

const copyrightYear = ref(new Date().getFullYear())

const navigation = [
    {
        name: 'Facebook',
        href: 'https://www.facebook.com/senshudo/',
        icon: Facebook,
    },
    {
        name: 'Instagram',
        href: 'https://www.instagram.com/senshudo/',
        icon: Instagram,
    },
    {
        name: 'X',
        href: 'https://x.com/senshudo',
        icon: X,
    },
    {
        name: 'YouTube',
        href: 'https://www.youtube.com/@SenshudoTvOfficial',
        icon: Youtube,
    },
    {
        name: 'TikTok',
        href: 'https://www.tiktok.com/@senshudotv',
        icon: Tiktok,
    },
    {
        name: 'Twitch',
        href: 'https://www.twitch.tv/senshudo',
        icon: Twitch,
    },
]
</script>

<template>
    <footer>
        <div
            class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center md:justify-between lg:px-8"
        >
            <div class="flex justify-center space-x-6 md:order-2">
                <a
                    v-for="item in navigation"
                    :key="item.name"
                    :href="item.href"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="fill-gray-400 hover:fill-gray-500 dark:fill-gray-300 dark:hover:fill-white"
                >
                    <span class="sr-only">{{ item.name }}</span>
                    <component :is="item.icon" class="h-6 w-6" aria-hidden="true" />
                </a>
            </div>
            <div class="mt-8 md:order-1 md:mt-0">
                <p class="text-center text-xs leading-5">
                    &copy; {{ copyrightYear }} Senshudo. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</template>
