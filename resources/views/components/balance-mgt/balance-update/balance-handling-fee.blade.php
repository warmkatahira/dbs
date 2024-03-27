@vite(['resources/js/balance_mgt/balance_update/balance_handling_fee.js'])

<div class="bg-white w-1300px px-5 pb-5 pt-2 mt-5">
    <div class="flex flex-row mb-5">
        <p class="text-xl">荷役</p>
        <div class="ml-auto">
            <select id="customer_handling_id" name="customer_handling_id" class="text-xs">
                @foreach($customerHandlings as $customer_handling)
                    <option value="{{ $customer_handling->pivot->customer_handling_id }}" data-handling-id="{{ $customer_handling->handling_id }}" data-handling-name="{{ $customer_handling->handling_name }}" data-handling-fee-unit-price="{{ $customer_handling->pivot->handling_fee_unit_price }}" data-handling-fee-note="{{ $customer_handling->pivot->handling_fee_note }}">
                        {{ $customer_handling->handling_name.'(単価：'.number_format($customer_handling->pivot->handling_fee_unit_price).'円)(備考：'.(is_null($customer_handling->pivot->handling_fee_note) ? 'なし' : $customer_handling->pivot->handling_fee_note).')' }}
                    </option>
                @endforeach
            </select>
            <button type="button" id="customer_handling_create" class="bg-theme-main text-white text-sm px-5 py-2 hover:bg-gray-500">追加</button>
        </div>
    </div>
    <table class="text-xs block whitespace-nowrap">
        <thead>
            <tr class="text-center">
                <th colspan="2" class="font-thin py-3 px-2"></th>
                <th colspan="3" class="font-thin py-3 px-2 bg-orange-300">売上</th>
            </tr>
            <tr class="text-center">
                <th class="font-thin py-3 px-2 bg-gray-300">操作</th>
                <th class="font-thin py-3 px-2 bg-gray-300">荷役名</th>
                <th class="font-thin py-3 px-2 bg-orange-200">荷役数</th>
                <th class="font-thin py-3 px-2 bg-orange-200">荷役単価</th>
                <th class="font-thin py-3 px-2 bg-orange-200">荷役金額</th>
                <th class="font-thin py-3 px-2 bg-gray-300">荷役備考</th>
            </tr>
        </thead>
        <tbody id="customer_handling_tbody" class="bg-white">
            @foreach($balanceHandlingFees as $balance_handling_fee)
                <tr>
                    <td class="py-1 px-2 border text-left">
                        <button type="button" class="text-xs mx-3 px-3 py-1 border border-red-600 bg-red-100 customer_handling_delete">削除</button>
                    </td>
                    <td class="py-1 px-2 border text-left">{{ $balance_handling_fee->handling->handling_name }}</td>
                    <td class="py-1 px-2 border"><input type="tel" name="handling_fee_quantity[]" class="text-xs text-right py-1 w-20 handling_fee_calc" value="{{ $balance_handling_fee->handling_fee_quantity }}" autocomplete="off"></td>
                    <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="handling_fee_unit_price[]" class="text-xs text-right py-1 w-20 handling_fee_calc" value="{{ $balance_handling_fee->handling_fee_unit_price }}" autocomplete="off"></td>
                    <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="handling_fee_amount[]" class="text-xs text-right py-1 w-24" value="{{ $balance_handling_fee->handling_fee_amount }}" autocomplete="off"></td>
                    <td class="py-1 px-2 border"><input type="tel" name="handling_fee_note[]" class="text-xs text-left py-1 w-48" value="{{ $balance_handling_fee->handling_fee_note }}" autocomplete="off"></td>
                    <input type="hidden" name="handling_id[]" value="{{ $balance_handling_fee->handling_id }}">
                </tr>
            @endforeach
            <input type="hidden" name="balance_id" value="{{ $balance->balance_id }}">
        </tbody>
    </table>
</div>