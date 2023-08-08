import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    plugins: [
        laravel(
            // 共通
            [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/scss/theme.scss',
                'resources/scss/navigation.scss',
                'resources/js/loading.js',
                'resources/css/loading.css',
                'resources/scss/scroll.scss',
                'resources/js/common.js',
                'resources/js/search_date.js',
            ],
            // ウェルカム
            [
                
            ],
            // 売上計画
            [
                'resources/js/master_mgt/base/sales_plan/sales_plan.js',
            ],
        ),
    ],
});
