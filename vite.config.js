import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        manifest: true, // Генерация манифеста для Laravel
        outDir: 'public/build', // Путь до директории вывода
    },
    server: {
        https: true,
    }
});

