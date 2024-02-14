@vite(['resources/js/monthly_cost_setting/monthly_cost_setting.js'])

<x-app-layout>
    <x-page-header content="月額経費登録"/>
    <!-- バリデーションエラー -->
    <x-validation-error-msg />
    <div class="flex flex-row mb-2">
        <a href="{{ session('back_url_1') }}" class="px-5 py-1"><i class="las la-arrow-circle-left la-2x"></i></a>
    </div>
    <div class="bg-white">
        <form method="POST" action="{{ route('monthly_cost_setting_create.create') }}" id="monthly_cost_setting_create_form">
            @csrf
            <x-div.label label="拠点" :value="Auth::user()->dbs_base->base_name" />
            <x-div.input type="month" label="月額経費年月" id="monthly_cost_setting_ym" :db="null" required="1" tippy="0" />
            <x-div.select label="経費項目" id="monthly_cost_item_id" :forValue="$monthly_items" forId="monthly_item_id" forText="monthly_item_name" :db="null" required="1" tippy="0" />
            <x-div.input type="text" label="月額経費" id="monthly_cost" :db="null" required="1" tippy="0" />
        </form>
    </div>
    <button type="button" id="monthly_cost_setting_create_enter" class="text-sm px-10 py-2 bg-theme-main text-white">登録</button>
</x-app-layout>