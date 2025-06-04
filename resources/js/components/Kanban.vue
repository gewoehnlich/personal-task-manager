<script setup lang="ts">
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Stage from './Stage.vue';

const page = usePage();
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

</script>

<template>
    <div class="kanban grid grid-cols-4 h-full gap-10">
        <div class="overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
            <Stage title="backlog" :tasks="backlog" @task-drop="handleTaskDrop" @create-task="handleCreateTask"/>
        </div>
        <div class="overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
            <Stage title="inProgress" :tasks="inProgress" @task-drop="handleTaskDrop" @create-task="handleCreateTask"/>
        </div>
        <div class="overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
            <Stage title="overdue" :tasks="overdue" @task-drop="handleTaskDrop" @create-task="handleCreateTask"/>
        </div>
        <div class="overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
            <Stage title="done" :tasks="done" @task-drop="handleTaskDrop" @create-task="handleCreateTask"/>
        </div>
    </div>
</template>

