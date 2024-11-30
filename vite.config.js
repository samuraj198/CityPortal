import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        })
    ],
    build: {
        manifest: true, // Генерация манифеста для Laravel
        outDir: 'public/build', // Путь до директории вывода
        rollupOptions: {
            output: {
                entryFileNames: 'assets/[name]-[hash].js',
                chunkFileNames: 'assets/[name]-[hash].js',
                assetFileNames: 'assets/[name]-[hash][extname]',
            },
        },
    },
    server: {
        https: true,
        host: '0.0.0.0',
    },
    resolve: {
        alias: {
            // Убедитесь, что все ссылки генерируются с https
            'https://cityportal.onrender.com': 'https://cityportal.onrender.com'
        }
    }
});

