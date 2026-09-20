<script setup lang="ts">
const props = defineProps<{
    label: string;
}>();
</script>

<template>
    <p class="text-muted-foreground text-xs mb-1">
        {{ props.label }}
    </p>
</template>
