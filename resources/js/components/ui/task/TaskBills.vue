<script setup lang="ts">
import ButtonBlack from '@/components/ButtonBlack.vue';
import type { Bill } from '@/types/bill';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import TaskButtonCancel from './TaskButtonCancel.vue';
import TaskButtonSave from './TaskButtonSave.vue';

const props = defineProps<{
    task_uuid: string;
}>();

const bills = defineModel<Bill[]>('bills', {
    default: () => [],
});

const showCreateBillPopup = ref(false);

const description = ref('');

const minutes_spent = ref(0);

function add(): void {
    showCreateBillPopup.value = true;
}

function remove(uuid: string): void {
    bills.value = bills.value.filter(
        (bill) => bill.uuid !== uuid,
    );
}

function close(): void {
    showCreateBillPopup.value = false;

    description.value = '';

    minutes_spent.value = 0;
}

function save(): void {
    router.post(`/tasks/${props.task_uuid}/bills`, {
        description: description.value,
        minutes_spent: minutes_spent.value,
    });

    description.value = '';

    minutes_spent.value = 0;
}
</script>

<template>
    <div class="bg-card text-sm">
        <ul v-if="bills.length">
            <li
                v-for="bill in bills"
                class="grid grid-cols-[1fr_auto_auto_auto] gap-1 text-xs"
            >
                <textarea
                    v-model="bill.description"
                    class="min-w-0 focus:outline-none"
                    placeholder="Description"
                />

                <input
                    v-model.number="bill.minutes_spent"
                    type="number"
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

        <div v-if="showCreateBillPopup">
            <input
                v-model="description"
                class="min-w-0 focus:outline-none"
                placeholder="Description"
            />

            <input
                v-model.number="minutes_spent"
                class="min-w focus:ring-none max-w-[4ch] text-right tabular-nums focus:outline-none"
            />

            <div class="flex justify-end gap-1 pt-2">
                <TaskButtonCancel @click="close" />

                <TaskButtonSave @click="save" />
            </div>
        </div>
    </div>
</template>
