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

const emit = defineEmits<{
    (e: 'task-drop', taskId: number, newStatus: string): void;
}>();

function handleDrop(event: DragEvent) {
    const taskId = parseInt(event.dataTransfer?.getData('task-id') || '', 10);
    if (!isNaN(taskId)) {
        emit('task-drop', taskId, props.title);
    }
}

</script>

<template>
    <div class="stage h-full flex flex-col gap-2" @dragover.prevent @drop="handleDrop">
        <div class="flex justify-between py-2 px-5 gap-5">
            <h2 class="text-2xl font-bold mb-2 text-center">{{ title }}</h2>
            <h2 class="font-bold text-2xl text-center">{{ length }}</h2>
        </div>

        <div class="grid grid-cols-1 gap-1 p-1 overflow-y-auto">
            <Task v-for="task in tasks" :key="task.id" :task="task" />
        </div>
    </div>
</template>

