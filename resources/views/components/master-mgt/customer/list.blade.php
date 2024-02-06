<div class="scroll_wrap flex flex-grow overflow-scroll">
    <div class="table_parent_div bg-white overflow-x-auto overflow-y-auto border border-gray-600">
        <table class="text-sm block whitespace-nowrap">
            <thead>
                <tr class="text-center text-white bg-gray-600 sticky top-0">
                    <th class="font-thin py-3 px-2">拠点</th>
                    <th class="font-thin py-3 px-2">荷主名</th>
                    <th class="font-thin py-3 px-2">月間保管売上</th>
                    <th class="font-thin py-3 px-2">月間保管経費</th>
                    <th class="font-thin py-3 px-2">本社管理費分配割合<i class="las la-question-circle ml-1 la-lg tippy_ho_cost_allocation_ratio"></i></th>
                    <th class="font-thin py-3 px-2">月額経費分配割合<i class="las la-question-circle ml-1 la-lg tippy_monthly_cost_allocation_ratio"></i></th>
                    <th class="font-thin py-3 px-2">有効/無効<i class="las la-question-circle ml-1 la-lg tippy_is_available"></i></th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($customers as $customer)
                    <tr class="hover:bg-theme-sub cursor-default">
                        <td class="py-1 px-2 border text-left">{{ $customer->dbs_base->base_name }}</td>
                        <td class="py-1 px-2 border text-left">{{ $customer->customer_name }}</td>
                        <td class="py-1 px-2 border text-right"><i class="las la-yen-sign"></i>{{ number_format($customer->monthly_storage_sales) }}</td>
                        <td class="py-1 px-2 border text-right"><i class="las la-yen-sign"></i>{{ number_format($customer->monthly_storage_cost) }}</td>
                        <td class="py-1 px-2 border text-right">{{ $customer->ho_cost_allocation_ratio }}<i class="las la-percent"></i></td>
                        <td class="py-1 px-2 border text-right">{{ $customer->monthly_cost_allocation_ratio }}<i class="las la-percent"></i></td>
                        <td class="py-1 px-2 border text-center">{{ $customer->is_available == 0 ? '無効' : '有効' }}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>