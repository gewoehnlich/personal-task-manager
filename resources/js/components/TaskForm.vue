<script setup lang="ts">
import { ref } from 'vue'

const title       = ref('')
const description = ref('')
const deadline    = ref('')

const emit = defineEmits<{
  (e: 'submit', task: {
    title: string;
    description: string;
    deadline: string
  }): void
}>()

function submitForm() {
  emit('submit', {
    title: title.value,
    description: description.value,
    deadline: deadline.value,
  });

  title.value = '';
  description.value = '';
  deadline.value = '';
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
        type="text"
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
