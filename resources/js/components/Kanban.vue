<script setup lang="ts">
import type { Task } from '@/types/task';
import { router, usePage } from '@inertiajs/vue3';
import { computed, Ref, ref } from 'vue';
import Stage from './Stage.vue';
import TaskEdit from './TaskEdit.vue';

type PageProps = {
    tasks: Task[];
};

const page = usePage<PageProps>();
const selectedTask = ref<Task | null>(null);

const tasks = computed(() => page.props.tasks || []);

const pending = computed(() => filterTasksByStage(tasks, 'pending'));
const active = computed(() => filterTasksByStage(tasks, 'active'));
const done = computed(() => filterTasksByStage(tasks, 'done'));
const deleted = computed(() => filterTasksByStage(tasks, 'deleted'));

function filterTasksByStage(tasks: Ref<Task[]>, stage: string): Task[] {
    return tasks.value.filter((task: Task) => task.stage === stage);
}

function handleTaskDrop(taskUuid: string, stage: string): void {
    const task = tasks.value.find((task: Task) => task.uuid === taskUuid);

    if (task) {
        task.stage = stage;

        router.put(`/tasks/${task.uuid}`, task);
    }
}

function handleCreateTask(title: string, description: string | null, stage: string): void {
    router.post('/tasks', {
        title: title,
        description: description,
        stage: stage,
    });
}

function handleUpdateTask(task: Task): void {
    router.put(`/tasks/${task.uuid}`, task);
}

function handleDeleteTask(task: Task): void {
    router.delete(`/tasks/${task.uuid}`);
}

function handleReorderTask(taskUuid: string, stage: string): void {
    const task = tasks.value.find((task: Task) => task.uuid === taskUuid);

    if (task && task.stage !== stage) {
        task.stage = stage;

        router.put(`/tasks/${task.uuid}`, task);
    }
}

function openTaskModal(task: Task): void {
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
