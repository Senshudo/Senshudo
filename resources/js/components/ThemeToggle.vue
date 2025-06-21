<script lang="ts" setup>
import { ComputerDesktopIcon, MoonIcon, SunIcon } from '@heroicons/vue/24/solid'
import { BasicColorSchema, useColorMode, useCycleList } from '@vueuse/core'
import { watchEffect } from 'vue-demi'

const mode = useColorMode({ emitAuto: true })

const { state, next } = useCycleList(['dark', 'light', 'auto'], { initialValue: mode })

watchEffect(() => (mode.value = state.value as BasicColorSchema))
</script>

<template>
    <button aria-label="Toggle theme" @click="next()">
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
