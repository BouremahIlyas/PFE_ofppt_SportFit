import './bootstrap';

// Import Swiper styles - these are already in app.css, so they can be removed from here
// import 'swiper/css';
// import 'swiper/css/navigation';
// import 'swiper/css/pagination';
// import 'swiper/css/effect-fade';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Import Swiper JS (you likely already have this or similar)
// REMOVE this line as Swiper is loaded via CDN in app.blade.php
// import Swiper from 'swiper';
// If you are using specific Swiper modules, you might import them like:
// import Swiper, { Navigation, Pagination, Autoplay, EffectFade } from 'swiper';

// If you configured Swiper modules (e.g. Navigation, Pagination), install them:
// Swiper.use([Navigation, Pagination, Autoplay, EffectFade]); // Only if you imported modules separately
