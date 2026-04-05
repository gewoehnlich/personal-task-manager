<script setup lang="ts">
import { vBorderAtHover } from '@/directives/vBorderAtHover';
import { vElementStyling } from '@/directives/vElementStyling';
import { vShadowAtHover } from '@/directives/vShadowAtHover';
import Button from './ui/button/Button.vue';
</script>
<template>
    <Button
        class="flex min-h-11 flex-row items-center justify-center gap-2 text-xs leading-0"
        v-border-at-hover
        v-shadow-at-hover
        v-element-styling
        variant="kanban"
    >
        <div class="flex gap-1">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                class="h-4 w-4"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 4.5v15m7.5-7.5h-15"
                />
            </svg>
            <div class="leading-[1.3]">
                <slot />
            </div>
        </div>
    </Button>
</template>
