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
                'resources/js/setting/sales_plan_setting/sales_plan_setting.js',
                // 月額経費
                'resources/js/setting/monthly_cost_setting/monthly_cost_setting.js',
                // 月別荷主設定
                'resources/js/setting/monthly_customer_setting/monthly_customer_setting.js',
                'resources/js/setting/monthly_customer_setting/setting_record_create.js',
            ],
            // 収支管理
            [
                // 収支一覧
                'resources/js/balance_mgt/balance_list/balance_list.js',
            ],
            // マスタ管理
            [
                // 運賃設定
                'resources/js/master_mgt/shipping_fee_setting/shipping_fee_setting.js',
            ],
        ),
    ],
});
