<script setup lang="ts">
import { computed } from 'vue';
import Stage from './Stage.vue';

const patternId = computed(() => `pattern-${Math.random().toString(36).substring(2, 9)}`);
</script>

<template>
    <div class="kanban h-full bg-sky-500 relative">
        <svg class="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" fill="none">
            <defs>
                <pattern :id="patternId" x="0" y="0" width="8" height="8" patternUnits="userSpaceOnUse">
                    <path d="M-1 5L5 -1M3 9L8.5 3.5" stroke-width="0.5"></path>
                </pattern>
            </defs>
            <rect stroke="none" :fill="`url(#${patternId})`" width="100%" height="100%"></rect>
        </svg>

        <div class="flex h-full gap-2 p-2">
            <div class="flex-auto rounded-xl border border-sidebar-border/70 dark:border-sidebar-border bg-sky-200">
                <Stage />
            </div>
            <div class="flex-auto rounded-xl border border-sidebar-border/70 dark:border-sidebar-border bg-sky-200">
                <Stage />
            </div>
            <div class="flex-auto rounded-xl border border-sidebar-border/70 dark:border-sidebar-border bg-sky-200">
                <Stage />
            </div>
        </div>
    </div>
</template>

