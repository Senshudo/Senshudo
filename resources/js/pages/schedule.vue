<script setup lang="ts">
defineProps<{
    liveStream: App.Channel | null
}>()

const times = [
    {
        day: 'Sunday',
        events: [
            {
                start: '21:00',
                end: '01:00',
                timezone: 'UTC',
                title: 'Freebird',
            },
        ],
    },
    { day: 'Monday', events: null },
    {
        day: 'Tuesday',
        events: [{ start: '23:00', end: '03:00', timezone: 'UTC', title: 'Freebird' }],
    },
    { day: 'Wednesday', events: null },
    { day: 'Thursday', events: null },
    {
        day: 'Friday',
        events: null,
    },
    {
        day: 'Saturday',
        events: [
            {
                start: '19:00',
                end: '22:00',
                timezone: 'UTC',
                title: 'SweptSquash',
            },
        ],
    },
]

function setTime(day: number, time: string) {
    const [hour, minute] = time.split(':')

    return useDayJs()
        .day(day)
        .utc()
        .set('hour', parseInt(hour))
        .set('minute', parseInt(minute))
        .format('HH:mm z')
}
</script>

<template>
    <AppHead title="Schedule" />

    <div class="mx-auto my-4 max-w-2xl space-y-4 px-4 lg:max-w-7xl">
        <LiveStream :live-stream="liveStream" />

        <template v-for="(weekDay, index) in times" :key="index">
            <div>
                <p class="my-4 text-2xl font-bold">{{ weekDay.day }}</p>
                <div class="relative">
                    <div class="absolute inset-px rounded-lg bg-white dark:bg-slate-700" />
                    <div
                        class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)]"
                    >
                        <template v-if="weekDay.events">
                            <div
                                v-for="(event, eventIndex) in weekDay.events"
                                :key="eventIndex"
                                class="flex justify-between p-6"
                            >
                                <h3 class="text-lg font-bold">{{ event.title }}</h3>
                                <p class="text-sm">
                                    {{ setTime(index, event.start) }} -
                                    {{ setTime(index, event.end) }}
                                </p>
                            </div>
                        </template>
                        <div v-else class="p-6 text-center">No scheduled streams</div>
                    </div>
                    <div
                        class="pointer-events-none absolute inset-px rounded-lg shadow-sm ring-1 ring-black/5"
                    />
                </div>
            </div>
        </template>
    </div>
</template>
