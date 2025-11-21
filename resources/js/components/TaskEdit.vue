<script setup lang="ts">
import { TaskType } from '@/types/task';
import { computed, reactive, ref, watch, nextTick, onMounted } from 'vue';
import Deadline from './Deadline.vue';
import Card from './ui/card/Card.vue';
import Button from './ui/button/Button.vue';

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

function autoResize() {
  const el = description.value
  if (!el) {
      return;
  }

  el.style.height = 'auto'
  el.style.height = el.scrollHeight + 'px'
}

onMounted(() => {
  autoResize()
})

watch(() => editableTask.description, async () => {
  await nextTick()
  autoResize()
})

</script>

<template>
    <div
        class="fixed inset-0 flex items-center justify-center bg-card/70 backdrop-blur-sm"
    >
        <Card
            class="max-h-[90vh] max-w-md space-y-4 overflow-y-auto p-6 border border-accent shadow-accent shadow-2xl/100"
        >
            <div>
                <div class="flex items-start justify-between text-2xl gap-1 font-bold">
                    <input
                        v-model="editableTask.title"
                        class="grow-1 font-bold focus:ring-none focus:outline-none truncate"
                    />
                    <button
                        @click="$emit('close')"
                        class="text-muted-foreground hover:text-destructive transition grow-0 w-8"
                    >
                        &times;
                    </button>
                </div>

                <p class="text-xs text-muted-foreground">
                    Task ID: {{ task.id }} | User ID: {{ task.user_id }}
                </p>
            </div>

            <div>
                <p class="text-xs text-muted-foreground">
                    Description:
                </p>

                <textarea
                    ref="description"
                    v-model="editableTask.description"
                    class="break-words w-full focus:ring-none focus:outline-none text-sm/[18px] overflow-hidden resize-none"
                ></textarea>
            </div>

            <div>
                <p class="text-xs text-muted-foreground">
                    Bills:
                </p>

                <ul class="bg-card text-sm">
                    <li
                        v-if="editableTask.bills.length !== 0"
                        v-for="bill in editableTask.bills"
                        :key="bill.id"
                        class="grid grid-cols-[1fr_auto_auto] gap-1 text-xs"
                    >
                        <input
                            v-model="bill.description"
                            class="focus:ring-none focus:outline-none"
                        ></input>

                        <input
                            v-model="bill.time_spent"
                            class="text-right tabular-nums min-w max-w-[4ch] focus:ring-none focus:outline-none"
                        ></input>

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
                        <p class="text-muted-foreground text-xs">
                            Stage:
                        </p>

                        <select
                            v-model="editableTask.stage"
                            class="bg-card w-full rounded-md focus:ring-none focus:outline-none text-xs"
                        >
                            <option value="pending">Pending</option>
                            <option value="active">Active</option>
                            <option value="delayed">Delayed</option>
                            <option value="done">Done</option>
                        </select>
                    </div>

                    <div class="min-w-[140px] flex-1">
                        <p class="mb-1 text-xs text-muted-foreground">
                            Deadline:
                        </p>

                        <Deadline />
                    </div>
                </div>

                <div class="py-2">
                    <div class="border-t border-muted"></div>
                </div>

                <div class="text-xs text-muted-foreground">
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
