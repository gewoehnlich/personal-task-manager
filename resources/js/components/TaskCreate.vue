<script setup lang="ts">
import { ref } from 'vue';
import Card from './ui/card/Card.vue';
import TaskTitle from './ui/task/TaskTitle.vue';
import TaskDescription from './ui/task/TaskDescription.vue';
import TaskDeadline from './ui/task/TaskDeadline.vue';
import TaskStage from './ui/task/TaskStage.vue';
import TaskFieldLabel from './ui/task/TaskFieldLabel.vue';
import TaskBorderline from './ui/task/TaskBorderline.vue';
import TaskButtonCancel from './ui/task/TaskButtonCancel.vue';
import TaskButtonSave from './ui/task/TaskButtonSave.vue';

const props = defineProps<{
    stage: string;
}>();

const title = ref<string>('');
const description = ref<string>('');
const stage = ref<string>(props.stage);
const deadline = ref<string | null>(null);

const emit = defineEmits<{
    (e: 'submit', title: string, description: string, stage: string, deadline: string | null): void;
    (e: 'close'): void;
}>();

function saveChanges() {
    emit('submit', title.value, description.value, stage.value, deadline.value);

    title.value = '';
    description.value = '';
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
            <TaskTitle v-model:title="title" />

            <TaskFieldLabel label="Description:" />

            <TaskDescription v-model:description="description"/>

            <TaskFieldLabel label="Stage:" />

            <TaskStage v-model:stage="stage" />

            <TaskFieldLabel label="Deadline:" />

            <TaskDeadline v-model:deadline="deadline"/>

            <TaskBorderline />

            <div class="flex justify-end gap-1 pt-2">
                <TaskButtonCancel @click="$emit('close')" />

                <TaskButtonSave @click="saveChanges" />
            </div>
        </Card>
    </div>
</template>
