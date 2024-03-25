@vite(['resources/js/master_mgt/handling_fee_setting/handling_fee_setting.js'])

<x-app-layout>
    <x-page-header content="荷役設定"/>
    <!-- バリデーションエラー -->
    <x-validation-error-msg />
    <x-page-back :url="session('back_url_1')" />
    <div class="flex flex-row mb-2">
        <!-- 操作ボタン -->
        <x-master-mgt.handling-fee-setting.operation-div :customer="$customer" />
    </div>
    <x-master-mgt.customer-info :customer="$customer" />
    <!-- 荷役設定一覧 -->
    <table class="text-sm block whitespace-nowrap">
        <thead>
            <tr class="text-center text-white bg-gray-600 sticky top-0">
                <th class="font-thin py-3 px-2">荷役名</th>
                <th class="font-thin py-3 px-2">荷役単価</th>
                <th class="font-thin py-3 px-2">荷役備考</th>
                <th class="font-thin py-3 px-2">荷役並び順</th>
                <th class="font-thin py-3 px-2">操作</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach($handling_fee_settings as $handling_fee_setting)
                <tr class="hover:bg-theme-sub cursor-default">
                    <td class="py-1 px-2 border text-left">{{ $handling_fee_setting->handling_name }}</td>
                    <td class="py-1 px-2 border text-right"><i class="las la-yen-sign"></i>{{ $handling_fee_setting->pivot->handling_fee_unit_price }}</td>
                    <td class="py-1 px-2 border text-left">{{ $handling_fee_setting->pivot->handling_fee_note }}</td>
                    <td class="py-1 px-2 border text-right">{{ $handling_fee_setting->pivot->handling_fee_sort_order }}</td>
                    <td class="py-1 px-2 border">
                        <div class="flex">
                            <a href="{{ route('handling_fee_setting_update.index', ['customer_handling_id' => $handling_fee_setting->pivot->customer_handling_id]) }}" class="text-xs mx-3 px-3 py-1 border border-blue-600 bg-blue-100">更新</a>
                            <button type="button" class="handling_fee_setting_delete_enter text-xs mx-3 px-3 py-1 border border-red-600 bg-red-100" data-customer_handling_id="{{ $handling_fee_setting->pivot->customer_handling_id }}">削除</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <form method="POST" action="{{ route('handling_fee_setting_delete.delete') }}" id="handling_fee_setting_delete_form" class="m-0">
        @csrf
        <input type="hidden" id="customer_handling_id" name="customer_handling_id" value="">
    </form>
</x-app-layout>