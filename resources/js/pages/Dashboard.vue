<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import Kanban from '../components/Kanban.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'tasks',
        href: '/dashboard',
    },
];
</script>

<template>
    <Head title="personaltaskmanager" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-dvh flex-1 flex-col rounded-xl p-15">
            <Kanban />
        </div>
    </AppLayout>
</template>
