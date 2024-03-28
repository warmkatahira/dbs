<div class="bg-white w-1300px px-5 pb-5 pt-2">
    <div class="flex flex-row mb-5">
        <p class="text-xl">運賃</p>
    </div>
    <table class="text-xs block whitespace-nowrap">
        <thead>
            <tr class="text-center">
                <th class="font-thin py-3 px-2"></th>
                <th colspan="3" class="font-thin py-3 px-2 bg-orange-300">売上</th>
                <th colspan="3" class="font-thin py-3 px-2 bg-rose-300">経費</th>
            </tr>
            <tr class="text-center">
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
                    <td class="py-1 px-2 border text-left">{{ $balance_shipping_fee->shipping_method->delivery_company->delivery_company_name.'/'.$balance_shipping_fee->shipping_method->shipping_method_name }}</td>
                    <td class="py-1 px-2 border text-right">{{ number_format($balance_shipping_fee->shipping_fee_quantity_sales) }}</td>
                    <td class="py-1 px-2 border text-right"><i class="las la-yen-sign mr-1"></i>{{ number_format($balance_shipping_fee->shipping_fee_unit_price_sales) }}</td>
                    <td class="py-1 px-2 border text-right"><i class="las la-yen-sign mr-1"></i>{{ number_format($balance_shipping_fee->shipping_fee_amount_sales) }}</td>
                    <td class="py-1 px-2 border text-right">{{ number_format($balance_shipping_fee->shipping_fee_quantity_cost) }}</td>
                    <td class="py-1 px-2 border text-right"><i class="las la-yen-sign mr-1"></i>{{ number_format($balance_shipping_fee->shipping_fee_unit_price_cost) }}</td>
                    <td class="py-1 px-2 border text-right"><i class="las la-yen-sign mr-1"></i>{{ number_format($balance_shipping_fee->shipping_fee_amount_cost) }}</td>
                    <td class="py-1 px-2 border">{{ $balance_shipping_fee->shipping_fee_note }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>