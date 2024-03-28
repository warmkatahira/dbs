@vite(['resources/js/master_mgt/shipping_fee_setting/shipping_fee_setting.js'])

<x-app-layout>
    <x-page-header content="運賃設定更新"/>
    <x-page-back :url="session('back_url_2')" />
    <!-- バリデーションエラー -->
    <x-validation-error-msg />
    <div class="bg-white">
        <form method="POST" action="{{ route('shipping_fee_setting_update.update') }}" id="shipping_fee_setting_update_form">
            @csrf
            <x-div.label label="拠点" :value="$customer->base->base_name" />
            <x-div.label label="荷主名" :value="$customer->customer_name" />
            <x-master-mgt.shipping-fee-setting.shipping-method-select :deliveryCompanies="$delivery_companies" :db="$customer_shipping_method->shipping_method_id" />
            <x-div.input type="tel" label="運賃単価(売上)" id="shipping_fee_unit_price_sales" :db="$customer_shipping_method->shipping_fee_unit_price_sales" required="1" tippy="0" />
            <x-div.input type="tel" label="運賃単価(経費)" id="shipping_fee_unit_price_cost" :db="$customer_shipping_method->shipping_fee_unit_price_cost" required="1" tippy="0" />
            <x-div.input type="text" label="運賃備考" id="shipping_fee_note" :db="$customer_shipping_method->shipping_fee_note" required="1" tippy="0" />
            <input type="hidden" name="customer_shipping_method_id" value="{{ $customer_shipping_method->customer_shipping_method_id }}">
        </form>
    </div>
    <button type="button" id="shipping_fee_setting_update_enter" class="text-sm px-10 py-2 bg-theme-main text-white">更新</button>
</x-app-layout>