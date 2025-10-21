<script setup lang="ts">
import { ref } from 'vue'

const defaultDeadline = new Date()
defaultDeadline.setDate(defaultDeadline.getDate() + 7)

const title       = ref('')
const description = ref('')
const deadline = ref(formatDateForInput(defaultDeadline))

const emit = defineEmits<{
  (e: 'submit', task: {
    title:       string;
    description: string;
    deadline:    string;
  }): void
}>()

function submitForm() {
  emit('submit', {
    title:       title.value,
    description: description.value,
    deadline:    deadline.value.replace('T', ' ') + ':00',
  });

  title.value = '';
  description.value = '';
  deadline.value = '';
}

function formatDateForInput(date: Date): string {
  const pad = (n: number) => String(n).padStart(2, '0')
  const year = date.getFullYear()
  const month = pad(date.getMonth() + 1)
  const day = pad(date.getDate())
  const hours = pad(date.getHours())
  const minutes = pad(date.getMinutes())
  return `${year}-${month}-${day}T${hours}:${minutes}`
}
</script>

<template>
    <form
      @submit.prevent="submitForm"
      class="
        flex
        flex-col
        rounded-xl
        gap-2
        bg-popup
        p-4
        rounded
      "
    >
      <input
        v-model="title"
        type="text"
        placeholder="title"
        class="
          border
          p-2
          rounded
        "
        required
      />

      <textarea
        v-model="description"
        placeholder="description"
        class="
          border
          p-2
          rounded
        "
        required
      ></textarea>

      <input
        v-model="deadline"
        type="datetime-local"
        placeholder="deadline"
        class="
          border
          p-2
          rounded
        "
        required
      />

      <button
        type="submit"
        class="
          bg-green-500
          hover:bg-green-600
          text-white
          px-4
          py-2
          rounded
        "
      >
        save
      </button>
    </form>
</template>
