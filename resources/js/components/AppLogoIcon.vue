<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 42" :class="className" v-bind="$attrs">
        <!-- Calendar base -->
        <rect x="4" y="10" width="32" height="26" rx="3" fill="currentColor" fill-opacity="0.12"/>
        <rect x="4" y="10" width="32" height="26" rx="3" stroke="currentColor" stroke-width="2" fill="none"/>
        <!-- Calendar rings -->
        <rect x="10" y="4" width="4" height="8" rx="2" fill="currentColor"/>
        <rect x="26" y="4" width="4" height="8" rx="2" fill="currentColor"/>
        <!-- Bell icon (reminder) -->
        <path
            d="M20 22c3.5 0 6-2.5 6-6v-2c0-3-2.5-6-6-6s-6 3-6 6v2c0 3.5 2.5 6 6 6Zm0 2c-2.5 0-4 1.5-4 2v1h8v-1c0-0.5-1.5-2-4-2Z"
            fill="currentColor"
            fill-rule="evenodd"
            clip-rule="evenodd"
        />
        <!-- Notification dot -->
        <circle cx="30" cy="14" r="2" fill="currentColor"/>
    </svg>
</template>
