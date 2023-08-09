<div class="scroll_wrap flex flex-grow overflow-scroll">
    <div class="table_parent_div bg-white overflow-x-auto overflow-y-auto border border-gray-600">
        <table class="text-xs block whitespace-nowrap">
            <thead>
                <tr class="text-left text-white bg-gray-600 sticky top-0">
                    <th class="font-thin py-3 px-2 text-center">拠点</th>
                    <th class="font-thin py-3 px-2 text-center">操作</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($bases as $base)
                    <tr class="text-left hover:bg-theme-sub cursor-default">
                        <td class="py-1 px-2 border">{{ $base->base_name }}</td>
                        <td class="py-1 px-2 border">
                            <div class="flex">
                                <a href="{{ route('sales_plan.index', ['base_id' => $base->base_id]) }}" class="text-xs mx-3 px-3 py-1 border border-green-600 bg-green-100">売上計画</a>
                                <a href="{{ route('monthly_cost.index', ['base_id' => $base->base_id]) }}" class="text-xs mx-3 px-3 py-1 border border-green-600 bg-green-100">月額経費</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>