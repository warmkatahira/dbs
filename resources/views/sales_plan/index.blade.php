@vite(['resources/js/sales_plan/sales_plan.js'])

<x-app-layout>
    <x-page-header content="売上計画"/>
    <div class="flex flex-row mb-2">
        <!-- 操作ボタン -->
        <x-sales-plan.operation-div />
        <!-- ページネーション -->
        <x-pagenation :pages="$sales_plans" />
    </div>
    <div class="flex flex-row items-start mb-2">
        <!-- 検索条件 -->
        <x-sales-plan.search :bases="$bases" searchRoute="sales_plan.index" resetRoute="sales_plan.index" />
        <!-- 売上計画一覧 -->
        <x-sales-plan.list :salesPlans="$sales_plans" />
    </div>
</x-app-layout>