@vite(['resources/js/monthly_cost_setting/monthly_cost_setting.js'])

<x-app-layout>
    <x-page-header content="月額経費"/>
    <div class="flex flex-row mb-2">
        <!-- 操作ボタン -->
        <x-monthly-cost.operation-div />
        <!-- ページネーション -->
        <x-pagenation :pages="$monthly_cost_settings" />
    </div>
    <div class="flex flex-row items-start mb-2">
        <!-- 検索条件 -->
        <x-monthly-cost.search :bases="$bases" searchRoute="monthly_cost_setting.index" resetRoute="monthly_cost_setting.index" />
        <!-- 月額経費一覧 -->
        <x-monthly-cost.list :monthlyCosts="$monthly_cost_settings" />
    </div>
</x-app-layout>