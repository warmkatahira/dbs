<x-app-layout>
    <x-page-header content="収支詳細"/>
    <x-page-back :url="session('back_url_1')" />
    <div class="flex flex-row mb-2">
        <!-- 操作ボタン -->
        <x-balance-mgt.balance-detail.operation-div :balance="$balance_data['balance']" />
    </div>
    <!-- 最終更新 -->
    <x-balance-mgt.balance-detail.balance-last-update :balance="$balance_data['balance']" />
    <div class="flex flex-row justify-between bg-white w-1300px px-5 pb-5 pt-2 mt-5">
        <!-- 荷主 -->
        <x-balance-mgt.balance-detail.customer :customer="$balance_data['customer']" />
        <!-- 収支 -->
        <x-balance-mgt.balance-detail.balance :balance="$balance_data['balance']" />
        <!-- 収支備考 -->
        <x-balance-mgt.balance-detail.balance-note :balance="$balance_data['balance']" />
    </div>
    <!-- 運賃 -->
    <x-balance-mgt.balance-detail.balance-shipping-fee :balance="$balance_data['balance']" :balanceShippingFees="$balance_data['balance_shipping_fees']" />
    <!-- 荷役 -->
    <x-balance-mgt.balance-detail.balance-handling-fee :balance="$balance_data['balance']" :balanceHandlingFees="$balance_data['balance_handling_fees']" />
    <div class="flex flex-row justify-between bg-white w-1300px px-5 pb-5 pt-2 mt-5">
        <!-- 保管 -->
        <x-balance-mgt.balance-detail.balance-storage :balanceStorage="$balance_data['balance_storage']" />
        <!-- 月額経費 -->
        <x-balance-mgt.balance-detail.balance-monthly-cost :balanceMonthlyCost="$balance_data['balance_monthly_cost']" />
        <!-- 人件費 -->
        <x-balance-mgt.balance-detail.balance-labor-cost :balanceLaborCost="$balance_data['balance_labor_cost']" />
    </div>
</x-app-layout>