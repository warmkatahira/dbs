<x-app-layout>
    <x-page-header content="収支詳細"/>
    <x-page-back :url="session('back_url_1')" />
    <div class="flex flex-row mb-2">
        <!-- 操作ボタン -->
        <x-balance-mgt.balance-detail.operation-div :balance="$balance_data['balance']" />
    </div>
    <!-- 人件費 -->
    <x-balance-mgt.balance-detail.balance-labor-cost :balanceLaborCost="$balance_data['balance_labor_cost']" />
    <!-- 月額経費 -->
    <x-balance-mgt.balance-detail.balance-monthly-cost :balanceMonthlyCost="$balance_data['balance_monthly_cost']" />
    <!-- 保管経費 -->
    <x-balance-mgt.balance-detail.balance-storage :balanceStorage="$balance_data['balance_storage']" label="保管経費" column="storage_cost" />
    <!-- 保管売上 -->
    <x-balance-mgt.balance-detail.balance-storage :balanceStorage="$balance_data['balance_storage']" label="保管売上" column="storage_sales" />
</x-app-layout>