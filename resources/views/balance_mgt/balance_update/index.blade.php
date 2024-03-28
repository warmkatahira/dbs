@vite(['resources/js/balance_mgt/balance_update/common.js'])

<x-app-layout>
    <x-page-header content="収支更新"/>
    <x-page-back :url="session('back_url_2')" />
    <!-- バリデーションエラー -->
    <div id="validation_error_div" class="text-sm bg-red-200 border border-red-500 text-red-700 px-4 py-3 mb-3 rounded hidden"></div>
    <form method="POST" action="{{ route('balance_update.update') }}" id="balance_update_form">
        @csrf
        <x-balance-mgt.balance-update.balance-shipping-fee :balance="$balance_data['balance']" :customerShippingMethods="$balance_data['customer_shipping_methods']" :balanceShippingFees="$balance_data['balance_shipping_fees']" />
        <x-balance-mgt.balance-update.balance-handling-fee :balance="$balance_data['balance']" :customerHandlings="$balance_data['customer_handlings']" :balanceHandlingFees="$balance_data['balance_handling_fees']" />
        <x-balance-mgt.balance-update.balance-storage :balanceStorage="$balance_data['balance_storage']" />
        <x-balance-mgt.balance-update.balance-monthly-cost :balanceMonthlyCost="$balance_data['balance_monthly_cost']" />
        <x-balance-mgt.balance-update.balance-labor-cost :balanceLaborCost="$balance_data['balance_labor_cost']" />
        <button type="button" id="balance_update_enter" class="p-5 mt-10 bg-theme-main text-white">更新する</button>
    </form>
</x-app-layout>