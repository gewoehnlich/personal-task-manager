<script setup lang="ts">
import { TaskType } from '@/types';

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
    <div
        id="task"
        class="bg-card rounded-xl shadow-2xl/100 p-4 break-words hover:border"
        draggable="true"
        @dragstart="handleDragStart"
        @dragover="handleDragOver"
        @drop="handleDrop"
        @click="openTask"
    >
        <h2 class="text-3xl font-bold">
            {{ task.title }}
        </h2>
    </div>
</template>
