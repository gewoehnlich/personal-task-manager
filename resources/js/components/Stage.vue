<script setup lang="ts">
import { TaskType } from '@/types/task';
import { computed, ref } from 'vue';
import ButtonBlack from './ButtonBlack.vue';
import StageHeader from './StageHeader.vue';
import Task from './Task.vue';
import TaskCreate from './TaskCreate.vue';

const props = defineProps<{
    stage: string;
    tasks: TaskType[];
}>();

const emit = defineEmits<{
    (e: 'create-task', task: Omit<TaskType, 'uuid'>): void;
    (e: 'reorder-task', draggedUuid: string, targetUuid: string): void;
    (e: 'task-clicked', task: TaskType): void;
}>();

const showForm = ref(false);
const length = computed(() => props.tasks.length);

function handleDrop(event: DragEvent) {
    const draggedTaskUuid: string = String(event.dataTransfer?.getData('task-uuid'));

    handleReorderTask(draggedTaskUuid, props.stage);
}

function handleTaskFormSubmit(task: {
    title: string;
    stage: string;
    description: string;
    deadline: string;
}): void {
    emit('create-task', task);

    showForm.value = false;
}

function handleReorderTask(draggedTaskUuid: string, stage: string): void {
    emit('reorder-task', draggedTaskUuid, stage);
}

function handleTaskClick(task: TaskType): void {
    emit('task-clicked', task);
}
</script>

<template>
    <div
        class="border-sidebar-border/70 dark:border-sidebar-border max-w-[296px] min-w-[245px] flex-1 flex-grow overflow-hidden rounded-xl"
        @drop="handleDrop"
    >
        <div
            id="stage"
            class="flex h-full flex-col gap-1"
            @dragover.prevent
            @drop="handleDrop"
        >
            <StageHeader
                :stage="stage"
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
                    @reorder-task="handleReorderTask"
                    @task-clicked="handleTaskClick"
                />
            </div>
        </div>
    </div>
</template>
