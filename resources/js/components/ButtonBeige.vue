<script setup lang="ts">
import { Button } from '@/components/ui/button';
</script>

<template>
    <Button
        class="bg-accent/60 mt-4 w-full shadow-accent shadow-xl/30"
    >
        <slot />
    </Button>
</template>
