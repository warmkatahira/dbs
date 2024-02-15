@vite(['resources/js/setting/sales_plan_setting/sales_plan_setting.js'])

<x-app-layout>
    <x-page-header content="売上計画設定更新"/>
    <!-- バリデーションエラー -->
    <x-validation-error-msg />
    <div class="flex flex-row mb-2">
        <a href="{{ session('back_url_1') }}" class="px-5 py-1"><i class="las la-arrow-circle-left la-2x"></i></a>
    </div>
    <div class="bg-white">
        <form method="POST" action="{{ route('sales_plan_setting_update.update') }}" id="sales_plan_setting_update_form">
            @csrf
            <x-div.label label="拠点" :value="$sales_plan_setting->dbs_base->base_name" />
            <x-div.label label="売上計画年月" :value="\Carbon\CarbonImmutable::parse($sales_plan_setting->sales_plan_setting_ym)->isoFormat('YYYY年MM月')" />
            <x-div.input type="text" label="売上計画" id="sales_plan" :db="$sales_plan_setting->sales_plan" required="1" tippy="0" />
        </form>
    </div>
    <button type="button" id="sales_plan_setting_update_enter" class="text-sm px-10 py-2 bg-theme-main text-white">更新</button>
</x-app-layout>