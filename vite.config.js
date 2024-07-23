import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.scss','resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template:{
                base: null,
                includeAbsolute: false,
                transformAssetUrls: {
                    includeAbsolute: false
                }
            }
        }),
    ],
    resolve: {
        alias: {
            ziggy: path.resolve('vendor/tightenco/ziggy/dist/vue.es.js'),
        },
    },
});
