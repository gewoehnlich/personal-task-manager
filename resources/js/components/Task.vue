<script setup lang="ts">
import { computed } from 'vue';
import Task from './Task.vue';

const props = defineProps<{
    task: {
        id: number;
        userId: number;
        title: string;
        description?: string;
        taskStatus: string;
        deadline: string;
        updated_at: string;
        created_at: string;
    };
}>();

</script>

<template>
    <div class="task w-full break-words rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-4">
        <h2 class="font-bold text-2xl">{{ task.title }}</h2>
        <div class="my-1 h-px w-full bg-gradient-to-r from-transparent via-gray-400 to-transparent dark:via-gray-600"></div>
        <p class="text-md text-gray-700 dark:text-gray-300">{{ task.description }}</p>
    </div>
</template>


