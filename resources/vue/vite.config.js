import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    plugins: [vue()],
    resolve: {
        alias: {
            '@deals': path.resolve(__dirname, './'),
            '@dealsComponents': path.resolve(__dirname, './src/components'),
            '@dealsModels': path.resolve(__dirname, './src/models'),
            '@dealsPages': path.resolve(__dirname, './src/pages'),
            '@dealsStore': path.resolve(__dirname, './src/store'),
        },
    },
});
