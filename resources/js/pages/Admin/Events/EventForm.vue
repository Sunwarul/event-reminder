<script setup lang="ts">
import { ref, computed } from 'vue';
import Input from '@/components/ui/input/Input.vue';
import Button from '@/components/ui/button/Button.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';

const props = defineProps({
  event: {
    type: Object,
    default: () => ({}),
  },
  submitLabel: {
    type: String,
    default: 'Save',
  },
});

const form = useForm({
  event_id: props.event.event_id || '',
  name: props.event.name || '',
  start_time: props.event.start_time || '',
  end_time: props.event.end_time || '',
  description: props.event.description || '',
  location: props.event.location || '',
  organizer: props.event.organizer || '',
  type: props.event.type || '',
  url: props.event.url || '',
  image: props.event.image || '',
  created_by: props.event.created_by || '',
  status: props.event.status || 'scheduled',
});

const eventTypes = [
  { value: 'conference', label: 'Conference' },
  { value: 'webinar', label: 'Webinar' },
  { value: 'meeting', label: 'Meeting' },
  { value: 'workshop', label: 'Workshop' },
  { value: 'seminar', label: 'Seminar' },
  { value: 'other', label: 'Other' },
];
const eventStatuses = [
  { value: 'scheduled', label: 'Scheduled' },
  { value: 'ongoing', label: 'Ongoing' },
  { value: 'complete', label: 'Complete' },
];

function submit() {
  form.post(props.event.id ? `/events/${props.event.id}` : '/events', {
    method: props.event.id ? 'put' : 'post',
    preserveScroll: true,
  });
}
</script>

<template>
  <form @submit.prevent="submit" class="space-y-4 max-w-xl mx-auto">
    <div>
      <label class="block mb-1 font-medium">Event ID</label>
      <Input v-model="form.event_id" />
      <InputError :message="form.errors.event_id" />
    </div>
    <div>
      <label class="block mb-1 font-medium">Name</label>
      <Input v-model="form.name" />
      <InputError :message="form.errors.name" />
    </div>
    <div class="flex gap-2">
      <div class="flex-1">
        <label class="block mb-1 font-medium">Start Time</label>
        <Input v-model="form.start_time" type="datetime-local" />
        <InputError :message="form.errors.start_time" />
      </div>
      <div class="flex-1">
        <label class="block mb-1 font-medium">End Time</label>
        <Input v-model="form.end_time" type="datetime-local" />
        <InputError :message="form.errors.end_time" />
      </div>
    </div>
    <div>
      <label class="block mb-1 font-medium">Description</label>
      <textarea v-model="form.description" class="w-full rounded border px-3 py-2" rows="3"></textarea>
      <InputError :message="form.errors.description" />
    </div>
    <div>
      <label class="block mb-1 font-medium">Location</label>
      <Input v-model="form.location" />
      <InputError :message="form.errors.location" />
    </div>
    <div>
      <label class="block mb-1 font-medium">Organizer</label>
      <Input v-model="form.organizer" />
      <InputError :message="form.errors.organizer" />
    </div>
    <div>
      <label class="block mb-1 font-medium">Type</label>
      <select v-model="form.type" class="w-full rounded border px-3 py-2">
        <option value="">Select type</option>
        <option v-for="type in eventTypes" :key="type.value" :value="type.value">{{ type.label }}</option>
      </select>
      <InputError :message="form.errors.type" />
    </div>
    <div>
      <label class="block mb-1 font-medium">URL</label>
      <Input v-model="form.url" />
      <InputError :message="form.errors.url" />
    </div>
    <div>
      <label class="block mb-1 font-medium">Image</label>
      <Input v-model="form.image" />
      <InputError :message="form.errors.image" />
    </div>
    <div>
      <label class="block mb-1 font-medium">Created By</label>
      <Input v-model="form.created_by" />
      <InputError :message="form.errors.created_by" />
    </div>
    <div>
      <label class="block mb-1 font-medium">Status</label>
      <select v-model="form.status" class="w-full rounded border px-3 py-2">
        <option v-for="status in eventStatuses" :key="status.value" :value="status.value">{{ status.label }}</option>
      </select>
      <InputError :message="form.errors.status" />
    </div>
    <div class="pt-2">
      <Button :disabled="form.processing" type="submit" class="w-full">{{ submitLabel }}</Button>
    </div>
  </form>
</template>
