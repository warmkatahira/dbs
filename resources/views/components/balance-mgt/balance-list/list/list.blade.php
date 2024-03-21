<div class="scroll_wrap flex flex-grow overflow-scroll">
    <div class="table_parent_div bg-white overflow-x-auto overflow-y-auto border border-gray-600">
        <table class="text-xs block whitespace-nowrap">
            <thead>
                <tr class="text-center text-white bg-gray-600 sticky top-0">
                    <th class="font-thin py-3 px-2">詳細</th>
                    <th class="font-thin py-3 px-2">収支日</th>
                    <th class="font-thin py-3 px-2">拠点</th>
                    <th class="font-thin py-3 px-2">荷主名</th>
                    <th class="font-thin py-3 px-2">売上</th>
                    <th class="font-thin py-3 px-2">経費</th>
                    <th class="font-thin py-3 px-2">利益</th>
                    <th class="font-thin py-3 px-2">利益率</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($listInfo as $list)
                    <tr class="hover:bg-theme-sub cursor-default">
                        <td class="py-2 px-2 border text-left">
                            <a href="{{ route('balance_detail.index', ['balance_id' => $list->balance_id]) }}" class="bg-theme-main text-white px-3 py-1">詳細</a>
                        </td>
                        <td class="py-1 px-2 border text-left">{{ CarbonImmutable::parse($list->balance_date)->isoFormat('Y年MM月DD日(ddd)') }}</td>
                        <td class="py-1 px-2 border text-left">{{ $list->base_name }}</td>
                        <td class="py-1 px-2 border text-left">{{ $list->customer_name }}
                        <td class="py-1 px-2 border text-right"><i class="las la-yen-sign"></i>{{ number_format($list->sales) }}</td>
                        <td class="py-1 px-2 border text-right"><i class="las la-yen-sign"></i>{{ number_format($list->cost) }}</td>
                        <td class="py-1 px-2 border text-right @if($list->profit < 0) bg-red-300 @endif"><i class="las la-yen-sign"></i>{{ number_format($list->profit) }}</td>
                        <td class="py-1 px-2 border text-right">{{ $list->sales == 0 ? 0 : number_format(($list->profit / $list->sales) * 100, 2) }}<i class="las la-percent"></i></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>