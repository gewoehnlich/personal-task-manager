<script setup lang="ts">
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Stage from './Stage.vue';

const page = usePage();
const tasks = computed(() => page.props.tasks);

const inProgressTasks = computed(() => tasks.value.filter(task => task.taskStatus === 'inProgress'));
const completedTasks = computed(() => tasks.value.filter(task => task.taskStatus === 'completed'));
const deadlineTasks = computed(() => tasks.value.filter(task => task.taskStatus === 'deadline'));

function handleTaskDrop(taskId: number, newStatus: string) {
    const task = tasks.value.find(t => t.id === taskId);
    if (task) {
        task.taskStatus = newStatus;
    }
}

</script>

<template>
    <div class="kanban grid grid-cols-3 h-full gap-10">
        <div class="overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
            <Stage title="inProgress" :tasks="inProgressTasks" @task-drop="handleTaskDrop"/>
        </div>
        <div class="overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
            <Stage title="completed" :tasks="completedTasks" @task-drop="handleTaskDrop"/>
        </div>
        <div class="overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
            <Stage title="deadline" :tasks="deadlineTasks" @task-drop="handleTaskDrop"/>
        </div>
    </div>
</template>

