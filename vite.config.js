import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';  // Importando o plugin do React

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',  // Certifique-se de que esse arquivo chama o React
            ],
            refresh: true,
        }),
        react(),  // Adicionando o plugin React aqui
    ],
});