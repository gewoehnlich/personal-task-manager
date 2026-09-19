<script setup lang="ts">
import { computed } from 'vue';
import Deadline from '../../Deadline.vue';
import { DateValue, parseDate } from '@internationalized/date'

const deadline = defineModel<string | null>('deadline');

function formatDate(date: Date): string {
    const pad = (num: number) => num.toString().padStart(2, '0');

    const year: number = date.getUTCFullYear();
    const month: string = pad(date.getUTCMonth() + 1);
    const day: string = pad(date.getUTCDate());

    const hours: string = pad(date.getUTCHours());
    const minutes: string = pad(date.getUTCMinutes());
    const seconds: string = pad(date.getUTCSeconds());

    return `${year}-${month}-${day}T${hours}:${minutes}:${seconds}+00:00`;
}

const computedDeadline = computed({
    get() {
        if (! deadline.value) {
            return null;
        }

        return parseDate(deadline.value.split('T')[0]);
    },
    set(date: DateValue) {
        deadline.value = formatDate(date.toDate('+00:00'));
    },
});
</script>

<template>
    <Deadline v-model="computedDeadline"/>
</template>
