@vite(['resources/js/master_mgt/shipping_fee_setting/shipping_fee_setting.js'])

<x-app-layout>
    <x-page-header content="運賃設定追加"/>
    <!-- バリデーションエラー -->
    <x-validation-error-msg />
    <x-page-back :url="session('back_url_2')" />
    <div class="bg-white">
        <form method="POST" action="{{ route('shipping_fee_setting_create.create') }}" id="shipping_fee_setting_create_form">
            @csrf
            <x-div.label label="拠点" :value="$customer->dbs_base->base_name" />
            <x-div.label label="荷主名" :value="$customer->customer_name" />
            <x-master-mgt.shipping-fee-setting.shipping-method-select :deliveryCompanies="$delivery_companies" :db="null" />
            <x-div.input type="tel" label="運賃単価(売上)" id="shipping_fee_unit_price_sales" :db="null" required="1" tippy="0" />
            <x-div.input type="tel" label="運賃単価(経費)" id="shipping_fee_unit_price_cost" :db="null" required="1" tippy="0" />
            <x-div.input type="text" label="運賃備考" id="shipping_fee_note" :db="null" required="1" tippy="0" />
            <input type="hidden" name="customer_id" value="{{ $customer->customer_id }}">
        </form>
    </div>
    <button type="button" id="shipping_fee_setting_create_enter" class="text-sm px-10 py-2 bg-theme-main text-white">追加</button>
</x-app-layout>