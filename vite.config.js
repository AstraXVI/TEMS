import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import sass from 'vite-plugin-sass'; // Import the sass plugin directly

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/main.scss',
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/codebase/app.js',
            ],
            refresh: ['resources/views/**'],
        })
    ],
    // publicDir: 'public' // Specify the correct directory path here
});
