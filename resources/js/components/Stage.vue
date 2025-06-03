<script setup lang="ts">
import { computed } from 'vue';
import Task from './Task.vue';

const props = defineProps<{
    title: string;
    tasks: Array<{
        id: number;
        userId: number;
        title: string;
        description?: string;
        taskStatus: string;
        deadline: string;
        updated_at: string;
        created_at: string;
    }>;
}>();

const length = computed(() => props.tasks.length);

</script>

<template>
    <div class="stage h-dvh overflow-hidden">
        <div class="relative flex flex-col gap-2">
            <div class="flex justify-between py-2 px-5">
                <h2 class="text-2xl font-bold mb-2 text-center">{{ title }}</h2>
                <h2 class="font-bold text-2xl text-center">{{ length }}</h2>
            </div>

            <div class="w-full p-1">
                <div class="grid grid-cols-1 gap-1">
                    <Task v-for="task in tasks" :key="task.id" :task="task" />
                </div>
            </div>
        </div>
    </div>
</template>

