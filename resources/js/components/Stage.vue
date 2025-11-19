<script setup lang="ts">
import { TaskType } from '@/types/task';
import { computed, ref } from 'vue';
import Task from './Task.vue';
import TaskCreate from './TaskCreate.vue';
import ButtonBlack from './ButtonBlack.vue';
import StageHeader from './StageHeader.vue';

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
            <StageHeader :title="title" :length="length" />

            <ButtonBlack @click="showForm = !showForm">
                ADD A NEW TASK
            </ButtonBlack>

            <TaskCreate v-if="showForm" @submit="handleTaskFormSubmit" />

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
