<script lang="ts" setup>
import { useDark } from '@vueuse/core'

const props = defineProps<{ liveStream: App.Channel | null }>()

const echo = useEcho()

const isDark = useDark()

const activeChannel = ref('senshudo')

const isLive = ref(false)

onMounted(() => {
    const liveStream = props.liveStream

    if (liveStream && liveStream.is_online) {
        isLive.value = liveStream.is_online
        activeChannel.value = liveStream.channel_name
    }

    echo?.channel('App.Stream')?.listen(
        'LiveStreamUpdated',
        (event: { channelName: string; isLive: boolean }) => {
            if (event.isLive) {
                isLive.value = true
                activeChannel.value = event.channelName
            } else {
                isLive.value = false
            }
        },
    )
})

onBeforeUnmount(() => {
    echo?.leaveChannel('App.Stream')
})
</script>

<template>
    <div v-if="isLive" class="mb-4 flex flex-col gap-4 lg:flex-row">
        <div class="flex-1">
            <div class="aspect-video w-full overflow-hidden rounded shadow-sm ring-1 ring-black/5">
                <iframe
                    :src="`https://player.twitch.tv/?channel=${activeChannel}&autoplay=true&muted=true&parent=senshudo.tv&parent=staging.senshudo.tv&parent=senshudo.local`"
                    frameborder="0"
                    allowfullscreen="true"
                    scrolling="no"
                    class="aspect-video w-full"
                ></iframe>
            </div>
        </div>
        <iframe
            id="twitch-chat-embed"
            :src="`https://www.twitch.tv/embed/${activeChannel}/chat?parent=senshudo.tv&parent=staging.senshudo.tv&parent=senshudo.local${isDark ? '&darkpopout' : ''}`"
            class="hidden overflow-hidden rounded shadow-sm ring-1 ring-black/5 sm:flex md:min-w-[350px]"
        ></iframe>
    </div>
</template>
