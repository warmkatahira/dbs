<x-app-layout>
    <x-page-header content="荷主マスタ"/>
    <div class="flex flex-row mb-2">
        <!-- 操作ボタン -->
        <x-master-mgt.customer.operation-div />
        <!-- 経費分配割合エラーメッセージ -->
        <div class="flex flex-col">
            @if(!empty($cost_allocation_ratio_check['ho_cost']))
                <p class="text-sm text-red-600 ml-5"><i class="las la-exclamation-triangle la-lg mr-1"></i>{{ $cost_allocation_ratio_check['ho_cost'] }}</p>
            @endif
            @if(!empty($cost_allocation_ratio_check['monthly_cost_setting']))
                <p class="text-sm text-red-600 ml-5"><i class="las la-exclamation-triangle la-lg mr-1"></i>{{ $cost_allocation_ratio_check['monthly_cost_setting'] }}</p>
            @endif
        </div>
        <!-- ページネーション -->
        <x-pagination :pages="$customers" />
    </div>
    <div class="flex flex-row items-start mb-2">
        <!-- 検索条件 -->
        <x-master-mgt.customer.search :bases="$bases" :isAvailableConditions="$is_available_conditions" searchRoute="customer.index" resetRoute="customer.index" />
        <!-- 荷主一覧 -->
        <x-master-mgt.customer.list :customers="$customers" />
    </div>
</x-app-layout>