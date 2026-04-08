<script setup lang="ts">
import { vBorderAtHover } from '@/directives/vBorderAtHover';
import { vShadowAtHover } from '@/directives/vShadowAtHover';
import { TaskType } from '@/types/task';
import Card from './ui/card/Card.vue';

const props = defineProps<{
    task: TaskType;
}>();

const emit = defineEmits<{
    (e: 'reorder-task', draggedTaskUuid: string, stage: string): void;
    (e: 'task-clicked', task: TaskType): void;
}>();

function handleDragStart(event: DragEvent) {
    event.dataTransfer?.setData('task-uuid', String(props.task.uuid));
}

function handleDragOver(event: DragEvent) {
    event.preventDefault();
}

function handleDrop(event: DragEvent) {
    const draggedTaskUuid = String(event.dataTransfer?.getData('task-uuid'));

    const stage = props.task.stage;

    emit('reorder-task', draggedTaskUuid, stage);
}

function handleClick(): void {
    emit('task-clicked', props.task);
}
</script>

<template>
    <Card
        :id="`${task.uuid}`"
        class="px-4 py-3 break-words"
        entity="task"
        v-border-at-hover
        v-shadow-at-hover
        draggable="true"
        @dragstart="handleDragStart"
        @dragover="handleDragOver"
        @drop="handleDrop"
        @click="handleClick"
    >
        <h2 class="text-lg leading-[1] font-bold">
            {{ task.title }}
        </h2>
    </Card>
</template>
