import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from 'tailwindcss';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        outDir: 'public/build',  // Garante que os arquivos vão para public/build
        emptyOutDir: true,       // Limpa o diretório antes de cada build
        rollupOptions: {
            output: {
                entryFileNames: 'assets/[name].js',
                assetFileNames: 'assets/[name].[ext]'
            }
        }
    },
    css: {
        postcss: {
            plugins: [
                tailwindcss(),
            ],
        },
    },
});