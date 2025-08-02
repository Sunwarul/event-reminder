import { getQueuedEvents, removeQueuedEvent } from './db';

export async function syncQueuedEvents() {
  const queue = await getQueuedEvents();
  for (const item of queue) {
    try {
      let response;
      if (item.action === 'create') {
        response = await fetch('/events', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(item),
        });
      } else if (item.action === 'update') {
        response = await fetch(`/events/${item.id}`, {
          method: 'PUT',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(item),
        });
      } else if (item.action === 'delete') {
        response = await fetch(`/events/${item.id}`, {
          method: 'DELETE',
        });
      }
      if (response && response.ok) {
        await removeQueuedEvent(item.localId);
      }
    } catch (e) {
      // Optionally handle sync error
    }
  }
}
