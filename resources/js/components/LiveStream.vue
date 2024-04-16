<script setup>
const echo = useEcho()

const activeChannel = ref('senshudo')

const isLive = ref(false)

onMounted(() => {
    echo?.channel('App.Stream')?.listen('LiveStreamUpdated', (event) => {
        if (event.isLive) {
            isLive.value = true
            activeChannel.value = event.channel
        } else {
            isLive.value = false
        }
    })
})

onBeforeUnmount(() => {
    echo?.leaveChannel('App.Stream')
})
</script>

<template>
    <div v-if="isLive" class="mb-4 flex flex-col gap-4 lg:flex-row">
        <div class="flex-1">
            <div class="aspect-video w-full overflow-hidden rounded">
                <iframe
                    :src="`https://player.twitch.tv/?channel=${activeChannel}&autoplay=true&muted=true&parent=senshudo.tv&parent=staging.senshudo.tv`"
                    frameborder="0"
                    allowfullscreen="true"
                    scrolling="no"
                    class="aspect-video w-full"
                ></iframe>
            </div>
        </div>
        <iframe
            id="twitch-chat-embed"
            :src="`https://www.twitch.tv/embed/${activeChannel}/chat?parent=senshudo.tv&parent=staging.senshudo.tv`"
            class="hidden rounded sm:flex md:min-w-[350px]"
        ></iframe>
    </div>
</template>
