@vite(['resources/js/master_mgt/handling_fee_setting/handling_fee_setting.js'])

<x-app-layout>
    <x-page-header content="荷役設定追加"/>
    <x-page-back :url="session('back_url_2')" />
    <!-- バリデーションエラー -->
    <x-validation-error-msg />
    <div class="bg-white">
        <form method="POST" action="{{ route('handling_fee_setting_create.create') }}" id="handling_fee_setting_create_form">
            @csrf
            <x-div.label label="拠点" :value="$customer->base->base_name" />
            <x-div.label label="荷主名" :value="$customer->customer_name" />
            <x-div.select label="荷役" id="handling_id" :forValue="$handlings" forId="handling_id" forText="handling_name" :db="null" required="1" tippy="0" />
            <x-div.input type="tel" label="荷役単価" id="handling_fee_unit_price" :db="null" required="1" tippy="0" />
            <x-div.input type="text" label="荷役備考" id="handling_fee_note" :db="null" required="1" tippy="0" />
            <x-div.input type="tel" label="荷役並び順" id="handling_fee_sort_order" :db="null" required="1" tippy="0" />
            <input type="hidden" name="customer_id" value="{{ $customer->customer_id }}">
        </form>
    </div>
    <button type="button" id="handling_fee_setting_create_enter" class="text-sm px-10 py-2 bg-theme-main text-white">追加</button>
</x-app-layout>