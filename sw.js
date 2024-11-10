const nombreCache = 'apv-v5';
const archivos=[
    './',
    '/index.html',
    '/error.html',
    '/css/bootstrap.css',
    '/css/styles.css',
    '/js/app.js',
    '/js/apv.js'

];

// Cuando se instala el service Worker

self.addEventListener('install', e => {
    console.log('Instalando el Service worker');

    e.waitUntil(
        caches.open(nombreCache)
        .then( cache => {
            console.log('cacheando');
            cache.addAll(archivos);
        })
    )
});

//Activar servicio de Woker
self.addEventListener('activate', e =>{
    console.log('Servicio de worker Acivado');

    e.waitUntil(
        caches.keys()
        .then( keys => {

            return Promise.all(
                keys.filter( key => key !== nombreCache)
                .map( key => caches.delete(key))// borra las versiones anteriores
            )
        })
    )
});

//Evenos fetch para descargar archivos estaticos

self.addEventListener('fetch', e =>{
    console.log('fetch...', e);

    e.respondWith(
        caches.match(e.request)
        .then( respuestaCache => {
            return respuestaCache
        })
        .catch(() => caches.match('./error.html'))
    )
});