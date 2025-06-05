<script setup lang="ts">
import { computed } from 'vue';

interface Task {
    id: number;
    userId: number;
    title: string;
    description?: string;
    taskStatus: string;
    deadline: string;
    updated_at: string;
    created_at: string;
}

const props = defineProps<{
    task: Task;
}>();

const emit = defineEmits<{
    (e: 'reorder-task', draggedId: number, targetId: number): void;
    (e: 'task-clicked', task: Task): void;
}>();

function handleDragStart(event: DragEvent) {
    event.dataTransfer?.setData('task-id', String(props.task.id));
}

function handleDragOver(event: DragEvent) {
    event.preventDefault();
}

function handleDrop(event: DragEvent) {
    const draggedId = parseInt(event.dataTransfer?.getData('task-id') || '', 10);
    const targetId = props.task.id;
    if (!isNaN(draggedId)) {
        emit('reorder-task', draggedId, targetId);
    }
}

function openTask(e: event) {
    emit('task-clicked', props.task);
}

</script>

<template>
    <div
        class="task bg-card break-words rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-4"
        draggable="true"
        @dragstart="handleDragStart"
        @dragover="handleDragOver"
        @drop="handleDrop"
        @click="openTask"
    >
        <h2 class="font-bold text-2xl">{{ task.title }}</h2>
        <div class="my-1 h-px bg-gradient-to-r from-transparent via-gray-400 to-transparent dark:via-gray-600"></div>
        <p class="text-md text-gray-700 dark:text-gray-300">{{ task.description }}</p>
    </div>
</template>
