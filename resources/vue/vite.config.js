import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    plugins: [vue()],
    resolve: {
        alias: {
            '@deal': path.resolve(__dirname, './'),
            '@dealComponents': path.resolve(__dirname, './src/components'),
            '@dealModels': path.resolve(__dirname, './src/models'),
            '@dealPages': path.resolve(__dirname, './src/pages'),
            '@dealStore': path.resolve(__dirname, './src/store'),
        },
    },
});
