// Chargement des éléments dans les caches
const CURRENT_CACHE_NAME = 'magschool-v2';
//Installation de service worker
self.addEventListener('install', event => {
	event.waitUntil(
		caches.open(CURRENT_CACHE_NAME).then(function(cache) {
		  return cache.addAll([
			'/',
			'css/auth-styles.css',
			'css/custom-styles.css',
			'css/main-styles.css',
			'js/authscripts.js',
			'js/customscripts.js',
			'js/datatables.init.js',
			'js/library.js',
			'js/main.js',
			'manifest.json'
		  ]);
		}).catch(function(error) {
			console.error('Échec de l\'ajout au cache:', error);
		  })
	  );
	console.log('Installation du Service Worker...');
});

self.addEventListener('activate', event => {
	clients.claim(); // Contrôle immédiat de toutes les pages
	console.log('Activation du Service worker...');
});


//nettoyage des éléments dans les caches
self.addEventListener('activate', event => {
	//console.log('Activation du Service worker...');
	event.waitUntil(
		caches.keys().then(cacheNames => {
			return Promise.all(
				cacheNames.map(cacheName => {
					if (cacheName !== CURRENT_CACHE_NAME) {
						return caches.delete(cacheName);// Supprime les anciens caches
					}
				})
			);
		})
	);
});

self.addEventListener('fetch', event => {
	// Filtrer les requêtes qui ont un schéma 'chrome-extension://'
	if (!event.request.url.startsWith('chrome-extension://')) {
		//console.log('Interception d\'un fetch vers :', event.request.url);
		event.respondWith(caches.match(event.request)
			.then(cachedResponse => {
				// Si une réponse est trouvée dans le cache, l'utiliser
				if (cachedResponse) {
					//console.log('Réponse depuis le cache pour :', event.request.url);
					return cachedResponse;
				}
				 // Sinon, aller chercher la ressource sur le réseau
				return fetch(event.request).then(response => {
					 // Vérifiez si la réponse est valide
					if (!response || response.status !== 200 || response.type !== 'basic') {
						return response;
					}
					 // Mettez la réponse dans le cache pour une utilisation future
					 return caches.open(CURRENT_CACHE_NAME).then((cache) => {
						cache.put(event.request, response.clone());
						return response;
					});
				});
			})
		);
	}
});

//Stratégie de Mise à jour
self.addEventListener('install', event => {
	//console.log('Installation du Service Worker...');
	self.skipWaiting();
});
/* Si vous avez des routes spécifiques ou des ressources qui changent fréquemment,
 envisagez de les supprimer explicitement lorsque nécessaire : */

 self.addEventListener('message', (event) => {
    if (event.data && event.data.action === 'clearCache') {
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    return caches.delete(cacheName); // Supprime tous les caches
                })
            );
        }).then(() => {
            console.log('Cache cleared');
        });
    }
});