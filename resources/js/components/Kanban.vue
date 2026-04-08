<script setup lang="ts">
import type { TaskType } from '@/types/task';
import { router, usePage } from '@inertiajs/vue3';
import { computed, Ref, ref } from 'vue';
import Stage from './Stage.vue';
import TaskEdit from './TaskEdit.vue';

type PageProps = {
    tasks: TaskType[];
};

const page = usePage<PageProps>();
const selectedTask = ref<TaskType | null>(null);

const tasks = computed(() => page.props.tasks || []);

const pending = computed(() => filterTasksByStage(tasks, 'pending'));
const active = computed(() => filterTasksByStage(tasks, 'active'));
const done = computed(() => filterTasksByStage(tasks, 'done'));
const deleted = computed(() => filterTasksByStage(tasks, 'deleted'));

function filterTasksByStage(tasks: Ref<TaskType[]>, stage: string) {
    return tasks.value.filter((task) => task.stage === stage);
}

function handleTaskDrop(taskUuid: string, stage: string): void {
    const task: TaskType = tasks.value.find((task) => task.uuid === taskUuid);

    if (task) {
        task.stage = stage;

        router.put(`/tasks/${task.uuid}`, task);
    }
}

function handleCreateTask(task: Omit<TaskType, 'uuid'>): void {
    router.post('/tasks', task);
}

function handleUpdateTask(task: Omit<TaskType, 'uuid'>): void {
    router.put(`/tasks/${task.uuid}`, task);
}

function handleDeleteTask(task: Omit<TaskType, 'uuid'>): void {
    router.delete(`/tasks/${task.uuid}`);
}

function handleReorderTask(draggedTaskUuid: string, stage: string): void {
    const task: TaskType = tasks.value.find(
        (task: TaskType) => task.uuid === draggedTaskUuid
    );

    if (task.stage === stage) {
        return;
    }

    task.stage = stage;

    router.put(`/tasks/${task.uuid}`, task);
}

function openTaskModal(task: TaskType): void {
    selectedTask.value = task;
}

function closeTaskModal(): void {
    selectedTask.value = null;
}
</script>

<template>
    <div
        id="kanban"
        class="flex h-full gap-2"
    >
        <Stage
            stage="pending"
            :tasks="pending"
            @task-drop="handleTaskDrop"
            @create-task="handleCreateTask"
            @reorder-task="handleReorderTask"
            @task-clicked="openTaskModal"
        />
        <Stage
            stage="active"
            :tasks="active"
            @task-drop="handleTaskDrop"
            @create-task="handleCreateTask"
            @reorder-task="handleReorderTask"
            @task-clicked="openTaskModal"
        />
        <Stage
            stage="done"
            :tasks="done"
            @task-drop="handleTaskDrop"
            @create-task="handleCreateTask"
            @reorder-task="handleReorderTask"
            @task-clicked="openTaskModal"
        />
        <Stage
            stage="deleted"
            :tasks="deleted"
            @task-drop="handleTaskDrop"
            @create-task="handleCreateTask"
            @reorder-task="handleReorderTask"
            @task-clicked="openTaskModal"
        />
    </div>

    <TaskEdit
        v-if="selectedTask"
        :task="selectedTask"
        @close="closeTaskModal"
        @delete="handleDeleteTask"
        @update="handleUpdateTask"
    />
</template>
