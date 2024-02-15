@vite(['resources/js/setting/monthly_customer_setting/setting_record_create.js'])

<div id="setting_record_create_modal" class="setting_record_create_modal_close fixed hidden z-40 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto shadow-lg rounded-md bg-theme-gray w-1/3">
        <!-- モーダルヘッダー -->
        <div class="flex justify-between items-center bg-theme-main text-white rounded-t-md px-4 py-2">
            <p class="">設定行を追加する条件を指定して下さい</p>
        </div>
        <!-- モーダルボディー -->
        <div class="p-10">
            <form method="post" action="{{ route('monthly_customer_setting_create_record.create') }}" id="setting_record_create_form" enctype="multipart/form-data" class="m-0">
                @csrf
                <div class="flex flex-row">
                    <label for="base_id" class="text-sm text-white text-center bg-gray-600 w-40 py-2">拠点</label>
                    <select id="base_id" name="base_id" class="text-sm w-1/2">
                        @foreach($bases as $base)
                            <option value="{{ $base->base_id }}">{{ $base->base_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-row pt-3">
                    <label for="create_ym" class="text-sm text-white text-center bg-gray-600 w-40 py-2">追加年月</label>
                    <input type="month" id="create_ym" name="create_ym" class="text-sm w-1/2">
                </div>
            </form>
            <!-- ボタン -->
            <div class="flex justify-between mt-10">
                <button type="button" id="setting_record_create_enter" class="border border-blue-500 bg-blue-100 text-blue-500 text-center p-4 text-sm w-1/4">追加</button>
                <button type="button" class="setting_record_create_modal_close border border-red-500 bg-red-100 text-red-500 text-center p-4 text-sm w-1/4">閉じる</button>
            </div>
        </div>
    </div>
</div>