const mix = require('laravel-mix');

// Compilar o CSS
mix.css('resources/css/app.css', 'public/css')
   .sass('resources/sass/app.scss', 'public/css')
   .version();  // Isso cria um arquivo com versão para evitar cache nos navegadores
