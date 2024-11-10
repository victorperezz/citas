if ('serviceWorker'in navigator){
    navigator.serviceWorker.register('./sw.js')
    .then (registrado => console.log('Se instalo corretamente...',registrado))
    .catch( error => console.log ('Fallo la instalacion...', error))
}else{
    console.log('Sevice workers no soportados')
}
window.addEventListener('load', () => {
    setTimeout(() => {
      document.getElementById('splashScreen').classList.add('hidden');
    }, 1500);  // Ocultar splash después de 2 segundos
  });
  

  // Dispara notificaciones periódicas locales
setInterval(() => {
  if (Notification.permission === 'granted') {
    mostrarNotificacion(); // Llamar la función de notificaciones cada X tiempo
  }
}, 10000); // 10 segundos (10000 ms)


self.addEventListener('install', function(event) {
  console.log('Service Worker instalado.');
  // Cachear archivos si es necesario
});

self.addEventListener('activate', function(event) {
  console.log('Service Worker activado.');
});






// Solicitar permisos de notificación al usuario
function solicitarPermisoNotificacion() {
  if ('Notification' in window) {
    Notification.requestPermission().then(function(result) {
      if (result === 'granted') {
        console.log('Permiso de notificación otorgado.');
        mostrarNotificacion();
      } else {
        console.log('Permiso de notificación denegado.');
      }
    });
  } else {
    console.log('Este navegador no soporta notificaciones.');
  }
}

// Llama a la función cuando estés listo
solicitarPermisoNotificacion();

function mostrarNotificacion() {
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.ready.then(function(registration) {
      registration.showNotification('¡Comienza a crear citas!', {
        body: 'Haz clic aquí para empezar',
        icon: './img/icons/Icon-72.png',
        badge: './img/icons/Icon-72.png',
        vibrate: [200, 100, 200], // Vibración en dispositivos compatibles
        actions: [
          {
            action: 'explore',
            title: 'Comenzar ahora',
            icon: './img/play-icon.png' // Ícono para la acción
          }
        ]
      });
    });
  }
}

// Manejo de notificaciones push
self.addEventListener('push', function(event) {
  console.log('Notificación recibida.');

  const options = {
    body: event.data ? event.data.text() : 'Nueva notificación local',
    icon: './img/icons/Icon-72.png',
    badge: './img/icons/Icon-72.png'
  };

  event.waitUntil(
    self.registration.showNotification('Citas', options)
  );
});

// Manejo de eventos cuando se hace clic en la notificación
self.addEventListener('notificationclick', function(event) {
  event.notification.close();
  event.waitUntil(
    clients.openWindow('https://victorperezz.github.io/pwa/')
  );
});
