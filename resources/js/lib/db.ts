import { openDB } from 'idb';

export const dbPromise = openDB('event-crud', 1, {
    upgrade(db) {
        db.createObjectStore('events', { keyPath: 'id', autoIncrement: true });
        db.createObjectStore('sync-queue', { keyPath: 'localId', autoIncrement: true });
    },
});

export async function saveEventOffline(event: any, action: any) {
    const db = await dbPromise;
    await db.add('sync-queue', { ...event, action, synced: false, timestamp: Date.now() });
}

export async function getQueuedEvents() {
    const db = await dbPromise;
    return db.getAll('sync-queue');
}

export async function removeQueuedEvent(localId: any) {
    const db = await dbPromise;
    await db.delete('sync-queue', localId);
}
