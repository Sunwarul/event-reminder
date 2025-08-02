<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Welcome" />
    <div class="container mx-auto px-4 py-8 w-1/2 border rounded-lg shadow-lg h-100 mt-10 flex items-center justify-center">
        <div>
            <h1 class="text-3xl font-bold mb-4">Welcome to Event Reminder</h1>
            <p class="mb-4">This is a simple event reminder application built with Laravel and Vue.js.</p>
            <p class="mb-4">You can manage your events and receive reminders for upcoming events.</p>
            <Link href="/events" class="text-blue-500 hover:underline">
                Login
            </Link>
        </div>
    </div>
</template>
