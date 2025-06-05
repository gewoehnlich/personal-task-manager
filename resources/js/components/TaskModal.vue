<script setup lang="ts">
import { reactive } from 'vue';
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

const props = defineProps<{
    task: Task
}>();

const emit = defineEmits<{
    (e: 'close'): void;
    (e: 'update', updatedTask: Task): void;
}>();

const editableTask = reactive({ ...props.task });

function saveChanges() {
    emit('update', { ...editableTask });
    emit('close');
}

</script>

<template>
  <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 px-4">
    <div class="bg-white dark:bg-card rounded-2xl shadow-xl border border-sidebar-border/70 dark:border-sidebar-border w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6 space-y-6">

      <header class="flex justify-between items-start">
        <div>
          <input
            v-model="editableTask.title"
            class="bg-transparent text-3xl font-bold mb-1 focus:outline-none focus:ring-2 focus:ring-primary px-1"
          />
          <p class="text-sm text-gray-500 dark:text-gray-400">
            Task ID: {{ task.id }} | User ID: {{ task.userId }}
          </p>
        </div>
        <button @click="$emit('close')" class="text-gray-500 hover:text-red-500 transition text-xl">&times;</button>
      </header>

      <section class="space-y-4">
        <div>
          <p class="text-sm text-gray-500 dark:text-gray-400">Description</p>
          <textarea
            v-model="editableTask.description"
            class="w-full bg-input dark:bg-muted text-gray-800 dark:text-gray-200 rounded-md p-2 mt-1 resize-none focus:outline-none focus:ring-2 focus:ring-primary"
            rows="4"
          ></textarea>
        </div>

        <div class="flex justify-between gap-4 flex-wrap">
          <div class="flex-1 min-w-[140px]">
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Status</p>
            <select
              v-model="editableTask.taskStatus"
              class="w-full bg-input dark:bg-muted rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary"
            >
              <option value="backlog">Backlog</option>
              <option value="inProgress">In Progress</option>
              <option value="overdue">Overdue</option>
              <option value="done">Done</option>
            </select>
          </div>

          <div class="flex-1 min-w-[140px]">
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Deadline</p>
            <input
              type="date"
              v-model="editableTask.deadline"
              class="w-full bg-input dark:bg-muted rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary"
            />
          </div>
        </div>
      </section>

      <section class="text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700 pt-4">
        <p>Created at: {{ task.created_at }}</p>
        <p>Updated at: {{ task.updated_at }}</p>
      </section>

      <footer class="flex justify-end gap-3 pt-6">
        <button
          @click="$emit('close')"
          class="px-4 py-2 bg-muted dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition"
        >
          Cancel
        </button>
        <button
          @click="saveChanges"
          class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition"
        >
          Save
        </button>
      </footer>
    </div>
  </div>
</template>
