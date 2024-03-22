<x-app-layout>
    <x-page-header content="収支詳細"/>
    <x-page-back :url="session('back_url_1')" />
    <!-- 人件費 -->
    <x-balance-mgt.balance-detail.balance-labor-cost :balanceLaborCost="$balance_labor_cost" />
    <!-- 月額経費 -->
    <x-balance-mgt.balance-detail.balance-monthly-cost :balanceMonthlyCost="$balance_monthly_cost" />
    <!-- 保管経費 -->
    <x-balance-mgt.balance-detail.balance-storage :balanceStorage="$balance_storage" label="保管経費" column="storage_cost" />
    <!-- 保管売上 -->
    <x-balance-mgt.balance-detail.balance-storage :balanceStorage="$balance_storage" label="保管売上" column="storage_sales" />
</x-app-layout>