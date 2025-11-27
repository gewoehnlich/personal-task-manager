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

const pending = filterTasksByStage(tasks, "pending");
const active  = filterTasksByStage(tasks, "active");
const done    = filterTasksByStage(tasks, "done");
const deleted = filterTasksByStage(tasks, "deleted");

function filterTasksByStage(
    tasks: Ref<TaskType[]>,
    stage: string,
) {
    return tasks.value.filter(
        (task) => task.stage === stage
    );
}

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
    <div id="kanban" class="flex h-full gap-2">
        <Stage
            title="PENDING"
            :tasks="pending"
            @task-drop="handleTaskDrop"
            @create-task="handleCreateTask"
            @reorder-task="handleTaskReorder"
            @task-clicked="openTaskModal"
        />
        <Stage
            title="ACTIVE"
            :tasks="active"
            @task-drop="handleTaskDrop"
            @create-task="handleCreateTask"
            @reorder-task="handleTaskReorder"
            @task-clicked="openTaskModal"
        />
        <Stage
            title="DONE"
            :tasks="done"
            @task-drop="handleTaskDrop"
            @create-task="handleCreateTask"
            @reorder-task="handleTaskReorder"
            @task-clicked="openTaskModal"
        />
        <Stage
            title="DELETED"
            :tasks="deleted"
            @task-drop="handleTaskDrop"
            @create-task="handleCreateTask"
            @reorder-task="handleTaskReorder"
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
