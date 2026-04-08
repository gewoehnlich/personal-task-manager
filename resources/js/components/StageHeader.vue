<script setup lang="ts">
import Card from './ui/card/Card.vue';

const props = defineProps<{
    stage: string;
    length: number;
}>();
</script>

<template>
    <Card class="flex items-center justify-between gap-5 px-4 py-2">
        <h2 class="text-lg font-bold">{{ props.stage.toUpperCase() }}</h2>
        <h2 class="text-lg font-bold">{{ props.length }}</h2>
    </Card>
</template>
