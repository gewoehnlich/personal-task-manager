<script setup lang="ts">
import type { Task } from '@/types/task';
import { reactive } from 'vue';
import Button from './ui/button/Button.vue';
import Card from './ui/card/Card.vue';
import TaskTitle from './ui/task/TaskTitle.vue';
import TaskDescription from './ui/task/TaskDescription.vue';
import TaskDeadline from './ui/task/TaskDeadline.vue';

const props = defineProps<{
    task: Task;
}>();

const emit = defineEmits<{
    (e: 'close'): void;
    (e: 'update', updatedTask: Task): void;
    (e: 'delete', task: Task): void;
}>();

const task: Task = reactive({ ...props.task });

function saveChanges() {
    emit('update', { ...task });
    emit('close');
}

function deleteTask() {
    emit('delete', { ...task });
    emit('close');
}
</script>

<template>
    <div
        class="bg-card/70 fixed inset-0 flex items-center justify-center backdrop-blur-sm"
        @click="$emit('close')"
        entity="task-edit"
    >
        <Card
            class="border-accent shadow-accent max-h-[90vh] max-w-sm space-y-2 overflow-y-auto border p-6 shadow-2xl/100"
            @click.stop
        >
            <div>
                <TaskTitle v-model:title="task.title"/>
            </div>

            <div>
                <p class="text-muted-foreground text-xs">Description:</p>

                <TaskDescription v-model:description="task.description"/>
            </div>

            <div v-if="task.bills.length !== 0">
                <p class="text-muted-foreground text-xs">Bills:</p>

                <ul class="bg-card text-sm">
                    <li
                        v-if="task.bills.length !== 0"
                        v-for="bill in task.bills"
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

            <div class="flex-1">
                <p class="text-muted-foreground mb-1 text-xs">Stage:</p>

                <select
                    v-model="task.stage"
                    class="bg-muted focus:ring-none h-8 w-full rounded-lg p-1.5 text-sm focus:outline-none"
                >
                    <option value="pending">Pending</option>
                    <option value="active">Active</option>
                    <option value="delayed">Delayed</option>
                    <option value="done">Done</option>
                </select>
            </div>

            <div class="min-w-[140px] flex-1">
                <p class="text-muted-foreground mb-1 text-xs">Deadline:</p>

                <TaskDeadline v-model:deadline="task.deadline"/>
            </div>

            <div class="py-2">
                <div class="border-muted border-t"></div>
            </div>

            <div class="text-muted-foreground text-xs">
                <p>Created at: {{ task.created_at }}</p>
                <p>Updated at: {{ task.updated_at }}</p>

                <div class="py-1"></div>

                <p>Task UUID: {{ task.uuid }}</p>
                <p>User UUID: {{ task.user_uuid }}</p>
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
