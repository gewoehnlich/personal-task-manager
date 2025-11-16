<script setup lang="ts">
import { HTMLAttributes } from 'vue';
import { vElementStyling } from '@/directives/vElementStyling';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();

</script>

<template>
    <div
        :class="props.class"
        v-element-styling
    >
        <slot />
    </div>
</template>
