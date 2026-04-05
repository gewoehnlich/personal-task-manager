<script setup lang="ts">
import { TaskType } from '@/types/task';
import { computed, ref } from 'vue';
import ButtonBlack from './ButtonBlack.vue';
import StageHeader from './StageHeader.vue';
import Task from './Task.vue';
import TaskCreate from './TaskCreate.vue';

const props = defineProps<{
    title: string;
    tasks: Array<TaskType>;
}>();

const emit = defineEmits<{
    (e: 'task-drop', taskUuid: string, stage: string): void;
    (e: 'create-task', task: Omit<TaskType, 'uuid'>): void;
    (e: 'reorder-task', draggedUuid: string, targetUuid: string): void;
    (e: 'task-clicked', task: TaskType): void;
}>();

const showForm = ref(false);
const length = computed(() => props.tasks.length);

function handleDrop(event: DragEvent) {
    const taskUuid: string = String(event.dataTransfer?.getData('task-id'));

    emit('task-drop', taskUuid, props.title);
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

function handleReorderTasks(draggedUuid: string, targetUuid: string): void {
    emit('reorder-task', draggedUuid, targetUuid);
}

function handleTaskClick(task: TaskType): void {
    emit('task-clicked', task);
}
</script>

<template>
    <div
        class="border-sidebar-border/70 dark:border-sidebar-border max-w-[296px] min-w-[245px] flex-1 flex-grow overflow-hidden rounded-xl"
    >
        <div
            id="stage"
            class="flex h-full flex-col gap-1"
            @dragover.prevent
            @drop="handleDrop"
        >
            <StageHeader
                :title="title"
                :length="length"
            />

            <ButtonBlack @click="showForm = !showForm">
                ADD A NEW TASK
            </ButtonBlack>

            <TaskCreate
                v-if="showForm"
                @submit="handleTaskFormSubmit"
            />

            <div
                id="tasks"
                class="flex h-full flex-col gap-1 overflow-y-auto"
            >
                <Task
                    v-for="task in tasks"
                    :key="task.uuid"
                    :task="task"
                    @reorder-task="handleReorderTasks"
                    @task-clicked="handleTaskClick"
                />
            </div>
        </div>
    </div>
</template>
