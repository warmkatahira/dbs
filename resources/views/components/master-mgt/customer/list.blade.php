<div class="scroll_wrap flex flex-grow overflow-scroll">
    <div class="table_parent_div bg-white overflow-x-auto overflow-y-auto border border-gray-600">
        <table class="text-sm block whitespace-nowrap">
            <thead>
                <tr class="text-center text-white bg-gray-600 sticky top-0">
                    <th class="font-thin py-3 px-2">拠点</th>
                    <th class="font-thin py-3 px-2">荷主名</th>
                    <th class="font-thin py-3 px-2">有効/無効</th>
                    <th class="font-thin py-3 px-2">収支作成</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($customers as $customer)
                    <tr class="hover:bg-theme-sub cursor-default @if($customer->is_available == 0) text-red-600 bg-gray-200 @endif">
                        <td class="py-1 px-2 border text-left">{{ $customer->dbs_base->base_name }}</td>
                        <td class="py-1 px-2 border text-left">{{ $customer->customer_name }}</td>
                        <td class="py-1 px-2 border text-center">{{ $customer->is_available == 0 ? '無効' : '有効' }}
                        <td class="py-1 px-2 border text-center">{{ $customer->balance_create_is_available == 0 ? '無効' : '有効' }}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>