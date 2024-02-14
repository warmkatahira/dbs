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
                'resources/js/dropdown.js',
                'resources/scss/dropdown.scss',
                'resources/js/file_select.js',
                'resources/scss/file_select.scss',
                'resources/js/upload_error.js',
            ],
            // ウェルカム
            [
                
            ],
            // 設定
            [
                // 売上計画
                'resources/js/sales_plan/sales_plan.js',
                // 月額経費
                'resources/js/monthly_cost/monthly_cost.js',
                // 月額荷主設定
                'resources/js/setting/monthly_customer_setting.js',
            ],
        ),
    ],
});
