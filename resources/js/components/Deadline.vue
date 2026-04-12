<script setup lang="ts">
import DateField from './ui/datetime/DateField.vue';
import TimeField from './ui/datetime/TimeField.vue';
</script>

const props = defineProps<{
    deadline: Date;
}>();

<template>
    <div class="flex-col-2 flex w-full gap-1">
        <DateField v-model="deadline"/>
        <TimeField />
    </div>
</template>
