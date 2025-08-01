<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import Button from '@/components/ui/button/Button.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Event Management',
        href: '/events',
    },
    {
        title: 'Events List',
        href: '/events',
    },
];

const { events } = defineProps({
    events: {
        type: Object,
        default: () => [],
    },
});


</script>

<template>

    <!-- <Head title="Event Management" /> -->

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold mb-4">Events List</h1>
                <Button>
                    <Link href="/events/create" class="">Create Event</Link>
                </Button>
            </div>
            <div>
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Event ID</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Start Time</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">End Time</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Assuming events is passed as a prop -->
                        <tr v-for="event in events.data" :key="event.id">
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ event.event_id }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ event.name }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ event.start_time }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ event.end_time }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ event.status }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <Link :href="'/events/' + event.id" class="text-blue-600 hover:text-blue-900">View</Link>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot></tfoot>
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-no-wrap border-t border-gray-200">
                                <div class="flex justify-between">
                                    <span>Total Events: {{ events.total }}</span>
                                    <span>
                                        <Link :href="events.prev_page_url" class="text-blue-600 hover:text-blue-900" v-if="events.prev_page_url">Previous</Link>
                                        <Link :href="events.next_page_url" class="text-blue-600 hover:text-blue-900" v-if="events.next_page_url">Next</Link>
                                    </span>
                                    <span>
                                        Showing {{ events.from }} to {{ events.to }} of {{ events.total }} entries
                                    </span>
                                    <span>Page: {{ events.current_page }} of {{ events.last_page }}</span>
                                </div>
                            </td>
                        </tr>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
