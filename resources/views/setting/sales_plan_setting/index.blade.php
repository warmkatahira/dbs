@vite(['resources/js/setting/sales_plan_setting/sales_plan_setting.js'])

<x-app-layout>
    <x-page-header content="売上計画設定"/>
    <div class="flex flex-row mb-2">
        <!-- 操作ボタン -->
        <x-setting.sales-plan-setting.operation-div />
        <!-- ページネーション -->
        <x-pagenation :pages="$sales_plan_settings" />
    </div>
    <div class="flex flex-row items-start mb-2">
        <!-- 検索条件 -->
        <x-setting.sales-plan-setting.search :bases="$bases" searchRoute="sales_plan_setting.index" resetRoute="sales_plan_setting.index" />
        <!-- 売上計画設定一覧 -->
        <x-setting.sales-plan-setting.list :salesPlans="$sales_plan_settings" />
    </div>
</x-app-layout>