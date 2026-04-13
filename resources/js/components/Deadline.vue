<script setup lang="ts">
import { computed } from 'vue';
import DateField from './ui/datetime/DateField.vue';
import TimeField from './ui/datetime/TimeField.vue';

const props = defineProps<{
  modelValue: Date | null;
}>();

const emit = defineEmits<{
  (e: 'update:modelValue', value: Date | null): void;
}>();

const deadline = computed({
  get: () => props.modelValue,
  set: (val) => emit('update:modelValue', val),
});

function updateDate(newDate: Date) {
  const current = deadline.value ?? new Date();

  newDate.setHours(current.getHours());
  newDate.setMinutes(current.getMinutes());

  deadline.value = newDate;
}

function updateTime(newTime: Date) {
  const current = deadline.value ?? new Date();

  current.setHours(newTime.getHours());
  current.setMinutes(newTime.getMinutes());

  deadline.value = new Date(current);
}

</script>

<template>
    <div class="flex-col-2 flex w-full gap-1">
        <DateField v-model="deadline" />
        <TimeField v-model="deadline" />
    </div>
</template>
