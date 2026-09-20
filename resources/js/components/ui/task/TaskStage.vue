<script setup lang="ts">
const stage = defineModel<string | null>('stage');

</script>

<template>
    <select
        v-model="stage"
        class="bg-muted focus:ring-none h-8 w-full rounded-lg p-1.5 text-sm focus:outline-none"
    >
        <option value="pending">Pending</option>
        <option value="active">Active</option>
        <option value="delayed">Delayed</option>
        <option value="done">Done</option>
    </select>
</template>
