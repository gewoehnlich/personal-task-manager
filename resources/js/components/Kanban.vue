<script setup lang="ts">
import type { TaskType } from '@/types/task';
import { router, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import Stage from './Stage.vue';
import TaskModal from './TaskModal.vue';

type PageProps = {
    tasks: {
        all: TaskType[];
        pending: TaskType[];
        active: TaskType[];
        delayed: TaskType[];
        done: TaskType[];
        deleted: TaskType[];
    };
};

const page = usePage<PageProps>();
const selectedTask = ref<TaskType | null>(null);

const tasks = computed(() => page.props.tasks.all || []);
const pending = computed(() => page.props.tasks.pending || []);
const active = computed(() => page.props.tasks.active || []);
const delayed = computed(() => page.props.tasks.delayed || []);
const done = computed(() => page.props.tasks.done || []);
const deleted = computed(() => page.props.tasks.deleted || []);

function handleTaskDrop(taskId: number, newStage: string) {
    const task = tasks.value.find((task) => task.id === taskId);

    if (task) {
        task.stage = newStage;
        router.put(`/tasks/${task.id}`, task);
    }
}

function handleCreateTask(task: Omit<TaskType, 'id'>): void {
    router.post('/tasks', task);
}

function handleTaskReorder(draggedId: number, targetId: number) {
    const draggedTask = tasks.value.find((task) => task.id === draggedId);

    const targetTask = tasks.value.find((task) => task.id === targetId);

    if (!draggedTask || !targetTask) return;

    draggedTask.stage = targetTask.stage;
    router.put(`/tasks/${draggedTask.id}`, draggedTask);
}

function openTaskModal(task: TaskType) {
    selectedTask.value = task;
}

function closeTaskModal() {
    selectedTask.value = null;
}

function handleUpdateTask(task: Omit<TaskType, 'id'>): void {
    router.put(`/tasks/${task.id}`, task);
}

function handleDeleteTask(task: Omit<TaskType, 'id'>): void {
    router.delete(`/tasks/${task.id}`);
}
</script>

<template>
    <div id="kanban" class="grid h-full grid-cols-5 gap-4">
        <div
            class="border-sidebar-border/70 dark:border-sidebar-border overflow-hidden rounded-xl"
        >
            <Stage
                title="pending"
                :tasks="pending"
                @task-drop="handleTaskDrop"
                @create-task="handleCreateTask"
                @reorder-task="handleTaskReorder"
                @task-clicked="openTaskModal"
            />
        </div>

        <div
            class="border-sidebar-border/70 dark:border-sidebar-border overflow-hidden rounded-xl"
        >
            <Stage
                title="active"
                :tasks="active"
                @task-drop="handleTaskDrop"
                @create-task="handleCreateTask"
                @reorder-task="handleTaskReorder"
                @task-clicked="openTaskModal"
            />
        </div>

        <div
            class="border-sidebar-border/70 dark:border-sidebar-border overflow-hidden rounded-xl"
        >
            <Stage
                title="delayed"
                :tasks="delayed"
                @task-drop="handleTaskDrop"
                @create-task="handleCreateTask"
                @reorder-task="handleTaskReorder"
                @task-clicked="openTaskModal"
            />
        </div>

        <div
            class="border-sidebar-border/70 dark:border-sidebar-border overflow-hidden rounded-xl"
        >
            <Stage
                title="done"
                :tasks="done"
                @task-drop="handleTaskDrop"
                @create-task="handleCreateTask"
                @reorder-task="handleTaskReorder"
                @task-clicked="openTaskModal"
            />
        </div>

        <div
            class="border-sidebar-border/70 dark:border-sidebar-border overflow-hidden rounded-xl"
        >
            <Stage
                title="deleted"
                :tasks="deleted"
                @task-drop="handleTaskDrop"
                @create-task="handleCreateTask"
                @reorder-task="handleTaskReorder"
                @task-clicked="openTaskModal"
            />
        </div>
    </div>

    <TaskModal
        v-if="selectedTask"
        :task="selectedTask"
        @close="closeTaskModal"
        @delete="handleDeleteTask"
        @update="handleUpdateTask"
    />
</template>
