<script lang="ts" setup>
import EmbedLayout from '@/layouts/embed.vue'

defineProps<{ video: string }>()

defineLayout([EmbedLayout])
</script>

<template>
    <div class="h-full w-full">
        <div class="aspect-video w-full">
            <iframe
                :src="`https://www.youtube.com/embed/${video}?rel=0&wmode=transparent&hd=1`"
                frameborder="0"
                allow="
                    accelerometer;
                    autoplay;
                    clipboard-write;
                    encrypted-media;
                    gyroscope;
                    picture-in-picture;
                "
                allowfullscreen
                class="aspect-video w-full"
            ></iframe>
        </div>
    </div>
</template>
