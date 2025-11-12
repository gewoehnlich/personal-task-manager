<script setup lang="ts">
import { TaskType } from '@/types/task';

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
        class="bg-card rounded-xl px-4 py-3 break-words border border-transparent hover:border-ring w-full hover:shadow-md/25 hover:shadow-ring"
        draggable="true"
        @dragstart="handleDragStart"
        @dragover="handleDragOver"
        @drop="handleDrop"
        @click="openTask"
    >
        <h2 class="text-lg font-bold leading-[1.1]">
            {{ task.title }}
        </h2>
    </div>
</template>
