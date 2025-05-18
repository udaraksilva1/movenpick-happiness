
self.addEventListener('install', function(e) {
  e.waitUntil(
    caches.open('happiness-meter').then(function(cache) {
      return cache.addAll([
        '/',
        '/login.php',
        '/vote.html',
        '/thankyou.html',
        '/Logo.jpg'
      ]);
    })
  );
});

self.addEventListener('fetch', function(e) {
  e.respondWith(
    caches.match(e.request).then(function(response) {
      return response || fetch(e.request);
    })
  );
});
