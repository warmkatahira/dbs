<div class="scroll_wrap flex flex-grow overflow-scroll">
    <div class="table_parent_div bg-white overflow-x-auto overflow-y-auto border border-gray-600">
        <table class="text-sm block whitespace-nowrap">
            <thead>
                <tr class="text-center text-white bg-gray-600 sticky top-0">
                    <th class="font-thin py-3 px-2">拠点</th>
                    <th class="font-thin py-3 px-2">荷主名</th>
                    <th class="font-thin py-3 px-2">有効/無効</th>
                    <th class="font-thin py-3 px-2">設定</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($customers as $customer)
                    <tr class="hover:bg-theme-sub cursor-default @if($customer->is_available == 0) text-red-600 bg-gray-200 @endif">
                        <td class="py-1 px-2 border text-left">{{ $customer->dbs_base->base_name }}</td>
                        <td class="py-1 px-2 border text-left">{{ $customer->customer_name }}</td>
                        <td class="py-1 px-2 border text-center">{{ $customer->is_available == 0 ? '無効' : '有効' }}</td>
                        <td class="py-1 px-2 border text-center">
                            <a href="{{ route('shipping_fee_setting.index', ['customer_id' => $customer->customer_id]) }}" class="bg-theme-main hover:bg-gray-500 text-white px-3 py-1">荷役</a>
                            <a href="{{ route('shipping_fee_setting.index', ['customer_id' => $customer->customer_id]) }}" class="bg-theme-main hover:bg-gray-500 text-white px-3 py-1 ml-3">運賃</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>