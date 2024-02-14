@vite(['resources/js/setting/monthly_customer_setting.js'])

<x-app-layout>
    <x-page-header content="月額荷主設定"/>
    <div class="flex flex-row mb-2">
        <!-- 操作ボタン -->
        <x-monthly-customer-setting.operation-div />
        <!-- 経費分配割合エラーメッセージ -->
        <div class="flex flex-col">
            @if(!empty($cost_allocation_ratio_check['ho_cost']))
                <p class="text-sm text-red-600 ml-5"><i class="las la-exclamation-triangle la-lg mr-1"></i>{{ $cost_allocation_ratio_check['ho_cost'] }}</p>
            @endif
            @if(!empty($cost_allocation_ratio_check['monthly_cost']))
                <p class="text-sm text-red-600 ml-5"><i class="las la-exclamation-triangle la-lg mr-1"></i>{{ $cost_allocation_ratio_check['monthly_cost'] }}</p>
            @endif
        </div>
        <!-- ページネーション -->
        <x-pagenation :pages="$monthly_customer_settings" />
    </div>
    <div class="flex flex-row items-start mb-2">
        <!-- 検索条件 -->
        <x-monthly-customer-setting.search :bases="$bases" searchRoute="monthly_customer_setting.index" resetRoute="monthly_customer_setting.index" />
        <!-- 荷主一覧 -->
        <x-monthly-customer-setting.list :monthlyCustomerSettings="$monthly_customer_settings" />
    </div>
</x-app-layout>