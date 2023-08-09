@vite(['resources/js/master_mgt/base/monthly_cost/monthly_cost.js'])

<x-app-layout>
    <x-page-header content="月額経費({{ $base->base_name }})"/>
    <div class="flex flex-row mb-2">
        <!-- 操作ボタン -->
        <x-master-mgt.base.monthly-cost.operation-div />
    </div>
    <div class="flex flex-row items-start mb-2">
        <!-- 検索条件 -->
        <x-master-mgt.base.monthly-cost.search searchRoute="monthly_cost.index" resetRoute="monthly_cost.index" />
        <!-- 月額経費一覧 -->
        <x-master-mgt.base.monthly-cost.list :monthlyCosts="$monthly_costs" />
    </div>
</x-app-layout>