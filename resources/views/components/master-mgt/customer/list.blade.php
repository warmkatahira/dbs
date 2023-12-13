<div class="scroll_wrap flex flex-grow overflow-scroll">
    <div class="table_parent_div bg-white overflow-x-auto overflow-y-auto border border-gray-600">
        <table class="text-sm block whitespace-nowrap">
            <thead>
                <tr class="text-left text-white bg-gray-600 sticky top-0">
                    <th class="font-thin py-3 px-2 text-center">拠点</th>
                    <th class="font-thin py-3 px-2 text-center">荷主名</th>
                    <th class="font-thin py-3 px-2 text-center">月間保管売上</th>
                    <th class="font-thin py-3 px-2 text-center">月間保管経費</th>
                    <th class="font-thin py-3 px-2 text-center">経費分配割合</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($customers as $customer)
                    <tr class="text-left hover:bg-theme-sub cursor-default">
                        <td class="py-1 px-2 border">{{ $customer->dbs_base->base_name }}</td>
                        <td class="py-1 px-2 border">{{ $customer->customer_name }}</td>
                        <td class="py-1 px-2 border text-right"><i class="las la-yen-sign"></i>{{ number_format($customer->monthly_storage_sales) }}</td>
                        <td class="py-1 px-2 border text-right"><i class="las la-yen-sign"></i>{{ number_format($customer->monthly_storage_cost) }}</td>
                        <td class="py-1 px-2 border text-right">{{ $customer->cost_allocation_ratio }}<i class="las la-percent"></i></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>