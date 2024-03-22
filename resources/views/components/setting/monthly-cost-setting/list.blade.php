<div class="scroll_wrap flex flex-grow overflow-scroll">
    <div class="table_parent_div bg-white overflow-x-auto overflow-y-auto border border-gray-600">
        <table class="text-sm block whitespace-nowrap">
            <thead>
                <tr class="text-left text-white bg-gray-600 sticky top-0">
                    <th class="font-thin py-3 px-2 text-center">設定年月</th>
                    <th class="font-thin py-3 px-2 text-center">拠点</th>
                    <th class="font-thin py-3 px-2 text-center">本社管理費</th>
                    <th class="font-thin py-3 px-2 text-center">月額経費</th>
                    <th class="font-thin py-3 px-2 text-center">操作</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($monthlyCosts as $monthly_cost_setting)
                    <tr class="text-left hover:bg-theme-sub cursor-default">
                        <td class="py-1 px-2 border">{{ CarbonImmutable::parse($monthly_cost_setting->monthly_cost_setting_ym)->isoFormat('YYYY年MM月') }}</td>
                        <td class="py-1 px-2 border">{{ $monthly_cost_setting->dbs_base->base_name }}</td>
                        <td class="py-1 px-2 border text-right"><i class="las la-yen-sign"></i>{{ number_format($monthly_cost_setting->ho_cost) }}</td>
                        <td class="py-1 px-2 border text-right"><i class="las la-yen-sign"></i>{{ number_format($monthly_cost_setting->monthly_cost) }}</td>
                        <td class="py-1 px-2 border">
                            <div class="flex">
                                <a href="{{ route('monthly_cost_setting_update.index', ['monthly_cost_setting_id' => $monthly_cost_setting->monthly_cost_setting_id]) }}" class="text-xs mx-3 px-3 py-1 border border-blue-600 bg-blue-100">更新</a>
                                <form method="POST" action="{{ route('monthly_cost_setting_delete.delete') }}" id="{{ 'monthly_cost_setting_delete_form_'.$monthly_cost_setting->monthly_cost_setting_id }}" class="m-0">
                                    @csrf
                                    <input type="hidden" name="monthly_cost_setting_id">
                                    <button type="button" id="{{ $monthly_cost_setting->monthly_cost_setting_id }}" class="monthly_cost_setting_delete_enter text-xs mx-3 px-3 py-1 border border-red-600 bg-red-100">削除</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>