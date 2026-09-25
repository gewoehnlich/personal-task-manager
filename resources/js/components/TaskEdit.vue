<script setup lang="ts">
import type { Task } from '@/types/task';
import { reactive } from 'vue';
import Card from './ui/card/Card.vue';
import TaskTitle from './ui/task/TaskTitle.vue';
import TaskDescription from './ui/task/TaskDescription.vue';
import TaskDeadline from './ui/task/TaskDeadline.vue';
import TaskBills from './ui/task/TaskBills.vue';
import TaskStage from './ui/task/TaskStage.vue';
import TaskFieldLabel from './ui/task/TaskFieldLabel.vue';
import TaskBorderline from './ui/task/TaskBorderline.vue';
import TaskMetadata from './ui/task/TaskMetadata.vue';
import TaskButtonCancel from './ui/task/TaskButtonCancel.vue';
import TaskButtonSave from './ui/task/TaskButtonSave.vue';
import TaskButtonDelete from './ui/task/TaskButtonDelete.vue';

const props = defineProps<{
    task: Task;
}>();

const emit = defineEmits<{
    (e: 'close'): void;
    (e: 'update', task: Task): void;
    (e: 'delete', task: Task): void;
}>();

const task: Task = reactive<Task>({ ...props.task });

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
            <TaskFieldLabel label="Title:" />

            <TaskTitle v-model:title="task.title" />

            <TaskFieldLabel label="Description:" />

            <TaskDescription v-model:description="task.description"/>

            <TaskFieldLabel label="Bills:" />

            <TaskBills v-model:bills="task.bills" />

            <TaskFieldLabel label="Stage:" />

            <TaskStage v-model:stage="task.stage" />

            <TaskFieldLabel label="Deadline:" />

            <TaskDeadline v-model:deadline="task.deadline"/>

            <TaskBorderline />

            <TaskMetadata
                :created_at="task.created_at"
                :updated_at="task.updated_at"
                :task_uuid="task.uuid"
                :user_uuid="task.user_uuid"
            />

            <div class="flex justify-end gap-1 pt-2">
                <TaskButtonCancel @click="$emit('close')" />

                <TaskButtonSave @click="saveChanges" />

                <TaskButtonDelete @click="deleteTask" />
            </div>
        </Card>
    </div>
</template>
