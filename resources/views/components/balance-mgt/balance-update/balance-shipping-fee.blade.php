@vite(['resources/js/balance_mgt/balance_update/balance_shipping_fee.js'])

<div class="bg-white w-1300px px-5 pb-5 pt-2 mt-5">
    <div class="flex flex-row mb-5">
        <p class="text-xl">運賃</p>
        <div class="ml-auto">
            <select id="customer_shipping_method_id" name="customer_shipping_method_id" class="text-xs">
                @foreach($customerShippingMethods as $customer_shipping_method)
                    <option value="{{ $customer_shipping_method->pivot->customer_shipping_method_id }}" data-shipping-method-id="{{ $customer_shipping_method->shipping_method_id }}" data-shipping-method-name="{{ $customer_shipping_method->delivery_company->delivery_company_name.'/'.$customer_shipping_method->shipping_method_name }}" data-shipping-fee-unit-price-sales="{{ $customer_shipping_method->pivot->shipping_fee_unit_price_sales }}" data-shipping-fee-unit-price-cost="{{ $customer_shipping_method->pivot->shipping_fee_unit_price_cost }}" data-shipping-fee-note="{{ $customer_shipping_method->pivot->shipping_fee_note }}">
                        {{ $customer_shipping_method->delivery_company->delivery_company_name.'/'.$customer_shipping_method->shipping_method_name.'(売上単価：'.number_format($customer_shipping_method->pivot->shipping_fee_unit_price_sales).'円)(経費単価：'.number_format($customer_shipping_method->pivot->shipping_fee_unit_price_cost).'円)(備考：'.(is_null($customer_shipping_method->pivot->shipping_fee_note) ? 'なし' : $customer_shipping_method->pivot->shipping_fee_note).')' }}
                    </option>
                @endforeach
            </select>
            <button type="button" id="customer_shipping_method_create" class="bg-theme-main text-white text-sm px-5 py-2 hover:bg-gray-500">追加</button>
        </div>
    </div>
    <table class="text-xs block whitespace-nowrap">
        <thead>
            <tr class="text-center">
                <th colspan="2" class="font-thin py-3 px-2"></th>
                <th colspan="3" class="font-thin py-3 px-2 bg-orange-300">売上</th>
                <th colspan="3" class="font-thin py-3 px-2 bg-rose-300">経費</th>
            </tr>
            <tr class="text-center">
                <th class="font-thin py-3 px-2 bg-gray-300">操作</th>
                <th class="font-thin py-3 px-2 bg-gray-300">配送方法</th>
                <th class="font-thin py-3 px-2 bg-orange-200">個口数</th>
                <th class="font-thin py-3 px-2 bg-orange-200">運賃単価</th>
                <th class="font-thin py-3 px-2 bg-orange-200">運賃金額</th>
                <th class="font-thin py-3 px-2 bg-rose-200">個口数</th>
                <th class="font-thin py-3 px-2 bg-rose-200">運賃単価</th>
                <th class="font-thin py-3 px-2 bg-rose-200">運賃金額</th>
                <th class="font-thin py-3 px-2 bg-gray-300">運賃備考</th>
            </tr>
        </thead>
        <tbody id="customer_shipping_method_tbody" class="bg-white">
            @foreach($balanceShippingFees as $balance_shipping_fee)
                <tr>
                    <td class="py-1 px-2 border text-left">
                        <button type="button" class="text-xs mx-3 px-3 py-1 border border-red-600 bg-red-100 customer_shipping_method_delete">削除</button>
                    </td>
                    <td class="py-1 px-2 border text-left">{{ $balance_shipping_fee->shipping_method->delivery_company->delivery_company_name.'/'.$balance_shipping_fee->shipping_method->shipping_method_name }}</td>
                    <td class="py-1 px-2 border"><input type="tel" name="shipping_fee_quantity_sales[]" class="text-xs text-right py-1 w-20 shipping_fee_calc" value="{{ $balance_shipping_fee->shipping_fee_quantity_sales }}" autocomplete="off"></td>
                    <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="shipping_fee_unit_price_sales[]" class="text-xs text-right py-1 w-20 shipping_fee_calc" value="{{ $balance_shipping_fee->shipping_fee_unit_price_sales }}" autocomplete="off"></td>
                    <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="shipping_fee_amount_sales[]" class="text-xs text-right py-1 w-24" value="{{ $balance_shipping_fee->shipping_fee_amount_sales }}" autocomplete="off"></td>
                    <td class="py-1 px-2 border"><input type="tel" name="shipping_fee_quantity_cost[]" class="text-xs text-right py-1 w-20 shipping_fee_calc" value="{{ $balance_shipping_fee->shipping_fee_quantity_cost }}" autocomplete="off"></td>
                    <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="shipping_fee_unit_price_cost[]" class="text-xs text-right py-1 w-20 shipping_fee_calc" value="{{ $balance_shipping_fee->shipping_fee_unit_price_cost }}" autocomplete="off"></td>
                    <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="shipping_fee_amount_cost[]" class="text-xs text-right py-1 w-20" value="{{ $balance_shipping_fee->shipping_fee_amount_cost }}" autocomplete="off"></td>
                    <td class="py-1 px-2 border"><input type="tel" name="shipping_fee_note[]" class="text-xs text-left py-1 w-48" value="{{ $balance_shipping_fee->shipping_fee_note }}" autocomplete="off"></td>
                    <input type="hidden" name="shipping_method_id[]" value="{{ $balance_shipping_fee->shipping_method_id }}">
                </tr>
            @endforeach
            <input type="hidden" name="balance_id" value="{{ $balance->balance_id }}">
        </tbody>
    </table>
</div>