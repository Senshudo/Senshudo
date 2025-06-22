<script lang="ts" setup>
import EmbedLayout from '@/layouts/embed.vue'

const props = defineProps<{ video: string }>()

defineLayout([EmbedLayout])

const days = computed(() => useDayJs().daysInMonth())

const months = computed(() => {
    return Array.from({ length: 12 }, (_, i) => i)
})

const years = computed(() => {
    const currentYear = new Date().getFullYear()
    return Array.from({ length: 100 }, (_, i) => currentYear - i)
})

const formData = useForm(() => ({
    day: '',
    month: '',
    year: '',
    date_of_birth: '',
    video: props.video,
}))

function verifyAge() {
    formData
        .transform((data) => {
            return {
                ...data,
                date_of_birth: useDayJs(`${data.year}-${data.month}-${data.day}`).format(
                    'DD-MM-YYYY',
                ),
            }
        })
        .post(route('video_verification.store'))
}
</script>

<template>
    <div class="flex h-full w-full items-center">
        <div class="w-full">
            <div class="mx-auto grid w-1/2 grid-cols-3 gap-4">
                <div>
                    <select v-model="formData.day" class="form-input">
                        <option value="" disabled selected>Day</option>
                        <option v-for="day in days" :key="day" :value="day">{{ day }}</option>
                    </select>
                </div>
                <div>
                    <select v-model="formData.month" class="form-input">
                        <option value="" disabled selected>Month</option>
                        <option v-for="month in months" :key="month" :value="month">
                            {{ useDayJs().month(month).format('MMM') }}
                        </option>
                    </select>
                </div>
                <div>
                    <select v-model="formData.year" class="form-input">
                        <option value="" disabled selected>Year</option>
                        <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                    </select>
                </div>

                <div v-if="formData.errors.date_of_birth" class="col-span-3">
                    <div
                        class="w-full items-center rounded-lg bg-[#fae5e9] px-6 py-5 text-base text-[#b0233a] dark:bg-[#2c0f14] dark:text-[#e37285]"
                    >
                        {{ formData.errors.date_of_birth }}
                    </div>
                </div>

                <div class="col-span-3">
                    <button type="button" class="btn-primary" @click.prevent="verifyAge">
                        Verify Age
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
