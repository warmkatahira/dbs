@vite(['resources/js/balance_mgt/balance_update/common.js'])

<x-app-layout>
    <x-page-header content="収支更新"/>
    <x-page-back :url="session('back_url_2')" />
    <!-- バリデーションエラー -->
    <div id="validation_error_div" class="text-sm bg-red-200 border border-red-500 text-red-700 px-4 py-3 mb-3 rounded hidden"></div>
    <form method="POST" action="{{ route('balance_update.update') }}" id="balance_update_form">
        @csrf
        <div class="flex flex-row justify-between bg-white w-1300px px-5 pb-5 pt-2 mt-5">
            <!-- 荷主 -->
            <x-balance-mgt.balance-detail.customer :customer="$balance_data['customer']" />
            <!-- 収支備考 -->
            <x-balance-mgt.balance-update.balance-note :balance="$balance_data['balance']" />
        </div> 
        <!-- 運賃 -->
        <x-balance-mgt.balance-update.balance-shipping-fee :balance="$balance_data['balance']" :customerShippingMethods="$balance_data['customer_shipping_methods']" :balanceShippingFees="$balance_data['balance_shipping_fees']" />
        <!-- 荷役 -->
        <x-balance-mgt.balance-update.balance-handling-fee :balance="$balance_data['balance']" :customerHandlings="$balance_data['customer_handlings']" :balanceHandlingFees="$balance_data['balance_handling_fees']" />
        <div class="flex flex-row justify-between bg-white w-1300px px-5 pb-5 pt-2 mt-5">
            <!-- 保管 -->
            <x-balance-mgt.balance-update.balance-storage :balanceStorage="$balance_data['balance_storage']" />
            <!-- 月額経費 -->
            <x-balance-mgt.balance-update.balance-monthly-cost :balanceMonthlyCost="$balance_data['balance_monthly_cost']" />
            <!-- 人件費 -->
            <x-balance-mgt.balance-update.balance-labor-cost :balanceLaborCost="$balance_data['balance_labor_cost']" />
        </div>
        <input type="hidden" name="balance_id" value="{{ $balance_data['balance']->balance_id }}">
        <button type="button" id="balance_update_enter" class="p-5 mt-10 bg-theme-main text-white">更新する</button>
    </form>
</x-app-layout>