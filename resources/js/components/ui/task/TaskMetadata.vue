<script setup lang="ts">
const props = defineProps<{
    created_at: string;
    updated_at: string;
    task_uuid: string;
    user_uuid: string;
}>();
</script>

<template>
    <div class="text-muted-foreground text-xs">
        <p>Created at: {{ props.created_at }}</p>
        <p>Updated at: {{ props.updated_at }}</p>

        <div class="py-1"></div>

        <p>Task UUID: {{ props.task_uuid }}</p>
        <p>User UUID: {{ props.user_uuid }}</p>
    </div>
</template>
