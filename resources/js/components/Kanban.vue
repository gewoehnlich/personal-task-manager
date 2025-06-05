<script setup lang="ts">
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Stage from './Stage.vue';
import TaskModal from './TaskModal.vue';

const page = usePage();
const selectedTask = ref<Task | null>(null);

const tasks = computed(() => page.props.tasks);
const backlog = computed(() => tasks.value.filter(task => task.taskStatus === 'backlog'));
const inProgress = computed(() => tasks.value.filter(task => task.taskStatus === 'inProgress'));
const overdue = computed(() => tasks.value.filter(task => task.taskStatus === 'overdue'));
const done = computed(() => tasks.value.filter(task => task.taskStatus === 'done'));

function handleTaskDrop(taskId: number, newStatus: string) {
    const task = tasks.value.find(t => t.id === taskId);
    if (task) {
        task.taskStatus = newStatus;
    }
}

function handleCreateTask(newTask) {
    const id = Math.max(...tasks.value.map(t => t.id) + 1);
    tasks.value.push({ id, ...newTask });
}

function handleTaskReorder(draggedId: number, targetId: number) {
    const indexFrom = tasks.value.findIndex(t => t.id === draggedId);
    const indexTo = tasks.value.findIndex(t => t.id === targetId);

    if (indexFrom === -1 || indexTo === -1) return;

    const [moved] = tasks.value.splice(indexFrom, 1);
    tasks.value.splice(indexTo, 0, moved);
}

function openTaskModal(task: Task) {
    console.log(123);
    selectedTask.value = task;
}

function closeTaskModal() {
    selectedTask.value = null;
}

</script>

<template>
    <div class="kanban grid grid-cols-4 h-full gap-2">
        <div class="overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
            <Stage
                title="backlog"
                :tasks="backlog"
                @task-drop="handleTaskDrop"
                @create-task="handleCreateTask"
                @reorder-task="handleTaskReorder"
                @task-clicked="openTaskModal"
            />
        </div>
        <div class="overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
            <Stage
                title="inProgress"
                :tasks="inProgress"
                @task-drop="handleTaskDrop"
                @create-task="handleCreateTask"
                @reorder-task="handleTaskReorder"
                @task-clicked="openTaskModal"
            />
        </div>
        <div class="overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
            <Stage
                title="overdue"
                :tasks="overdue"
                @task-drop="handleTaskDrop"
                @create-task="handleCreateTask"
                @reorder-task="handleTaskReorder"
                @task-clicked="openTaskModal"
            />
        </div>
        <div class="overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
            <Stage
                title="done"
                :tasks="done"
                @task-drop="handleTaskDrop"
                @create-task="handleCreateTask"
                @reorder-task="handleTaskReorder"
                @task-clicked="openTaskModal"
            />
        </div>
    </div>

    <TaskModal v-if="selectedTask" :task="selectedTask" @close="closeTaskModal" />
</template>

