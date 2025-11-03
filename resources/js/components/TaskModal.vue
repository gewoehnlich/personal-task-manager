<script setup lang="ts">
import { TaskType } from '@/types/task';
import DatePicker from 'primevue/datepicker';
import { computed, reactive } from 'vue';

const props = defineProps<{
    task: TaskType;
}>();

const emit = defineEmits<{
    (e: 'close'): void;
    (e: 'update', updatedTask: TaskType): void;
    (e: 'delete', task: TaskType): void;
}>();

const editableTask = reactive({ ...props.task });

function formatDate(date: Date): string {
    const pad = (num: number) => num.toString().padStart(2, '0');
    return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())} ${pad(date.getHours())}:${pad(date.getMinutes())}:${pad(date.getSeconds())}`;
}

const deadlineAsDate = computed({
    get() {
        return editableTask.deadline
            ? new Date(editableTask.deadline.replace(' ', 'T'))
            : null;
    },
    set(val) {
        if (val) {
            editableTask.deadline = formatDate(val);
        }
    },
});

function saveChanges() {
    emit('update', {
        ...editableTask,
    });
    emit('close');
}

function deleteTask() {
    emit('delete', {
        ...editableTask,
    });
    emit('close');
}
</script>

<template>
    <div
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4 backdrop-blur-sm"
    >
        <div
            class="bg-card border-sidebar-border/70 dark:border-sidebar-border max-h-[90vh] w-full max-w-2xl space-y-6 overflow-y-auto rounded-2xl border p-6 shadow-xl"
        >
            <header class="flex items-start justify-between">
                <div>
                    <input
                        v-model="editableTask.title"
                        class="focus:ring-primary mb-1 bg-transparent px-1 text-3xl font-bold focus:ring-2 focus:outline-none"
                    />

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Task ID: {{ task.id }} | User ID: {{ task.userId }}
                    </p>
                </div>
                <button
                    @click="$emit('close')"
                    class="text-xl text-gray-500 transition hover:text-red-500"
                >
                    &times;
                </button>
            </header>

            <section class="space-y-4">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Description
                    </p>

                    <textarea
                        v-model="editableTask.description"
                        class="bg-input focus:ring-primary mt-1 w-full resize-none rounded-md p-2 text-gray-800 focus:ring-2 focus:outline-none dark:text-gray-200"
                        rows="4"
                    ></textarea>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Bills
                    </p>
                    <ul class="mt-1 space-y-2">
                        <li
                            v-for="bill in editableTask.bills"
                            :key="bill.id"
                            class="bg-input flex justify-between rounded-md bg-gray-100 p-2"
                        >
                            <span>{{ bill.description }}</span>
                            <span>{{ bill.timeSpent }} minutes</span>
                        </li>
                        <li v-if="editableTask.bills.length === 0">
                            <p class="text-gray-500 dark:text-gray-400">
                                No bills for this task.
                            </p>
                        </li>
                    </ul>
                </div>

                <div class="flex flex-wrap justify-between gap-4">
                    <div class="min-w-[140px] flex-1">
                        <p
                            class="mb-1 text-sm text-gray-500 dark:text-gray-400"
                        >
                            Stage
                        </p>

                        <select
                            v-model="editableTask.stage"
                            class="bg-input focus:ring-primary w-full rounded-md px-3 py-2 focus:ring-2 focus:outline-none"
                        >
                            <option value="pending">Pending</option>

                            <option value="active">Active</option>

                            <option value="delayed">Delayed</option>

                            <option value="done">Done</option>
                        </select>
                    </div>

                    <div class="min-w-[140px] flex-1">
                        <p
                            class="mb-1 text-sm text-gray-500 dark:text-gray-400"
                        >
                            Deadline
                        </p>

                        <DatePicker
                            id="deadline"
                            v-model="deadlineAsDate"
                            showTime
                            showSeconds
                            hourFormat="24"
                            fluid
                        />
                    </div>
                </div>
            </section>

            <section
                class="border-t border-gray-200 pt-4 text-sm text-gray-500 dark:border-gray-700 dark:text-gray-400"
            >
                <p>Created at: {{ task.createdAt }}</p>

                <p>Updated at: {{ task.updatedAt }}</p>
            </section>

            <footer class="flex justify-end gap-3 pt-6">
                <button
                    @click="$emit('close')"
                    class="bg-muted rounded-md px-4 py-2 text-gray-800 transition hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600"
                >
                    Cancel
                </button>

                <button
                    @click="saveChanges"
                    class="rounded-md bg-green-600 px-4 py-2 text-white transition hover:bg-green-700"
                >
                    Save
                </button>

                <button
                    @click="deleteTask"
                    class="justify-start rounded-md bg-red-600 px-4 py-2 text-white transition hover:bg-red-700"
                >
                    Delete
                </button>
            </footer>
        </div>
    </div>
</template>
