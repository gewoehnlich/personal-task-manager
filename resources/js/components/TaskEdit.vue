<script setup lang="ts">
import { TaskType } from '@/types/task';
import { computed, nextTick, onMounted, reactive, ref, watch } from 'vue';
import Deadline from './Deadline.vue';
import Button from './ui/button/Button.vue';
import Card from './ui/card/Card.vue';

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

const description = ref(null);
const title = ref(null);

function autoResize(): void {
    const descriptionElement = description.value;
    if (!descriptionElement) {
        return;
    }

    descriptionElement.style.height = 'auto';
    descriptionElement.style.height = descriptionElement.scrollHeight + 'px';

    const titleElement = title.value;
    if (!titleElement) {
        return;
    }

    titleElement.style.height = 'auto';
    titleElement.style.height = titleElement.scrollHeight + 'px';
}

onMounted(() => {
    autoResize();
});

watch(
    () => editableTask.description,
    async () => {
        await nextTick();
        autoResize();
    },
);

watch(
    () => editableTask.title,
    async () => {
        await nextTick();
        autoResize();
    },
);
</script>

<template>
    <div
        class="bg-card/70 fixed inset-0 flex items-center justify-center backdrop-blur-sm"
        @click="$emit('close')"
        entity="task-edit"
    >
        <Card
            class="border-accent shadow-accent max-h-[90vh] max-w-md space-y-4 overflow-y-auto border p-6 shadow-2xl/100"
            @click.stop
        >
            <div>
                <textarea
                    ref="title"
                    v-model="editableTask.title"
                    class="w-full resize-none overflow-hidden text-2xl/[20px] font-bold break-words focus:outline-none"
                    autocomplete="off"
                    autocorrect="off"
                    spellcheck="false"
                    maxlength="100"
                />

                <p class="text-muted-foreground text-xs">
                    Task UUID: {{ task.uuid }}
                </p>

                <p class="text-muted-foreground text-xs">
                    User UUID: {{ task.user_uuid }}
                </p>
            </div>

            <div>
                <p class="text-muted-foreground text-xs">Description:</p>

                <textarea
                    ref="description"
                    v-model="editableTask.description"
                    class="focus:ring-none w-full resize-none overflow-hidden text-sm/[18px] break-words focus:outline-none"
                    autocomplete="off"
                    autocorrect="off"
                    spellcheck="false"
                    maxlength="500"
                ></textarea>
            </div>

            <div>
                <p class="text-muted-foreground text-xs">Bills:</p>

                <ul class="bg-card text-sm">
                    <li
                        v-if="editableTask.bills.length !== 0"
                        v-for="bill in editableTask.bills"
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
            </div>

            <div>
                <div class="flex flex-wrap justify-center gap-4">
                    <div class="flex-1">
                        <p class="text-muted-foreground mb-1 text-xs">Stage:</p>

                        <select
                            v-model="editableTask.stage"
                            class="bg-muted focus:ring-none h-8 w-full rounded-lg p-1.5 text-sm focus:outline-none"
                        >
                            <option value="pending">Pending</option>
                            <option value="active">Active</option>
                            <option value="delayed">Delayed</option>
                            <option value="done">Done</option>
                        </select>
                    </div>

                    <div class="min-w-[140px] flex-1">
                        <p class="text-muted-foreground mb-1 text-xs">
                            Deadline:
                        </p>

                        <Deadline />
                    </div>
                </div>

                <div class="py-2">
                    <div class="border-muted border-t"></div>
                </div>

                <div class="text-muted-foreground text-xs">
                    <p>Created at: {{ task.created_at }}</p>
                    <p>Updated at: {{ task.updated_at }}</p>
                </div>
            </div>

            <div class="flex justify-end gap-1 pt-2">
                <Button
                    @click="$emit('close')"
                    variant="cancel"
                    size="sm"
                >
                    Cancel
                </Button>

                <Button
                    @click="saveChanges"
                    variant="confirmative"
                    size="sm"
                >
                    Save
                </Button>

                <Button
                    @click="deleteTask"
                    variant="destructive"
                    size="sm"
                >
                    Delete
                </Button>
            </div>
        </Card>
    </div>
</template>
