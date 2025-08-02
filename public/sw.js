self.addEventListener('install', event => {
  self.skipWaiting();
  event.waitUntil(
    caches.open('event-cache-v1').then(cache => cache.addAll([
      '/',
      '/events',
      // Add other static assets as needed
    ]))
  );
});

self.addEventListener('fetch', event => {
  if (event.request.method !== 'GET') return;
  event.respondWith(
    caches.match(event.request).then(response => response || fetch(event.request))
  );
});
