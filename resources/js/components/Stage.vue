<script setup lang="ts">
import { TaskType } from '@/types';
import { computed, ref } from 'vue';
import Task from './Task.vue';
import TaskForm from './TaskForm.vue';

const props = defineProps<{
    title: string;
    tasks: Array<TaskType>;
}>();

const emit = defineEmits<{
    (e: 'task-drop', taskId: number, newStatus: string): void;
    (e: 'create-task', task: Omit<TaskType, 'id'>): void;
    (e: 'reorder-task', draggedId: number, targetId: number): void;
    (e: 'task-clicked', task: TaskType): void;
}>();

const showForm = ref(false);
const length = computed(() => props.tasks.length);

function handleDrop(event: DragEvent) {
    const taskId = parseInt(event.dataTransfer?.getData('task-id') || '', 10);
    if (!isNaN(taskId)) {
        emit('task-drop', taskId, props.title);
    }
}

function handleTaskFormSubmit(task: {
    title: string;
    description: string;
    deadline: string;
}): void {
    emit('create-task', {
        ...task,
        stage: props.title,
    });

    showForm.value = false;
}
</script>

<template>
    <div
        class="stage flex h-full flex-col gap-1"
        @dragover.prevent
        @drop="handleDrop"
    >
        <div class="flex justify-between gap-5 px-5 py-2">
            <h2 class="mb-2 text-center text-2xl font-bold">{{ title }}</h2>
            <h2 class="text-center text-2xl font-bold">{{ length }}</h2>
        </div>

        <div class="px-1">
            <button
                class="bg-accent hover:bg-popover text-accent-foreground w-full rounded-xl px-4 py-3 shadow-accent shadow-2xl/20"
                @click="showForm = !showForm"
            >
                Добавить новую задачу
            </button>
        </div>

        <div v-if="showForm" class="px-1">
            <TaskForm @submit="handleTaskFormSubmit" />
        </div>

        <div class="grid grid-cols-1 gap-1 overflow-y-auto px-1">
            <Task
                v-for="task in tasks"
                :key="task.id"
                :task="task"
                @reorder-task="
                    (draggedId, targetId) =>
                        emit('reorder-task', draggedId, targetId)
                "
                @task-clicked="(task) => emit('task-clicked', task)"
            />
        </div>
    </div>
</template>
