<script setup>
const activeChannel = ref({ name: 'senshudo' })

/* TODO: REVERB CONNECTION */
</script>

<template>
    <div class="mb-4 flex flex-col gap-4 lg:flex-row">
        <div class="flex-1">
            <div class="aspect-h-9 aspect-w-16 overflow-hidden rounded">
                <iframe
                    :src="`https://player.twitch.tv/?channel=${activeChannel.name}&autoplay=true&muted=true&parent=www.senshudo.tv`"
                    frameborder="0"
                    allowfullscreen="true"
                    scrolling="no"
                ></iframe>
            </div>
        </div>
        <iframe
            id="twitch-chat-embed"
            :src="`https://www.twitch.tv/embed/${activeChannel.name}/chat?parent=www.senshudo.tv`"
            class="hidden rounded sm:flex md:min-w-[350px]"
        ></iframe>
    </div>
</template>
