@vite(['resources/js/master_mgt/base/sales_plan/sales_plan.js'])

<x-app-layout>
    <x-page-header content="売上計画({{ $base->base_name }})"/>
    <div class="flex flex-col mb-2">
        <!-- 操作ボタン -->
        <x-master-mgt.base.sales-plan.operation-div />
        <!-- ページネーション -->
        <x-pagenation :pages="$sales_plans" />
    </div>
    <div class="flex flex-row items-start mb-2">
        <!-- 検索条件 -->
        <x-master-mgt.base.sales-plan.search searchRoute="sales_plan.index" resetRoute="sales_plan.index" />
        <!-- 売上計画一覧 -->
        <x-master-mgt.base.sales-plan.list :salesPlans="$sales_plans" />
    </div>
</x-app-layout>