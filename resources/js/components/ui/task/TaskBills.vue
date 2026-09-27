<script setup lang="ts">
import ButtonBlack from '@/components/ButtonBlack.vue';
import type { Bill } from '@/types/bill';

const props = defineProps<{
    task_uuid: string;
}>();


const bills = defineModel<Bill[]>('bills', {
    default: () => [],
});

function add(): void {
    bills.value.push({
        task_uuid: props.task_uuid,
        description: '',
        minutes_spent: 0,
    });
}

function remove(uuid: string): void {
    bills.value = bills.value.filter(
        (bill) => bill.uuid !== uuid,
    );
}
</script>

<template>
    <div class="bg-card text-sm">
        <ul v-if="bills.length">
            <li
                v-for="bill in bills"
                class="grid grid-cols-[1fr_auto_auto_auto] gap-1 text-xs"
            >
                <input
                    v-model="bill.description"
                    class="min-w-0 focus:outline-none"
                    placeholder="Description"
                />

                <input
                    v-model.number="bill.minutes_spent"
                    class="min-w focus:ring-none max-w-[4ch] text-right tabular-nums focus:outline-none"
                />

                <ButtonBlack
                    @click="remove(bill.uuid)"
                />
            </li>
        </ul>

        <div class="flex justify-between">
            <p
                v-if="!bills.length"
                class="text-gray-500 dark:text-gray-400"
            >
                No bills for this task.
            </p>
        </div>

        <ButtonBlack
            class="w-full"
            @click="add"
        >
            Add
        </ButtonBlack>
    </div>
</template>
