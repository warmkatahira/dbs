@vite(['resources/js/setting/monthly_cost_setting/monthly_cost_setting.js'])

<x-app-layout>
    <x-page-header content="月額経費設定"/>
    <div class="flex flex-row mb-2">
        <!-- 操作ボタン -->
        <x-setting.monthly-cost-setting.operation-div />
        <!-- ページネーション -->
        <x-pagination :pages="$monthly_cost_settings" />
    </div>
    <div class="flex flex-row items-start mb-2">
        <!-- 検索条件 -->
        <x-setting.monthly-cost-setting.search :bases="$bases" searchRoute="monthly_cost_setting.index" resetRoute="monthly_cost_setting.index" />
        <!-- 月額経費設定一覧 -->
        <x-setting.monthly-cost-setting.list :monthlyCosts="$monthly_cost_settings" />
    </div>
</x-app-layout>