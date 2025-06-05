<script setup lang="ts">

    interface Task {
        id: number;
        userId: number;
        title: string;
        description?: string;
        taskStatus: string;
        deadline: string;
        updated_at: string;
        created_at: string;
    }

    defineProps<{ task: Task }>();

    defineEmits(['close']);

</script>

<template>
  <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 p-4 rounded shadow max-w-md w-full">
      <h2 class="text-xl font-bold mb-2">{{ task.title }}</h2>
      <p class="mb-4">{{ task.description }}</p>
      <p class="text-sm text-gray-500">Deadline: {{ task.deadline }}</p>
      <button @click="$emit('close')" class="mt-4 px-4 py-2 bg-red-500 text-white rounded">Close</button>
    </div>
  </div>
</template>

