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
        class="border-sidebar-border/70 dark:border-sidebar-border overflow-hidden rounded-xl min-w-[200px] max-w-2xs flex-grow flex-1"
    >
        <div
            id="stage"
            class="flex h-full flex-col gap-1"
            @dragover.prevent
            @drop="handleDrop"
        >
            <div class="bg-card flex justify-between items-center gap-5 px-4 py-2 rounded-xl">
                <h2 class="text-lg font-bold">{{ title }}</h2>
                <h2 class="text-lg font-bold">{{ length }}</h2>
            </div>

            <button
                class="bg-accent hover:bg-popover text-accent-foreground w-full rounded-xl min-h-11 flex items-center justify-center gap-2 border border-transparent hover:border-ring hover:shadow-lg/25 hover:shadow-ring text-xs flex-row leading-0"
                @click="showForm = !showForm"
            >
                <div class="flex gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <div class="leading-[1.3]">
                        ADD A NEW TASK
                    </div>
                </div>
            </button>

            <div v-if="showForm">
                <TaskForm @submit="handleTaskFormSubmit" />
            </div>

            <div
                id="tasks"
                class="overflow-y-auto flex flex-col gap-1 h-full"
            >
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
    </div>
</template>
