const mix = require('laravel-mix');

// Compiling and bundling CSS and JS
mix.js('resources/js/dashboard.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .version(); // Versioning files for cache busting