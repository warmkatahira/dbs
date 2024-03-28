@vite(['resources/js/setting/monthly_cost_setting/monthly_cost_setting.js'])

<x-app-layout>
    <x-page-header content="月額経費登録"/>
    <x-page-back :url="session('back_url_1')" />
    <!-- バリデーションエラー -->
    <x-validation-error-msg />
    <div class="bg-white">
        <form method="POST" action="{{ route('monthly_cost_setting_create.create') }}" id="monthly_cost_setting_create_form">
            @csrf
            <x-div.label label="拠点" :value="Auth::user()->base->base_name" />
            <x-div.input type="month" label="月額経費年月" id="monthly_cost_setting_ym" :db="null" required="1" tippy="0" />
            <x-div.input type="tel" label="本社管理費" id="ho_cost" :db="null" required="1" tippy="0" />
            <x-div.input type="tel" label="月額経費" id="monthly_cost" :db="null" required="1" tippy="0" />
        </form>
    </div>
    <button type="button" id="monthly_cost_setting_create_enter" class="text-sm px-10 py-2 bg-theme-main text-white">登録</button>
</x-app-layout>