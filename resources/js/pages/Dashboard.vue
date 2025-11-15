<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import Kanban from '../components/Kanban.vue';
</script>

<template>
    <Head title="PTM" />

    <AppLayout>
        <div class="bg-background h-full pt-8 px-15">
            <Kanban />
        </div>
    </AppLayout>
</template>
