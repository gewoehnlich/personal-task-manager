<script setup lang="ts">
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Stage from './Stage.vue';

const page = usePage();
const tasks = computed(() => page.props.tasks);

const inProgressTasks = computed(() => tasks.value.filter(task => task.taskStatus === 'inProgress'));
const completedTasks = computed(() => tasks.value.filter(task => task.taskStatus === 'completed'));
const deadlineTasks = computed(() => tasks.value.filter(task => task.taskStatus === 'deadline'));
</script>

<template>
    <div class="kanban h-full relative">
        <div class="flex h-full gap-10">
            <div class="flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                <Stage title="inProgress" :tasks="inProgressTasks"/>
            </div>
            <div class="flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                <Stage title="completed" :tasks="completedTasks"/>
            </div>
            <div class="flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                <Stage title="deadline" :tasks="deadlineTasks"/>
            </div>
        </div>
    </div>
</template>

