<script lang="ts" setup>
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
                start: '18:00',
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
    <div class="mx-auto max-w-7xl p-4 pt-8 dark:text-white">
        <AppHead title="Schedule" />

        <LiveStream :live-stream="liveStream" />

        <template v-for="(weekDay, index) in times" :key="index">
            <div>
                <h2 class="my-4 text-2xl font-bold">{{ weekDay.day }}</h2>
                <div v-if="weekDay.events" class="grid grid-cols-1 gap-4">
                    <div
                        v-for="(event, eventIndex) in weekDay.events"
                        :key="eventIndex"
                        class="bg-base-100/20 dark:bg-neutral p-4 shadow"
                    >
                        <div class="flex justify-between">
                            <h3 class="text-lg font-bold">{{ event.title }}</h3>
                            <p class="text-sm">
                                {{ setTime(index, event.start) }} - {{ setTime(index, event.end) }}
                            </p>
                        </div>
                    </div>
                </div>
                <div v-else class="bg-base-100/20 dark:bg-neutral p-4 text-center shadow">
                    No Scheduled Streams
                </div>
            </div>
        </template>
    </div>
</template>
