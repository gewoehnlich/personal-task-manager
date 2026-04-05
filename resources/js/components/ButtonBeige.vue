<script setup lang="ts">
import { Button } from '@/components/ui/button';
</script>

<template>
    <Button class="bg-accent/60 shadow-accent mt-4 w-full shadow-xl/30">
        <slot />
    </Button>
</template>
