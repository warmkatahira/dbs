@vite(['resources/js/setting/monthly_cost_setting/monthly_cost_setting.js'])

<x-app-layout>
    <x-page-header content="月額経費設定更新"/>
    <x-page-back :url="session('back_url_1')" />
    <!-- バリデーションエラー -->
    <x-validation-error-msg />
    <div class="bg-white">
        <form method="POST" action="{{ route('monthly_cost_setting_update.update') }}" id="monthly_cost_setting_update_form">
            @csrf
            <x-div.label label="拠点" :value="Auth::user()->dbs_base->base_name" />
            <x-div.label label="月額経費年月" :value="CarbonImmutable::parse($monthly_cost_setting->monthly_cost_setting_ym)->isoFormat('YYYY年MM月')" />
            <x-div.input type="tel" label="本社管理費" id="ho_cost" :db="$monthly_cost_setting->ho_cost" required="1" tippy="0" />
            <x-div.input type="tel" label="月額経費" id="monthly_cost" :db="$monthly_cost_setting->monthly_cost" required="1" tippy="0" />
        </form>
    </div>
    <button type="button" id="monthly_cost_setting_update_enter" class="text-sm px-10 py-2 bg-theme-main text-white">更新</button>
</x-app-layout>