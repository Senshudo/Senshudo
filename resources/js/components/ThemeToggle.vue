<script setup>
import { useColorMode, useCycleList } from '@vueuse/core'
import { watchEffect } from 'vue-demi'
import { SunIcon, MoonIcon, ComputerDesktopIcon } from '@heroicons/vue/24/solid'

const mode = useColorMode({ emitAuto: true })

const { state, next } = useCycleList(['dark', 'light', 'auto'], { initialValue: mode })

watchEffect(() => (mode.value = state.value))
</script>

<template>
    <button @click="next()">
        <MoonIcon
            v-if="state === 'dark'"
            aria-hidden="true"
            class="inline-block h-6 w-6 align-middle"
        />
        <SunIcon
            v-if="state === 'light'"
            aria-hidden="true"
            class="inline-block h-6 w-6 align-middle"
        />
        <ComputerDesktopIcon
            v-if="state === 'auto'"
            aria-hidden="true"
            class="inline-block h-6 w-6 align-middle"
        />
    </button>
</template>
