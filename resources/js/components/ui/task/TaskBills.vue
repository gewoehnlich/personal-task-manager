<script setup lang="ts">
import { Bill } from '@/types/bill';

const bills = defineModel<Bill[] | null>('bills');
</script>

<template>
    <ul class="bg-card text-sm">
        <li
            v-if="bills?.length !== 0"
            v-for="bill in bills"
            :key="bill.uuid"
            class="grid grid-cols-[1fr_auto_auto] gap-1 text-xs"
        >
            <input
                v-model="bill.description"
                class="focus:ring-none focus:outline-none"
            />

            <input
                v-model="bill.minutes_spent"
                class="min-w focus:ring-none max-w-[4ch] text-right tabular-nums focus:outline-none"
            />

            <span>minutes</span>
        </li>

        <li v-else>
            <p class="text-gray-500 dark:text-gray-400">
                No bills for this task.
            </p>
        </li>
    </ul>
</template>
