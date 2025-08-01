<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

import EventForm from './EventForm.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Event Management',
        href: '/events',
    },
    {
        title: 'Create Event',
        href: '/events/create',
    },
];
</script>

<template>

    <Head title="Create Event" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <EventForm submit-label="Create Event" />
        </div>
    </AppLayout>
</template>
