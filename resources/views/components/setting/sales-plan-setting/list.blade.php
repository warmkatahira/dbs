<div class="scroll_wrap flex flex-grow overflow-scroll">
    <div class="table_parent_div bg-white overflow-x-auto overflow-y-auto border border-gray-600">
        <table class="text-sm block whitespace-nowrap">
            <thead>
                <tr class="text-left text-white bg-gray-600 sticky top-0">
                    <th class="font-thin py-3 px-2 text-center">設定年月</th>
                    <th class="font-thin py-3 px-2 text-center">拠点</th>
                    <th class="font-thin py-3 px-2 text-center">売上計画</th>
                    <th class="font-thin py-3 px-2 text-center">操作</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($salesPlans as $sales_plan_setting)
                    <tr class="text-left hover:bg-theme-sub cursor-default">
                        <td class="py-1 px-2 border">{{ CarbonImmutable::parse($sales_plan_setting->sales_plan_setting_ym)->isoFormat('YYYY年MM月') }}</td>
                        <td class="py-1 px-2 border text-right">{{ $sales_plan_setting->base->base_name }}</td>
                        <td class="py-1 px-2 border text-right"><i class="las la-yen-sign"></i>{{ number_format($sales_plan_setting->sales_plan) }}</td>
                        <td class="py-1 px-2 border">
                            <div class="flex">
                                <a href="{{ route('sales_plan_setting_update.index', ['sales_plan_setting_id' => $sales_plan_setting->sales_plan_setting_id]) }}" class="text-xs mx-3 px-3 py-1 border border-blue-600 bg-blue-100">更新</a>
                                <form method="POST" action="{{ route('sales_plan_setting_delete.delete') }}" id="{{ 'sales_plan_setting_delete_form_'.$sales_plan_setting->sales_plan_setting_id }}" class="m-0">
                                    @csrf
                                    <input type="hidden" name="sales_plan_setting_id">
                                    <button type="button" id="{{ $sales_plan_setting->sales_plan_setting_id }}" class="sales_plan_setting_delete_enter text-xs mx-3 px-3 py-1 border border-red-600 bg-red-100">削除</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>