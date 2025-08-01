<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import Button from '@/components/ui/button/Button.vue';

const { event } = defineProps({
    event: {
        type: Object,
        default: () => ({}),
    },
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Event Management',
        href: '/events',
    },
    {
        title: 'Event Detail',
        href: '/events/' + (event ? event.id : 'new'),
    },
];
</script>

<template>

    <!-- <Head title="Event Management" /> -->

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="gap-4 gap-y-4 rounded-xl p-4 overflow-x-auto">
            <h1 class="text-2xl font-bold">Event Name: {{ event.name }}</h1>
            <p class="text-gray-500">Event ID: {{ event.event_id }}</p>
            <p class="text-gray-500">Created By: {{ event?.user?.name }}</p>
            <p class="text-gray-500">Created At: {{ event.created_at }}</p>
            <p class="text-gray-500">Start Time: {{ event.start_time }}</p>
            <p class="text-gray-500">End Time: {{ event.end_time }}</p>
            <p class="text-gray-500">Location: {{ event.location }}</p>
            <p class="text-gray-500">Organizer: {{ event.organizer }}</p>
            <p class="text-gray-500">Type: {{ event.type }}</p>
            <p class="text-gray-500">URL:
                <a :href="event.url" class="text-blue-500 hover:underline">{{ event.url }}</a>
            </p>
            <p class="text-gray-500">Status: {{ event.status }}</p>

            <div class="py-3">
                <img v-if="event.image" :src="`/storage/${event.image}`" alt="Event Image"
                    class="w-full h-auto rounded-lg shadow-md mb-4">
                <p v-else class="text-gray-500">No image available</p>
            </div>
            <div class="py-3">
                <p class="text-gray-500">{{ event.description }}</p>
            </div>
            <Button class="mt-4">
                <Link href="/events" class="">Back to Events</Link>
            </Button>
        </div>
    </AppLayout>
</template>
