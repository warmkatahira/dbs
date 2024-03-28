<div class="bg-white w-1300px px-5 pb-5 pt-2 mt-5">
    <div class="flex flex-row mb-5">
        <p class="text-xl">荷役</p>
    </div>
    <table class="text-sm block whitespace-nowrap">
        <thead>
            <tr class="text-center">
                <th class="font-thin py-3 px-2"></th>
                <th colspan="3" class="font-thin py-3 px-2 bg-orange-300">売上</th>
            </tr>
            <tr class="text-center">
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
                    <td class="py-1 px-2 border text-left">{{ $balance_handling_fee->handling->handling_name }}</td>
                    <td class="py-1 px-2 border text-right">{{ number_format($balance_handling_fee->handling_fee_quantity) }}</td>
                    <td class="py-1 px-2 border text-right"><i class="las la-yen-sign mr-1"></i>{{ number_format($balance_handling_fee->handling_fee_unit_price) }}</td>
                    <td class="py-1 px-2 border text-right"><i class="las la-yen-sign mr-1"></i>{{ number_format($balance_handling_fee->handling_fee_amount) }}</td>
                    <td class="py-1 px-2 border text-right">{{ $balance_handling_fee->handling_fee_note }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>