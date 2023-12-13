@vite(['resources/js/monthly_cost/monthly_cost.js'])

<x-app-layout>
    <x-page-header content="月額経費"/>
    <div class="flex flex-col mb-2">
        <!-- 操作ボタン -->
        <x-monthly-cost.operation-div />
        <!-- ページネーション -->
        <x-pagenation :pages="$monthly_costs" />
    </div>
    <div class="flex flex-row items-start mb-2">
        <!-- 検索条件 -->
        <x-monthly-cost.search :bases="$bases" searchRoute="monthly_cost.index" resetRoute="monthly_cost.index" />
        <!-- 月額経費一覧 -->
        <x-monthly-cost.list :monthlyCosts="$monthly_costs" />
    </div>
</x-app-layout>