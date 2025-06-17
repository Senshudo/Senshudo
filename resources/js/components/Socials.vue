<script setup lang="ts">
import Facebook from '@/components/Icons/Facebook.vue'
import Instagram from '@/components/Icons/Instagram.vue'
import Tiktok from '@/components/Icons/Tiktok.vue'
import Twitch from '@/components/Icons/Twitch.vue'
import X from '@/components/Icons/X.vue'
import Youtube from '@/components/Icons/Youtube.vue'

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
    <a
        v-for="item in navigation"
        :key="item.name"
        :href="item.href"
        target="_blank"
        rel="noopener noreferrer"
        class="fill-gray-400 hover:fill-gray-500 dark:fill-gray-300 dark:hover:fill-white"
    >
        <span class="sr-only">{{ item.name }}</span>
        <component :is="item.icon" class="h-4 w-4" aria-hidden="true" />
    </a>
</template>
