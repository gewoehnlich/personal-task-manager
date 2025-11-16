<script setup lang="ts">
import { TaskType } from '@/types/task';
import { vBorderAtHover } from '@/directives/vBorderAtHover';
import { vShadowAtHover } from '@/directives/vShadowAtHover';
import Card from './ui/card/Card.vue';

const props = defineProps<{
    task: TaskType;
}>();

const emit = defineEmits<{
    (e: 'reorder-task', draggedId: number, targetId: number): void;
    (e: 'task-clicked', task: TaskType): void;
}>();

function handleDragStart(event: DragEvent) {
    event.dataTransfer?.setData('task-id', String(props.task.id));
}

function handleDragOver(event: DragEvent) {
    event.preventDefault();
}

function handleDrop(event: DragEvent) {
    const draggedId = parseInt(
        event.dataTransfer?.getData('task-id') || '',
        10,
    );
    const targetId = props.task.id;
    if (!isNaN(draggedId)) {
        emit('reorder-task', draggedId, targetId);
    }
}

function openTask() {
    emit('task-clicked', props.task);
}
</script>

<template>
    <Card
        id="task"
        class="px-4 py-3 break-words"
        v-border-at-hover
        v-shadow-at-hover
        draggable="true"
        @dragstart="handleDragStart"
        @dragover="handleDragOver"
        @drop="handleDrop"
        @click="openTask"
    >
        <h2 class="text-lg font-bold leading-[1]">
            {{ task.title }}
        </h2>
    </Card>
</template>
