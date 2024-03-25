@vite(['resources/js/master_mgt/shipping_fee_setting/shipping_fee_setting.js'])

<x-app-layout>
    <x-page-header content="運賃設定"/>
    <!-- バリデーションエラー -->
    <x-validation-error-msg />
    <x-page-back :url="session('back_url_1')" />
    <div class="flex flex-row mb-2">
        <!-- 操作ボタン -->
        <x-master-mgt.shipping-fee-setting.operation-div :customer="$customer" />
    </div>
    <x-master-mgt.customer-info :customer="$customer" />
    <!-- 運賃設定一覧 -->
    <table class="text-sm block whitespace-nowrap">
        <thead>
            <tr class="text-center text-white bg-gray-600 sticky top-0">
                <th class="font-thin py-3 px-2">運送会社</th>
                <th class="font-thin py-3 px-2">配送方法</th>
                <th class="font-thin py-3 px-2">運賃単価(売上)</th>
                <th class="font-thin py-3 px-2">運賃単価(経費)</th>
                <th class="font-thin py-3 px-2">運賃備考</th>
                <th class="font-thin py-3 px-2">操作</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach($shipping_fee_settings as $shipping_fee_setting)
                <tr class="hover:bg-theme-sub cursor-default">
                    <td class="py-1 px-2 border text-left"><img src="{{ asset('image/delivery_company/'.$shipping_fee_setting->delivery_company->company_image) }}" class="inline-block w-16"></td>
                    <td class="py-1 px-2 border text-left">{{ $shipping_fee_setting->shipping_method_name }}</td>
                    <td class="py-1 px-2 border text-right"><i class="las la-yen-sign"></i>{{ number_format($shipping_fee_setting->pivot->shipping_fee_unit_price_sales) }}</td>
                    <td class="py-1 px-2 border text-right"><i class="las la-yen-sign"></i>{{ number_format($shipping_fee_setting->pivot->shipping_fee_unit_price_cost) }}</td>
                    <td class="py-1 px-2 border text-left">{{ $shipping_fee_setting->pivot->shipping_fee_note }}</td>
                    <td class="py-1 px-2 border">
                        <div class="flex">
                            <a href="{{ route('shipping_fee_setting_update.index', ['customer_shipping_method_id' => $shipping_fee_setting->pivot->customer_shipping_method_id]) }}" class="text-xs mx-3 px-3 py-1 border border-blue-600 bg-blue-100">更新</a>
                            <button type="button" class="shipping_fee_setting_delete_enter text-xs mx-3 px-3 py-1 border border-red-600 bg-red-100" data-customer_shipping_method_id="{{ $shipping_fee_setting->pivot->customer_shipping_method_id }}">削除</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <form method="POST" action="{{ route('shipping_fee_setting_delete.delete') }}" id="shipping_fee_setting_delete_form" class="m-0">
        @csrf
        <input type="hidden" id="customer_shipping_method_id" name="customer_shipping_method_id" value="">
    </form>
</x-app-layout>